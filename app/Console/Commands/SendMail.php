<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:testemail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email by command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        Mail::to("tuannguyen0719@gmail.com")->send(new TestEmail());
    }
}
