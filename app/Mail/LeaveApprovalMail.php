<?php 

namespace App\Mail;



use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Models\employe;

class LeaveApprovalMail extends Mailable
{
    use Queueable, SerializesModels; 

    public $leaveRequest;

    public function __construct(Employe $leaveRequest)
    {
        $this->leaveRequest = $leaveRequest;
    }

    public function build()
    {
        return $this->view('emails.leave_approval')
                    ->with(['leaveRequest' => $this->leaveRequest]);
    }
}
