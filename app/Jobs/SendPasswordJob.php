<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Mail;


class SendPasswordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $mail;
    public $token;

    public function __construct($mail,$token)
    {
        $this->mail= $mail;
        $this->token= $token;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('dinhhn2809@gmail.com')->send(new SendPassword());
    }
}
