<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Employe;

class LeaveRejectMail extends Mailable
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
        return $this->subject('Leave Request Rejected')
                    ->view('emails.leave_rejection')
                    ->with([
                        'name' => $this->leaveRequest->name,
                        'emp_id' => $this->leaveRequest->emp_id,
                        'date' => $this->leaveRequest->date,
                        'reason' => $this->leaveRequest->reason,
                    ]);
    }
}
