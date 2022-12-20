<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    public function downloadBackup(){
        $res2=Artisan::call('backup:clean');
        $res=Artisan::call('backup:run --only-db');
//        dd($res2,$res);
        $path = storage_path('app/'.env('APP_NAME','texpand').'/*');
        $latest_ctime = 0;
        $latest_filename = '';
        $files = glob($path);
        foreach($files as $file)
        {
            if (is_file($file) && filectime($file) > $latest_ctime)
            {
                $latest_ctime = filectime($file);
                $latest_filename = $file;
            }
        }
        return response()->download($latest_filename);
    }
}
