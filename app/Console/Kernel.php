<?php

namespace App\Console;

use App\Models\File;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('backup:clean')->daily()->at('23:50');
        $schedule->command('backup:run --only-db')->daily()->at('00:00');
        $schedule->call(function () {
            $data =
                    'grant_type=refresh_token'.
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
            $access_token = json_decode($response)->access_token;
            DB::update("update settings set dropbox_access_token = '".$access_token."' where 1");
        })->everyThreeHours();
//        $schedule->call(function () {
//            $files = File::where('upload_s3', 0)->take(5)->get();
//            foreach ($files as $file) {
//                if (isset($file->file_links->ftp)) {
//                    try {
//                        $imageName = $file->url;
//                        Storage::disk('s3')->put($imageName, Storage::disk('ftp')->get('expand/texpand/'.$imageName));
//                        $s3 = Storage::disk('s3')->url($imageName);
//                        $file->file_links->s3 = $s3;
//                        $file->upload_s3 = 1;
//                        $file->save();
//                    } catch (\Exception $e) {
//                        Log::error($file);
//                        Log::error($e);
//                    }
//                } else {
//                    $file->upload_s3 = 1;
//                    $file->save();
//                }
//            }
//        })->everyTwoHours()->between('8:00', '14:00');
        $schedule->call(function () {
            $files = File::where('upload_s3', 0)->take(5)->get();
            foreach ($files as $file) {
                if (isset($file->file_links->ftp)) {
                    try {
                        $imageName = $file->url;
                        Storage::disk('s3')->put($imageName, Storage::disk('ftp')->get('expand/texpand/'.$imageName));
                        $s3 = Storage::disk('s3')->url($imageName);
                        $file->file_links->s3 = $s3;
                        $file->upload_s3 = 1;
                        $file->save();
                    } catch (\Exception $e) {
                        Log::error($file);
                        Log::error($e);
                    }
                } else {
                    $file->upload_s3 = 1;
                    $file->save();
                }
            }
        })->everyThirtyMinutes()->between('14:00', '8:00');
//        $schedule->call(function () {
//            $files = File::where('upload_dropbox', 0)->take(5)->get();
//            foreach ($files as $file) {
//                try {
//                    $imageName = $file->url;
//                    $res = Storage::disk('dropbox')->put(('texpand/'.$imageName),
//                            Storage::disk('ftp')->get('expand/texpand/'.$imageName));
//                    $dropbox = ('texpand/'.$imageName);
//                    if ($res) {
//                        $file->file_links->dropbox = $dropbox;
//                        $file->upload_dropbox = 1;
//                    }
//                    $file->save();
//                } catch (\Exception $e) {
//                    Log::error($file);
//                    Log::error($e);
//                }
//            }
//        })->everyTwoHours()->between('8:00','14:00');
//        $schedule->call(function () {
//            $files = File::where('upload_dropbox', 0)->take(5)->get();
//            foreach ($files as $file) {
//                try {
//                    $imageName = $file->url;
//                    $res = Storage::disk('dropbox')->put(('texpand/'.$imageName),
//                            Storage::disk('ftp')->get('expand/texpand/'.$imageName));
//                    $dropbox = ('texpand/'.$imageName);
//                    if ($res) {
//                        $file->file_links->dropbox = $dropbox;
//                        $file->upload_dropbox = 1;
//                    }
//                    $file->save();
//                } catch (\Exception $e) {
//                    Log::error($file);
//                    Log::error($e);
//                }
//            }
//        })->everyThirtyMinutes()->between('14:00','8:00');
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
