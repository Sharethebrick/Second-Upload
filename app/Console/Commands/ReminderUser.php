<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Notifications\Reminder as ReminderNotification;
use Illuminate\Support\Facades\Notification;
use DB;

class ReminderUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:reminder-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        $reminder = DB::table('reminder')
        ->join('users','reminder.added_by','=','users.id')
        ->select('reminder.*','users.name')
        ->where('reminder_at', '<=', Carbon::now()->add(10, 'minute')->toDateTimeString())
        ->where('reminder_at', '>', Carbon::now()->toDateTimeString())
        ->where('reminder.status', 0)
        ->get();
        
        
        foreach($reminder as $data){

            $users = explode(",",$data->reminder_to);
            foreach($users as $user){
                $userData = DB::table('users')->where('status',1)->where('id',$user)->first();
                Notification::route('mail', $userData->email)->notify(new ReminderNotification($data));
                DB::table('reminder')
                    ->where('id',$data->id)
                    ->update(['status' => 1]);
            }
        }
    }
}
