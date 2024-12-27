<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.adminlogin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
  
        $adminEmail = 'admin123@gmail.com';
        $adminPassword = 'pass123'; 
        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            session(['is_admin' => true]);
            return redirect()->route('leave_requests.index');
        }

        return back()->with('error', 'Invalid credentials for admin login');
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('admin.adminlogin')->with('success', 'Logged out successfully.');
    }

    public function dashboard()
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.adminlogin')->with('error', 'Unauthorized access.');
        }

        return view('admin.dashboard');
    }
}
