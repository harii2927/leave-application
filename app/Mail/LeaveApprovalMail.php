<?php 

// namespace App\Mail;



// use Illuminate\Mail\Mailable;
// use Illuminate\Bus\Queueable;
// use Illuminate\Queue\SerializesModels;
// use App\Models\employe;

// class LeaveApprovalMail extends Mailable
// {
//     use Queueable, SerializesModels; 

//     public $leaveRequest;

//     public function __construct(Employe $leaveRequest)
//     {
//         $this->leaveRequest = $leaveRequest;
//     }

//     public function build()
//     {
//         return $this->view('emails.leave_approval')
//                     ->with(['leaveRequest' => $this->leaveRequest]);
//     }
// }


namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Models\Employe;

class LeaveApprovalMail extends Mailable
{
    use Queueable, SerializesModels; 

    public $leaveRequest;

    /**
     * Create a new message instance.
     *
     * @param Employe $leaveRequest
     */
    public function __construct(Employe $leaveRequest)
    {
        $this->leaveRequest = $leaveRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Leave Request Approved')
                    ->view('emails.leave_approval')
                    ->with([
                        'name' => $this->leaveRequest->name,
                        'emp_id' => $this->leaveRequest->emp_id,
                        'date' => $this->leaveRequest->date,
                        'reason' => $this->leaveRequest->reason,
                    ]);
    }
}
