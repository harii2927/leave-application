<?php

namespace App\Mail;

use App\Models\Employe;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class LeaveRejectionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $leaveRequest;

    public function __construct(Employe $leaveRequest)
    {
        $this->leaveRequest = $leaveRequest;
    }

    public function build()
    {
        return $this->view('emails.leave_rejection')
                    ->with(['leaveRequest' => $this->leaveRequest]);
    }
}

