<?php

namespace App\Providers;

use App\Support\Storage\Contracts\StorageInterface;
use App\Support\Storage\SessionStorage;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Menu;
use App\Models\Message;
use App\Models\MessageReciver;
use App\Models\Admin;
use App\Models\Role;
use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;
use Illuminate\Support\Facades\Http;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         Schema::defaultStringLength(191);
         $this->app->bind(StorageInterface::class, function ($app) {
            return new SessionStorage('basket');
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */




//    public function Call()
//    {
//
////        $url = 'https://api.dropboxapi.com/oauth2/token';
////        $ch = curl_init($url);
////        $data = array(
////            'oauth1_token' => "qievr8hamyg6ndck",
////            'oauth1_token_secret' => "qomoftv0472git7",
////            );
////            $APP_SECRET='a2hp0e30uhq76si';
////            $APP_KEY='8f7l1qrwph13rql';
////        curl -X POST https://api.dropboxapi.com/2/auth/token/from_oauth1 \
////    --header "Authorization: Basic OGY3bDFxcndwaDEzcnFsOmEyaHAwZTMwdWhxNzZzaQ==" \
////    --header "Content-Type: application/json" \
////    --data "{\"oauth1_token\":\"qievr8hamyg6ndck\",\"oauth1_token_secret\":\"qomoftv0472git7\"}"
//        $data =
//            'grant_type=authorization_code' .
//            '&code=rnDQybDinEAAAAAAAAAFNQQ52nzbRSyaNuG-jG0LYK4' .
//            '&client_id=8f7l1qrwph13rql'.
//            '&client_secret=a2hp0e30uhq76si';
//
////            $payload = json_encode($data);
////        https://www.dropbox.com/oauth2/authorize?client_id=8f7l1qrwph13rql&response_type=code
////        $code= file_get_contents("https://www.dropbox.com/oauth2/authorize?client_id=8f7l1qrwph13rql&response_type=code");
////        dd($code);
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
//        dd($response);
//
////            curl_setopt($ch, CURLOPT_POST, 1);
////            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
////            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Basic OGY3bDFxcndwaDEzcnFsOmEyaHAwZTMwdWhxNzZzaQ==", ' Content-Type: application/json'));
////            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
////            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
////            curl_setopt($ch, CURLOPT_TIMEOUT, 4);
////            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
////            dd($ch);
////            $result = curl_exec($ch);
////            curl_close($ch);
//
//    }

    public function Call()
    {

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
        dd(json_decode($response)->access_token);
    }

    public function boot()
    {

        Storage::extend('dropbox', function ($app, $config) {
            $adapter = new DropboxAdapter(new DropboxClient(
                Setting::first()->dropbox_access_token
//              ["8f7l1qrwph13rql","a2hp0e30uhq76si"]
            ));

            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config
            );
        });

        view::composer('*' , function ($view){
            $id=0;
            $userPer=array();
        if(isset(Auth()->user()->id)) {
            $id=Auth()->user()->id;
            $admin=Admin::find(Auth()->user()->id);
            $roles=Role::find($admin->role_id);
            $list=$roles->permissions;

            $userPer=Menu::whereIn('s_function_url',$list)->where('b_enabled',1)->get();
        }
        $allPer=Menu::get();
        $SysPer=Menu::where('b_enabled',1)->get();
        $employee=Admin::where('enabled',1)->get();
        //dd($userPer);
        $rMsgemp=Message::whereIn('id',MessageReciver::select('i_message_id')->where('i_receiver_id',$id)->where('is_seen',0)->get())->get();
        //dd($rMsgemp);
        //$sMsgemp=Message::where('created_by',Auth()->user()->id)->get();

            $setting = Setting::first();
            if($setting->city_id){
                $city_id = $setting->city_id;
            }else{
                $city_id =0;
            }
            if($setting->town_id){
                $town_id = $setting->town_id;
            }else{
                $town_id =0;
            }
            if($setting->region_id){
                $region_id = $setting->region_id;
            }else{
                $region_id =0;
            }
            $view-> with([
                  'setting'      => $setting,
                  'city_id'    => $city_id,
                  'town_id'    => $town_id,
                  'region_id'   => $region_id,
                  'allPer'       => $allPer,
                  'SysPer'       => $SysPer,
                  'userPer'      => $userPer,
                  'employees'      => $employee,
                  'rMsgemp'      => $rMsgemp,
                  //'sMsgemp'      => $sMsgemp,
                ]) ;
            });
     }
}
