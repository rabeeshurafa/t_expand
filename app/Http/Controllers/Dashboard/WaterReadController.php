<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\MeterRead;
use App\Models\water;
use App\Models\Setting;
use App\Models\Smslog;

use DB;
use Illuminate\Support\Carbon;

class WaterReadController extends Controller
{
    public function index()
    { 
        $type = 'waterRead';
        return view('dashboard.waterRead.index', compact('type'));
    }
    
    public function waterReadReport()
    { 
        $type = 'waterReadReport';
        return view('dashboard.waterRead.readReport', compact('type'));
    }
    
    public function watersWithLastRead(Request $request)
    {

        $water['info']= water::select('waters.*', 'users.name as user_name','a.name as subscription_Type_name','b.name as counter_Type_name','d.name as payType_name')
        ->where('waters.enabled',1)
        ->where('waters.user_id','=',$request['subscriber_id'])

        ->leftJoin('t_constant as a', 'a.id', 'waters.subscription_Type')

        ->leftJoin('t_constant as b', 'b.id', 'waters.counter_Type')

        ->leftJoin('t_constant as d', 'd.id', 'waters.payType')

        ->leftJoin('users','users.id','waters.user_id')

        ->get();
        foreach($water['info'] as $wat){
            $lastread= MeterRead::where('subs_id',$wat->id)->latest()->first();
            if($lastread != null){
                $wat->lastread=intval($lastread->current_read);
                $wat->lastread_id=intval($lastread->id);
            }else{
                $wat->lastread=0;
            }
        }
        return response()->json($water);
    }
    
    public function store_read(Request $request){
        if($request->update==null && $request->data_id==null){
            $meterRead  =new MeterRead();
            $meterRead->user_id         =   $request->SubscriberID;
            $meterRead->phone           =   $request->PHnum1;
            $meterRead->subs_id         =   $request->subscription_no;
            $meterRead->current_read    =   $request->current_read;
            $meterRead->prev_read       =   $request->prev_read;
            $meterRead->prev_id         =   ($request->prev_id??0);
            $meterRead->consumption     =   $request->consumption;
            $meterRead->usage_cost      =   $request->usage_cost;
            $meterRead->added_by        =   Auth()->user()->id;
            $meterRead->save();
        }else{
            $meterRead  =MeterRead::find($request->data_id);
            if($meterRead!=null){
                $meterRead->phone           =   $request->PHnum1;
                $meterRead->current_read    =   $request->current_read;
                $meterRead->consumption     =   $request->consumption;
                $meterRead->usage_cost      =   $request->usage_cost;
                $meterRead->updated_by      =   Auth()->user()->id;
                $meterRead->save();
                // $followRead  =MeterRead::where('prev_id',$meterRead->id)->first();
                // if($followRead != null){
                    
                // }
            }else{
                return response()->json(['app_id'=>0,'app_type'=>0,'error'=>'حدث خطأ']);
            }
        }
        if ($meterRead) {
            return response()->json(['app_id'=>$meterRead->id,'success'=>trans('تم الحفظ')]);
        }
        return response()->json(['app_id'=>0,'app_type'=>0,'error'=>'حدث خطأ']);

    }
    
    function sendSMS($mobile,$msg){
        //{"url":"http:\/\/hotsms.ps\/","sendSMS":1,"page":"sendbulksms.php","username":"Zababdeh M","password":"5873071","sender":"Zababdeh M"}
        $username=urlencode('Expand.ps');
        $password=urlencode('9836960');
        $sender  =urlencode('Expand.ps');
        $match=array();
        $message1=urlencode($msg);
        $result= file_get_contents("http://hotsms.ps/sendbulksms.php?user_name=".$username."&user_pass=".$password."&sender=".$sender."&mobile=$mobile&type=2&text=".$message1);
        return $result;
    }
    
    function addSmsLog($app_ticket,$sender,$txt,$s_mobile,$reciver_name,$app_id,$app_type){
        $setting=Setting::find(13);
        $str1 = $s_mobile;
        $pattern = "/\d{10}/";
        $mob='';
        if( preg_match($pattern,$str1, $match) ){
            if(strlen($match[0])==10)
              $mob= substr ( $match[0] , 1,9);
            else
                return 404;
        }
        else return 404;
        $mob='972'.$mob;
        $smslog= new Smslog();
        $smslog->sender=$sender;
        $smslog->txt=$txt;
        $smslog->s_mobile=$mob;
        $smslog->reciver_name=$reciver_name;
        $smslog->app_id=$app_id;
        $smslog->app_type=$app_type;
        $smslog->app_ticket=$app_ticket??0;
        // $smslog->status=SmsManager::sendSms($mob,$txt."-".$setting->name_ar);
        $smslog->status=$this->sendSMS($mob,$txt."-".$setting->name_ar);
        $smslog->save();
        return ($smslog->status);
    }
    
    public function waterReadSMS(Request $request){
        
        $from='';
        $to='';
        if ($request->from && $request->to) {
            $from = explode('/', ($request->get('from')));
            $from = $from[2] . '-' . $from[1] . '-' . $from[0].' '.'00:00:00';
            
            $to = explode('/', ($request->get('to')));
            if($to[0]==31)
                $to = $to[2] . '-' . $to[1] . '-' . ($to[0]).' '.'00:00:00';
            else
                $to = $to[2] . '-' . $to[1] . '-' . ($to[0]+1).' '.'00:00:00';
        }
        // $smsStatuses=array();
        $sucsessCount=0;
        $failCount=0;
        $sentBeforeCount=0;
        if($from != null && $from != '' && $to != null && $to != ''){
            $reads=MeterRead::where('enabled',1)->with('subscriper')->whereBetween('meter_reads.created_at',[$from,$to])->get();
            foreach($reads as $read){
                if($read->sms_statuse!=1001){
                    $datetemp=explode('-', ($read->created_at));
                    $txt='عزيزي المواطن بلغ استهلاك المياه عن شهر -';
                    $txt.=$datetemp[1].'- ';
                    $txt.= $read->consumption.' كوب بقيمة ';
                    $txt.=$read->usage_cost.' شيكل يرجي سدادها في اقرب وقت';
                    // dd($txt);
                    $s_mobile=$read->phone;
                    $reciver_name=$read->subscriper->name;
                    $app_id=$read->id;
                    $app_type=1000;////////special for meter reads sms/////////////////
                    
                    $smsStatus = $this->addSmsLog(1000,Auth()->user()->id,$txt,$s_mobile,$reciver_name, $app_id,$app_type);
                    if($smsStatus==1001){
                        $sucsessCount++;
                    }else{
                        $failCount++; 
                    }
                    $read->sms_statuse=$smsStatus;
                    $read->save();
                }else{
                    $sentBeforeCount++;
                }
            }
        }
        
        return response()->json(['sucsessCount'=>$sucsessCount,'failCount'=>$failCount,'sentBeforeCount'=>$sentBeforeCount,'success'=>trans('تم الارسال')]);
    }
    
    public function read_info_all(Request $request){
        $from='';
        $to='';
        if ($request->from && $request->to) {
            $from = explode('/', ($request->get('from')));
            $from = $from[2] . '-' . $from[1] . '-' . $from[0].' '.'00:00:00';
            
            $to = explode('/', ($request->get('to')));
            if($to[0]==31)
                $to = $to[2] . '-' . $to[1] . '-' . ($to[0]).' '.'00:00:00';
            else
                $to = $to[2] . '-' . $to[1] . '-' . ($to[0]+1).' '.'00:00:00';
        }
        $reads=MeterRead::where('enabled',1)->with('subscriper')->with('w_subscription')->with('last_read');
        if($from != null && $from != '' && $to != null && $to != ''){
            $reads=$reads->whereBetween('meter_reads.created_at',[$from,$to]);
        }
        
        $reads=$reads->get();
        return DataTables::of($reads)->addIndexColumn()->make(true);
    }
}
