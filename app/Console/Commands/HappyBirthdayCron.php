<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Users;
use Mail;
use App\Mail\HappyBirthdayMail;

class HappyBirthdayCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'happybirthday:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = Users::whereMonth('birthday', date('m'))
        ->whereDay('birthday', date('d'))
        ->get();

        foreach($users as $key => $user)
        {
            $email = $user->email;
            Mail::to($user)->send(new HappyBirthdayMail($user));
        }
    }
}
