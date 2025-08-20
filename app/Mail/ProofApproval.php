<?php

namespace App\Mail;

use App\Models\ProofApprovalSignOff;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class ProofApproval extends Mailable
{
    use Queueable, SerializesModels;

    public $proof_approval_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($proof_approval_id)
    {
        $this->proof_approval_id = $proof_approval_id;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$proof_approval = ProofApprovalSignOff::findOrFail($this->proof_approval_id);
        return $this->subject('Proof Approval '.$proof_approval->number.' From Book Empire')
                    ->view('emails.proof-approval')->with([
                        'proof_approval' => $proof_approval
                    ]);
    }
}
