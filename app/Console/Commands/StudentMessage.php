<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Mail\StudentEmail;
use Illuminate\Support\Facades\Mail;
class StudentMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send message to student tell him about exams';

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
     * @return int
     */
    public function handle()
    {
       $emails=Student::select('email')->get();
       $message='you have an english exam';
        foreach($emails as $email){
            Mail::To($email)->send(new StudentEmail($message));
        }
    }
}
