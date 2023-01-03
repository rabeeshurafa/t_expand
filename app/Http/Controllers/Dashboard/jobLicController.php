<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jobLic;
use App\Http\Requests\jobLicRequest;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\Setting;
use App\Models\Town;
use Illuminate\Support\Carbon;

class jobLicController extends Controller
{
    public function index()
    {
        $type='jobLic';
        $MaxlicNo=jobLic::orderBy('id', 'desc')->first();
        if($MaxlicNo==null){
            $licNo=1;
        }else{
           $licNo=($MaxlicNo->licNo+1); 
        }
        $setting = Setting::first();
        $town=Town::where('id',$setting->town_id)->first();
       return view('dashboard.jobLic.jobLic',compact('type','town','licNo'));
    }
    
    public function jobLicReport()

    {

        $type = 'jobLicReport';

        $url = "jobLic_report";
        
        return view('dashboard.archive.jobLicReport', compact('type', 'url'));

    }
    
    public function stopeindex($id)
    {
        $lic=jobLic::find($id);
        $carbon = new Carbon($lic->end_date);
        $nowDate = Carbon::now();
        $isSertEnd = $carbon->gt($nowDate);
        $cost=0;
        if($isSertEnd==false){
           $res= $carbon->diffInDays($nowDate, false);
           $years=intval($res/365);
           $years+=(($res%365)>0?1:0);
           
           $setting = Setting::first();
           $cost=($setting->job_lic_cost*$years);
           $lic['cost']=$cost;
        }else{
            $lic['cost']=0;
        }
        
        if($lic->stop_date!=null&&$lic->stop_date!=''){
            $date = explode('-', ($lic->stop_date));

            $date = $date[2]. '/' . $date[1] . '/' .$date[0] ;
            $lic->stop_date=$date;
        }else{
            $lic->stop_date='';
        }
        
        if($lic->start_date!=null&&$lic->start_date!=''){
            $date1 = explode('-', ($lic->start_date));

            $date1 = $date1[2]. '/' . $date1[1] . '/' .$date1[0] ;
            $lic->start_date=$date1;
        }else{
            $lic->start_date='';
        }
        
        if($lic->end_date!=null&&$lic->end_date!=''){
            $date2 = explode('-', ($lic->end_date));

            $date2 = $date2[2]. '/' . $date2[1] . '/' .$date2[0] ;
            $lic->end_date=$date2;
        }else{
            $lic->end_date='';
        }
        
        $type='stopJobLic';
        return view('dashboard.jobLic.stopJobLic',compact('type','lic'));
    }

    public function store_jobLic(jobLicRequest $request){
        // dd($request->all());
        if($request->jobLicId == null){
            $jobLic = new jobLic();
            $jobLic->name =  $request->name;
            $jobLic->address = $request->address;
            $jobLic->street = $request->street;
            $jobLic->lic_cat = $request->lic_cat;
            $jobLic->nationalId = $request->nationalId;
            $jobLic->waselNo = $request->waselNo;
            
            $from = date_create(($request->start_date));
            $from = explode('/', ($request->start_date)); 
            $from = $from[2].'-'.$from[1].'-'.$from[0];
            $jobLic->start_date = $from;
            
            
            $from = date_create(($request->end_date));
            $from = explode('/', ($request->end_date)); 
            $from = $from[2].'-'.$from[1].'-'.$from[0];
            $jobLic->end_date = $from;
           
            $from = date_create(($request->wasel_date));
            $from = explode('/', ($request->wasel_date)); 
            $from = $from[2].'-'.$from[1].'-'.$from[0];
            $jobLic->wasel_date = $from;
          
            $jobLic->lic_type = $request->lic_type;
            $jobLic->hadNo  = json_encode($request->hadNo);
            $jobLic->business_name  = $request->businessName;
            $jobLic->lic_name = json_encode($request->lic_name);
            $jobLic->licNo = $request->licNo;
            $jobLic->user_id   = $request->customerId;

            $jobLic->save();
         }else{
            $jobLic = jobLic::find($request->jobLicId);
            $jobLic->name =  $request->name;
            $jobLic->address = $request->address;
            $jobLic->street = $request->street;
            $jobLic->lic_cat = $request->lic_cat;
            $jobLic->nationalId = $request->nationalId;
            $jobLic->waselNo = $request->waselNo;
            
            $from = date_create(($request->start_date));
            $from = explode('/', ($request->start_date)); 
            $from = $from[2].'-'.$from[1].'-'.$from[0];
            $jobLic->start_date = $from;
            
            
            $from = date_create(($request->end_date));
            $from = explode('/', ($request->end_date)); 
            $from = $from[2].'-'.$from[1].'-'.$from[0];
            $jobLic->end_date = $from;
           
            $from = date_create(($request->wasel_date));
            $from = explode('/', ($request->wasel_date)); 
            $from = $from[2].'-'.$from[1].'-'.$from[0];
            $jobLic->wasel_date = $from;
          
            $jobLic->lic_type = $request->lic_type;
            $jobLic->hadNo  = json_encode($request->hadNo);
            $jobLic->lic_name = json_encode($request->lic_name);
            $jobLic->business_name  = $request->businessName;
            $jobLic->licNo = $request->licNo;
            $jobLic->user_id   = $request->customerId;

            $jobLic->save();
         }
         if ($jobLic) {
            return response()->json(['success'=>trans('admin.subscriber_added')]);
        }
     
         return response()->json(['errors'=>$validator->errors()->all()]);
    }
    
    public function stop_jobLic(jobLicRequest $request){
        $jobLic=jobLic::find($request->jobLicId);
        
        
        if($jobLic!=null){
            
            if($request->stopDate!=null&&$request->stopDate!=''){
                $date = explode('/', ($request->stopDate));
    
                $date = $date[2] . '-' . $date[1] . '-' . $date[0];
                $jobLic->stop_date=$date;
            }else{
                $jobLic->stop_date=null;
            }
            
            $jobLic->is_stoped      =  1;
            $jobLic->stoped_by      =  Auth()->user()->id;
            $jobLic->stop_reason    =  $request->stopReason;
            $jobLic->rest_money     =  $request->restMoney;
            $jobLic->notes          =  $request->stopNotes;
            
            $jobLic->save();
        }
         if ($jobLic) {
            return response()->json(['success'=>trans('admin.subscriber_added')]);
        }
     
         return response()->json(['errors'=>$validator->errors()->all()]);
    }
    
    public function jobLic_info_all(Request $request)
    {
        $jobLic= jobLic::select('joblic.*','users.name')
        ->leftJoin('users','users.id','joblic.user_id')
        ->orderBy('joblic.id', 'DESC')
        ->get();
        return DataTables::of($jobLic)
        ->addIndexColumn()
        ->addColumn('status', function ($jobLic) {

            $carbon = new Carbon($jobLic->end_date);
            $nowDate = Carbon::now();
            $isSertEnd = $carbon->gt($nowDate);
            $jobLic->isSertEnd=$isSertEnd;
            if($jobLic->is_stoped==1){
                return 'مغلقة';
            }else if($isSertEnd==false){
                return 'منتهية';
            }else{
                return 'فعالة';
            }

        })->addColumn('isSertEnd', function ($jobLic) {

            $carbon = new Carbon($jobLic->end_date);
            $nowDate = Carbon::now();
            $isSertEnd = $carbon->gt($nowDate);
            return $isSertEnd;
        })
        ->make(true);
    }

    public function jobLic_info(Request $request)
    {
        $renew=explode('/', $request->jobLic_id);
        // dd($request->jobLic_id,$renew,$request->renew);
        if(sizeof($renew)>2){
            $jobLic['renew']=  1;
        }else{
            $jobLic['renew']=  0;
        }
        $jobLic['info'] = jobLic::find($request['jobLic_id']);
        $jobLic['info']->lic_name=$jobLic['info']->lic_name==null?array():json_decode($jobLic['info']->lic_name);
        $jobLic['info']->hadNo=$jobLic['info']->hadNo==null?array():json_decode($jobLic['info']->hadNo);
        $jobLic['user']=User::find($jobLic['info']->user_id);
        // $jobLic['info'] = jobLic::find($request['jobLic_id']);
        // ->select('jobLic.*','jobLic_extentions.name as use_desc_name','users.name')
        // ->leftJoin('jobLic_extentions','jobLic_extentions.id','jobLic.use_desc')
        // ->leftJoin('users','users.id','jobLic.user_id')
        // ->orderBy('jobLic.id', 'DESC');
        return response()->json($jobLic);

    }
    public function jobLic_info_byUser(Request $request)
    {
        $jobLic['info'] = jobLic::where('user_id','=',$request['subscriber_id'])->get();
        $jobLic['user']=User::find($request['subscriber_id']);
        // $jobLic['jobLicEx'] = jobLicExtention::find($jobLic['info']->use_desc);
        // $jobLic['info'] = jobLic::find($request['jobLic_id']);
        // ->select('jobLic.*','jobLic_extentions.name as use_desc_name','users.name')
        // ->leftJoin('jobLic_extentions','jobLic_extentions.id','jobLic.use_desc')
        // ->leftJoin('users','users.id','jobLic.user_id')
        // ->orderBy('jobLic.id', 'DESC');
        return response()->json($jobLic);

    }
    
    public function getJobLicReport (Request $request){
        $from='';
        $to='';
        if ($request->from && $request->to) {

            $from = date_create(($request->get('from')));

            $from = explode('/', ($request->get('from')));

            $from = $from[2] . '-' . $from[1] . '-' . $from[0].' ';

            $to = date_create(($request->get('to')));

            $to = explode('/', ($request->get('to')));
            if($to[0]==31)
                $to = $to[2] . '-' . $to[1] . '-' . ($to[0]).' ';
            else
                $to = $to[2] . '-' . $to[1] . '-' . ($to[0]+1).' ';
            
        }
        
        $jobLic= jobLic::select('joblic.*','users.name')
        ->leftJoin('users','users.id','joblic.user_id')
        ->orderBy('joblic.start_date', 'DESC');

        if($request->statuse==3){
            if($from != '' && $to != ''){
                $jobLic=$jobLic->whereBetween('joblic.start_date',[$from,$to]);
            }
            $jobLic=$jobLic->where('is_stoped',1)->get();
            
            return DataTables::of($jobLic)
            ->addIndexColumn()
            ->addColumn('statuse', function ($jobLic) {
    
                $carbon = new Carbon($jobLic->end_date);
                $nowDate = Carbon::now();
                $isSertEnd = $carbon->gt($nowDate);
                $jobLic->isSertEnd=$isSertEnd;
                if($jobLic->is_stoped==1){
                    return 'مغلقة';
                }else if($isSertEnd==false){
                    return 'منتهية';
                }else{
                    return 'فعالة';
                }
    
            })->addColumn('isSertEnd', function ($jobLic) {
    
                $carbon = new Carbon($jobLic->end_date);
                $nowDate = Carbon::now();
                $isSertEnd = $carbon->gt($nowDate);
                return $isSertEnd;
            })
            ->make(true);
        }else if($request->statuse==2){
            if($request->years != '' && $request->years != 0){
                $date=Carbon::now()->subYears(intval($request->years));
                $jobLic=$jobLic->whereBetween('joblic.end_date',[$date,Carbon::now()]);
            }
            $jobLic=$jobLic->get();
            
            $res=array();
            foreach($jobLic as $job ){
               $carbon = new Carbon($job->end_date);
                $nowDate = Carbon::now();
                $isSertEnd = $carbon->gt($nowDate);
                $job->isSertEnd=$isSertEnd;
                
                if($job->is_stoped != 1 && $isSertEnd ==false){
                    
                    $diff= $carbon->diffInDays($nowDate, false);
                    $years=intval($diff/365);
                    $years+=(($diff%365)>0?1:0);
                   
                    $job->waselNo=$years;
                    
                    $job->statuse='منهية';
                    array_push($res,$job);
                }
           }
           return DataTables::of($res)
            ->addIndexColumn()->make(true);
        }else if($request->statuse==1){
            if($from != '' && $to != ''){
                $jobLic=$jobLic->whereBetween('joblic.start_date',[$from,$to]);
            }
            $jobLic=$jobLic->where('is_stoped',0)->get();
            return DataTables::of($jobLic)
            ->addIndexColumn()
            ->addColumn('statuse', function ($jobLic) {
    
                $carbon = new Carbon($jobLic->end_date);
                $nowDate = Carbon::now();
                $isSertEnd = $carbon->gt($nowDate);
                $jobLic->isSertEnd=$isSertEnd;
                if($jobLic->is_stoped==1){
                    return 'مغلقة';
                }else if($isSertEnd==false){
                    return 'منتهية';
                }else{
                    return 'فعالة';
                }
    
            })->addColumn('isSertEnd', function ($jobLic) {
    
                $carbon = new Carbon($jobLic->end_date);
                $nowDate = Carbon::now();
                $isSertEnd = $carbon->gt($nowDate);
                return $isSertEnd;
            })
            ->make(true);
        }else{
            if($from != '' && $to != ''){
                $jobLic=$jobLic->whereBetween('joblic.start_date',[$from,$to]);
            }
            $jobLic=$jobLic->get();
            return DataTables::of($jobLic)
            ->addIndexColumn()
            ->addColumn('statuse', function ($jobLic) {
    
                $carbon = new Carbon($jobLic->end_date);
                $nowDate = Carbon::now();
                $isSertEnd = $carbon->gt($nowDate);
                $jobLic->isSertEnd=$isSertEnd;
                if($jobLic->is_stoped==1){
                    return 'مغلقة';
                }else if($isSertEnd==false){
                    return 'منتهية';
                }else{
                    return 'فعالة';
                }
    
            })->addColumn('isSertEnd', function ($jobLic) {
    
                $carbon = new Carbon($jobLic->end_date);
                $nowDate = Carbon::now();
                $isSertEnd = $carbon->gt($nowDate);
                return $isSertEnd;
            })
            ->make(true);
        }
        
        
        
        
    }
    
    
    // if($request->statuse==1){
    //         $jobLic=$jobLic->whereBetween('jobLic.start_date',[$from,$to])->get();
    //         $res=array();
    //         foreach($jobLic as $job ){
    //           $carbon = new Carbon($job->end_date);
    //             $nowDate = Carbon::now();
    //             $isSertEnd = $carbon->gt($nowDate);
    //             $job->isSertEnd=$isSertEnd;
                
    //             if($job->is_stoped != 1 && $isSertEnd!=false){
    //                 $job->statuse='فعالة';
    //                 array_push($res,$job);
    //             }
    //       }
    //       return DataTables::of($res)
    //         ->addIndexColumn()->make(true);
            
    //     }else
}
