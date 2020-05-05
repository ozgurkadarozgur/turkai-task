<?php

namespace App\Mail;

use App\Family;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeFamilyMail extends Mailable
{
    use Queueable, SerializesModels;

    private $family;

    /**
     * Create a new message instance.
     *
     * @param Family $family
     * @return void
     */
    public function __construct(Family $family)
    {
        $this->family = $family;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('turkai@task.com')
                    ->markdown('email.welcome_family_email')
                    ->with([
                        'family' => $this->family
                    ]);
    }
}
