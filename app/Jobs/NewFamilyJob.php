<?php

namespace App\Jobs;

use App\Family;
use App\Mail\WelcomeFamilyMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NewFamilyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $family;

    /**
     * Create a new job instance.
     * @param Family $family
     * @return void
     */
    public function __construct(Family $family)
    {
        $this->family = $family;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->family->email)->send(new WelcomeFamilyMail($this->family));
    }
}
