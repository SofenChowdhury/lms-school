<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;
use Session;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use App\Notifications\Attendance_notify;


class sendNotification extends Command
{
    public $user;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendNotification';

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
        echo $user = Auth::user()->id;
        exit;
        $sendNotification = DB::table('notifications')->insert(
            array(
                    'id'                =>   '2', 
                    'school_id'         =>   '1', 
                    'type'              =>   'App\Notifications\Attendance_notify',
                    'notifiable_type'   =>   'Dayle',
                    'machinestype'      =>   'Dayle',
                    'notifiable_id'     =>   $user,
                    'data'              =>   'Dayle',
             )
        );       
    }
}
