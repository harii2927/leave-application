<?php

// namespace App\Mail;

// use App\Models\Employe;
// use Illuminate\Bus\Queueable;
// use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

// class LeaveRequestMail extends Mailable
// {
//     use Queueable, SerializesModels;

//     public $leaveRequest;

    
//     public function __construct(Employe $leaveRequest)
//     {
//         $this->leaveRequest = $leaveRequest;
//     }

    
//     public function build()
//     {
//         return $this->subject('New Leave Request')
//                     ->view('emails.leave-request')
//                     ->with([
//                      'name' => $this->leaveRequest->name,
//                      'emp_id' => $this->leaveRequest->emp_id,
//                      'date' => $this->leaveRequest->date,
//                      'reason' => $this->leaveRequest->reason,
//              ]);
//     }
// }



namespace App\Mail;

use App\Models\Employe;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveRequestMail extends Mailable
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
        $approveUrl = route('leave_approve_email', [
            'id' => $this->leaveRequest->id,
            'token' => $this->leaveRequest->approval_token
        ]);

        $rejectUrl = route('leave_reject_email', [
            'id' => $this->leaveRequest->id,
            'token' => $this->leaveRequest->approval_token
        ]);

        return $this->subject('New Leave Request')
                    ->view('emails.leave-request')
                    ->with([
                        'name' => $this->leaveRequest->name,
                        'emp_id' => $this->leaveRequest->emp_id,
                        'date' => $this->leaveRequest->date,
                        'reason' => $this->leaveRequest->reason,
                        'approveUrl' => $approveUrl,
                        'rejectUrl' => $rejectUrl,
                    ]);
    }
}
