<?php

namespace App\Mail;

use App\Models\Employe;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $leaveRequest;

    
    public function __construct(Employe $leaveRequest)
    {
        $this->leaveRequest = $leaveRequest;
    }

    
    public function build()
    {
        return $this->subject('New Leave Request')
                    ->view('emails.leave-request')
                    ->with([
                     'name' => $this->leaveRequest->name,
                     'emp_id' => $this->leaveRequest->emp_id,
                     'date' => $this->leaveRequest->date,
                     'reason' => $this->leaveRequest->reason,
             ]);
    }
}