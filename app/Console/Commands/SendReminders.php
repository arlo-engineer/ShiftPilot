<?php

namespace App\Console\Commands;

use App\Mail\RemindSendmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Company;


class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails to employees';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 社員のメールアドレスを配列で格納
        $emails = Company::getNotificationEmails();
        // $emails = ['akki1ron12@gmail.com', 'yoshikawa@gmail.com'];

        foreach ($emails as $email) {
            // $to宛にメールを送信
            Mail::to($email)->send(new RemindSendmail());
        }
    }
}
