<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\User;
use App\Mail\LeaveRequestMail;
use App\Mail\LeaveApprovalMail;
use App\Mail\LeaveRejectMail;
use Illuminate\Support\Str;



class EmployeesController extends Controller
{

    public function index(Request $request)
    {
        $employeeQuery = Employe::query();

        if ($request->filter_name) {
            $employeeQuery->where('name', 'LIKE', '%' . $request->filter_name . '%');
        }

        if ($request->filter_emp_id) {
            $employeeQuery->where('emp_id', 'LIKE', '%' . $request->filter_emp_id . '%');
        }

        if ($request->filter_date) {
            $employeeQuery->where('date', 'LIKE', '%' . $request->filter_date . '%');
        }


        if (!empty($request->get('search'))) {
            $employeeQuery->where(function ($w) use ($request) {
                $search = $request->get('search');
                $w->where('name', 'LIKE', "%$search%")
                    ->orWhere('emp_id', 'LIKE', "%$search%")
                    ->orWhere('emp_email', 'LIKE', "%$search%")
                    ->orWhere('date', 'LIKE', "%$search%")
                    ->orWhere('status', 'LIKE', "%$search%");
            });
        }

        if ($request->ajax()) {
            return DataTables::of($employeeQuery)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {

                    if ($row->status == 'pending') {
                        return '<a href="' . route('leave_approve', $row->id) . '" class="btn btn-success">Approve</a>
                            <a href="' . route('leave_reject', $row->id) . '" class="btn btn-danger">Reject</a>';
                    } elseif ($row->status == 'approved') {
                        return '<span class="badge rounded-pill bg-success">Approved</span>';
                    } else {
                        return '<span class="badge rounded-pill bg-danger">Rejected</span>';
                    }
                })
                ->rawColumns(['status'])
                ->make(true);
        }
        return view('leave_requests');
    }


    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'emp_email' => 'required|email|unique:employee_leaves,emp_email',
            'emp_id' => 'required|string|max:255',
            'date' => 'required|date',
            'reason' => 'required|string|max:255',
        ]);

        $leaveRequest = Employe::create($validated);
        $leaveRequest->approval_token = Str::random(32);
        $leaveRequest->save();

        $this->sendLeaveRequestEmail($leaveRequest);
        return redirect()->back()->with('success', 'Leave request submitted successfully!');
    }

    private function sendLeaveRequestEmail($leaveRequest)
    {
        try {
            Mail::to('hariharan232907@gmail.com')
                ->cc('gopin5614@gmail.com')
                ->send(new LeaveRequestMail($leaveRequest));

            return redirect()->back()->with('success', 'Leave request submitted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send the email. Error: ' . $e->getMessage());
        }
    }

    // private function sendLeaveRequestEmail($leaveRequest)
    // {
    //     Mail::to('hariharan232907@gmail.com')->cc('gopin5614@gmail.com')->send(new LeaveRequestMail($leaveRequest));  

    //     return redirect()->back()->with('success', 'Leave request submitted successfully.');

    // }

    // public function approve($id)
    // {
    //     $leaveRequest = Employe::where('id', $id)->whereStatus('pending')->first();

    //     $data['status'] = 'approved';
    //     $leaveRequest->update($data);

    //     Mail::to($leaveRequest->emp_email)->send(new LeaveApprovalMail($leaveRequest));
    //     return redirect()->back()->with('success', 'Leave request approved.');
    // }

    //  public function reject($id)
    // {
    //     $leaveRequest = Employe::where('id', $id)->whereStatus('pending')->first();
    //     $data['status'] = 'rejected';

    //     if($leaveRequest){

    //         Mail::to($leaveRequest->emp_email)->send(new LeaveRejectMail($leaveRequest));
    //         $leaveRequest->update($data);

    //         return redirect()->back()->with('success', 'Leave request rejected, and the employee has been notified.');
    //     }

    //     return redirect()->back()->with('error', 'Unable to send a request');

    // } 
    public function approveByEmail($id, $token)
    {
        $leaveRequest = Employe::where('id', $id)
            ->where('approval_token', $token)
            ->where('status', 'pending')
            ->first();

        if ($leaveRequest) {
            $leaveRequest->update(['status' => 'approved']);
            Mail::to($leaveRequest->emp_email)->send(new LeaveApprovalMail($leaveRequest));
            return redirect()->back()->with('success', 'Leave request approved.');
        }

        return redirect()->back()->with('error', 'Invalid or expired approval token.');
    }

    public function rejectByEmail($id, $token)
    {
        $leaveRequest = Employe::where('id', $id)
            ->where('approval_token', $token)
            ->where('status', 'pending')
            ->first();

        if ($leaveRequest) {
            $leaveRequest->update(['status' => 'rejected']);
            Mail::to($leaveRequest->emp_email)->send(new LeaveRejectMail($leaveRequest));
            return redirect()->back()->with('success', 'Leave request rejected successfully.');
        }

        return redirect()->back()->with('error', 'Invalid or expired rejection token.');
    }


    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);

            return redirect()->route('employees_create')->with('success', 'Logged in successfully.');
        } else {
            return back()->withErrors(['login' => 'Invalid email or password.']);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
