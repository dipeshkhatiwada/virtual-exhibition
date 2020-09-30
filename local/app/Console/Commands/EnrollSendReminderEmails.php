<?php

namespace App\Console\Commands;

use App\EnrollReservation;
use App\Mail\ReminderVirtualExhibition;
use Illuminate\Console\Command;
use App\library\Settings;
use Carbon\Carbon;
use Mail;


class EnrollSendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enroll:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification to user before 1 day of exhibition start date';

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
        //Get start_date
        $reservations = EnrollReservation::query()
                ->where('publish_status', '1')
                ->get();
        //group by user
        $data = [];
        foreach ($reservations as $reserve)
        {

            $start_date = date_create($reserve->start_date);
            $reminder_date = date_sub($start_date,date_interval_create_from_date_string("1 days"))->format('d-m-y');
            $today = now()->format('d-m-y');
            if($reminder_date == $today)
            {
                $employer = \App\Employers::where('id', $reserve->employer_id)->first();
                $mydata = array(
                    'to_name' => $employer->name,
                    'to_email' => $employer->email,
                    'reserve' => $reserve,
                    'start_date' => $start_date,
                    'subject' => 'Reminder for the Virtual Exhibition',
                    'from_name' => Settings::getSettings()->name,
                    'logo' => Settings::getImages()->logo,
                    'from_email' => Settings::getSettings()->email,
                );
                Mail::to($mydata['to_email'],$mydata['to_name'])
                ->later($reminder_date, new ReminderVirtualExhibition($mydata));
            }

        }

    }

}
