<?php

namespace App\Jobs;

use App\Mail\OrderEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class OrderConfirmationEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

     public $email;
     public $order;
    public function __construct($receiver_email,$order)
    {
        $this->email=$receiver_email;
        $this->order=$order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new OrderEmail($this->order));
    }
}
