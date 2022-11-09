<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
//    public function Call()
//    {
//
//        $data =
//            'grant_type=refresh_token' .
//            '&refresh_token=E7u1dL2VlDMAAAAAAAAAAQu3ZsL2bZx4572ST5-OAzO8tOjXO_wf2uHM8yg7kOjo'.
//            '&code=rnDQybDinEAAAAAAAAAFNQQ52nzbRSyaNuG-jG0LYK4' .
//            '&client_id=8f7l1qrwph13rql'.
//            '&client_secret=a2hp0e30uhq76si';
//        $curl = curl_init();
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => 'https://api.dropboxapi.com/oauth2/token',
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'POST',
//            CURLOPT_POSTFIELDS => $data,
//            CURLOPT_HTTPHEADER => array(
//                'Content-Type: application/x-www-form-urlencoded'
//            ),
//        ));
//        $response = curl_exec($curl);
//        curl_close($curl);
////        dd($response->);
//    }
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
//        $schedule->command('backup:clean')->daily()->at('01:00');
//        $schedule->command('backup:run')->daily()->at('19:50');
        $schedule->call(function () {
            $data =
                'grant_type=refresh_token' .
                '&refresh_token=E7u1dL2VlDMAAAAAAAAAAQu3ZsL2bZx4572ST5-OAzO8tOjXO_wf2uHM8yg7kOjo'.
                '&client_id=8f7l1qrwph13rql'.
                '&client_secret=a2hp0e30uhq76si';
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.dropboxapi.com/oauth2/token',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $access_token=json_decode($response)->access_token;
            DB::update("update settings set dropbox_access_token = '".$access_token."' where 1" );
        })->everyThreeHours();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
