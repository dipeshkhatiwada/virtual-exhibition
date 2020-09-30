<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs;
use Carbon\Carbon;
use App\EmployeeRegistration;


class UpdateJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tender:jobupdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Jobs';

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
        $jobs = Jobs::select('id','deadline')->where('status',1)->where('deadline', '<=', date('Y-m-d'))->get();

       foreach($jobs as $job)
       {
          if(date('H') == 17){
           Jobs::where('id',$job->id)->update(['status' => 2]);
          }
       }

       $expday = Carbon::now()->subDay(1);
       //dd($expday);

       $expreds = \App\EmployeeRegistration::where('created_at', '<', $expday)->get();
       foreach($expreds as $exp)
       {
           \App\EmployeeRegistration::where('id',$exp->id)->delete();
       }

      $events = \App\Event::where('to_date', '<',date('Y-m-d'))->get();
       foreach ($events as $key => $event) {
         \App\Event::where('id', $event->id)->update(['status' => 2]);
       }

       $trainings = \App\Training::where('end_date', '<',date('Y-m-d'))->get();
       foreach ($trainings as $key => $training) {
         \App\Training::where('id', $training->id)->update(['status' => 2]);
       }
    }
}
