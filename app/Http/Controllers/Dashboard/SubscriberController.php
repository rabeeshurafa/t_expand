<?php



namespace App\Http\Controllers\Dashboard;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Orgnization;

use App\Models\City;

use App\Models\Group;

use App\Models\JobTitle;

use App\Models\Address;

use App\Models\User;

use App\Models\Town;

use App\Models\Region;

use App\Http\Requests\DepartmentRequest;

use App\Http\Requests\SubscribertRequest;

use Yajra\DataTables\DataTables;

use App\Models\Archive;

use App\Models\ArchiveLicense;

use App\Models\Setting;

use App\Models\jobLicArchieve;

use App\Models\License;

use App\Models\CopyTo;

use App\Models\linkedTo;

use App\Models\elec;
use App\Models\File;
use App\Models\AgendaDetail;
use App\Models\AgendaTopic;
use App\Models\AgendaExtention;
use App\Models\AppTicket1;
use App\Models\AppTicket2;
use App\Models\AppTicket3;
use App\Models\AppTicket4;
use App\Models\AppTicket5;
use App\Models\AppTicket6;
use App\Models\AppTicket7;
use App\Models\AppTicket8;
use App\Models\AppTicket10;
use App\Models\AppTicket9;
use App\Models\AppTicket11;
use App\Models\AppTicket12;
use App\Models\AppTicket13;
use App\Models\AppTicket14;
use App\Models\AppTicket15;
use App\Models\AppTicket16;
use App\Models\AppTicket17;
use App\Models\AppTicket18;
use App\Models\AppTicket19;
use App\Models\AppTicket20;
use App\Models\AppTicket21;
use App\Models\AppTicket22;
use App\Models\AppTicket23;
use App\Models\AppTicket24;
use App\Models\AppTicket25;
use App\Models\AppTicket26;
use App\Models\AppTicket27;
use App\Models\AppTicket28;
use App\Models\AppTicket29;
use App\Models\AppTicket30;
use App\Models\AppTicket31;
use App\Models\AppTicket32;
use App\Models\AppTicket33;
use App\Models\AppTicket34;
use App\Models\AppTicket35;
use App\Models\AppTicket36;
use App\Models\AppTicket39;
use App\Models\AppTicket40;
use App\Models\TradeArchive;
use Yajra\DataTables\Services\DataTable;
use App\Models\water;
use App\Models\Constant;
use App\Models\Admin;
use App\Models\Cert;
use App\Models\jobLic;
use App\Models\CertExtention;
use App\Models\Warning;
use App\Models\Merge;
use App\Models\Smslog;
use Illuminate\Support\Carbon;
use DB;
use App\Models\Earh_lic;

class SubscriberController extends Controller

{

    public function index(){

        $orgInfo=Orgnization::get()->where('enabled',1)->first();

        $city = City::get();
        
        $admins = Admin::where('enabled',1)->get();
        
        $groups = Constant::where('parent',75)->where('status',1)->get();

        $jobTitle = Constant::where('parent',74)->where('status',1)->get();

        $type="subscriber";

        $setting = Setting::first();

        $address = Address::where('id',$setting->address_id)->first();

        $town = Town::where('city_id',$setting->city_id)->get();

        $region = Region::get();

        return view('dashboard.subscriber.index',compact('city','groups','town','region',

        'jobTitle','type','setting','address','orgInfo','admins'));    

    }
    
    public function printElec(Request $request){
        $elecController = new ElecController();
        $elecs= $elecController->elec_info_byUser($request)->original['info'];
        // dd($elecs);
        return view('dashboard.subscriber.printElecSubscription',compact('elecs'));    
    }
    public function printWater(Request $request){
        $waterController = new WaterController();
        $waters= $waterController->water_info_byUser($request)->original['info'];
        // dd($elecs);
        return view('dashboard.subscriber.printWaterSubscription',compact('waters'));    
    }

    public function store_subscriber (SubscribertRequest $request){

        if($request->subscriber_id == null){
            
            $national_id = User::where('national_id',$request->formDataNationalID)->where('enabled','1')->first();
            if($national_id!=null&&$request->formDataNationalID!=null){
                return response()->json(['status'=>false,'errors'=>array('national_id'=>array('رقم الهوية مكرر'))]);
            }
            
        }else{
            
            $national_id = User::where('national_id',$request->formDataNationalID)->where('enabled','1')->where('id', '!=' , $request->subscriber_id)->first();
            if($national_id!=null&&$request->formDataNationalID!=null){
                return response()->json(['status'=>false,'errors'=>array('national_id'=>array('رقم الهوية مكرر'))]);
            }
        }
        
        
        if($request->subscriber_id == null){
            
            $user = new User();

            $user->model = "App\Models\User";

            $user->name = $request->formDataNameAR;

            $user->url =  "subscribers";
            
            $user->town_id = $request->town_id;

            $user->city_id = $request->city_id;

            $user->region_id = $request->region_id;

            $user->details = $request->AddressDetails;

            $user->notes = $request->Note;


            $user->add_by = Auth()->user()->id;

            $user->phone_one = $request->formDataMobileNo1;

            $user->phone_two = $request->formDataMobileNo2;

            $user->national_id = $request->formDataNationalID;
            $user->passport_number = $request->passport_number;

            $user->cutomer_num = $request->formDataCutomerNo;

            $user->bussniess_name = $request->formDataBussniessName;

            $user->email  = $request->formDataEmailAddress;

            $user->username = $request->username;

            $user->password = $request->password ? bcrypt($request->password) : null;

            $user->group_id  = $request->formDataIndustryID;

            $user->job_title_id  = $request->formDataProfessionID;

            // $user->addresse_id   = $address->id;
            
            $user->allowed_emp   = json_encode($request->allowedEmp);

            $user->save();

         }else{

            $user = User::find($request->subscriber_id);

            // $address = Address::where('id',$user->addresse_id)->first();

            //dd(sizeof());

            /*if(!isset($address->town_id))

             dd($request->town_data);*/

            // $address->town_id = $request->town_id;

            // $address->city_id = $request->city_id;

            // $address->region_id = $request->region_id;

            // $address->details = $request->AddressDetails;

            // $address->notes = $request->Note;

            // $address->save();

            $user->name = $request->formDataNameAR;
            
            $user->allowed_emp   = json_encode($request->allowedEmp);
            
            $user->phone_one = $request->formDataMobileNo1;
            
            $user->town_id = $request->town_id;

            $user->city_id = $request->city_id;

            $user->region_id = $request->region_id;

            $user->details = $request->AddressDetails;

            $user->notes = $request->Note;


            $user->phone_two = $request->formDataMobileNo2;

            $user->national_id = $request->formDataNationalID;
            $user->passport_number = $request->passport_number;

            $user->cutomer_num = $request->formDataCutomerNo;

            $user->bussniess_name = $request->formDataBussniessName;

            $user->email  = $request->formDataEmailAddress;

            $user->username = $request->username;

            if($request->password){

                $user->password = bcrypt($request->password);

            }else{

                $user->password = $user->password;

            }

            $user->group_id  = $request->formDataIndustryID;

            $user->job_title_id  = $request->formDataProfessionID;

            $user->save();

         }

         if ($user) {



            // return response()->json(['success'=>trans('admin.subscriber_added')]);
            return response()->json(['status'=>true,'errors'=>array('fileNo'=>array('تمت الإضافة بنجاح'))]);

        }

     

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public function subscribe_auto_complete(Request $request){

        $subscriber_data = $request['term'];

        $names = User::where('name', 'like', '%' . $subscriber_data . '%')->where('enabled',1)->select('*', 'name as label')->get();

        //$html = view('dashboard.component.auto_complete', compact('names'))->render();

        //dd($names);

        return response()->json($names);

    }

    public function subscribe_delete(Request $request)
    {
        // dd($request->all());
        $user= User::find($request['subscribe_id']);
        $user->deleted_by = Auth()->user()->id;
        $user->enabled=0;
        // dd($user->all());
        $user->save();
        
        $licenses=  license::where('user_id', $user->id)->get();
        foreach($licenses as $license){
            $license->deleted_by = Auth()->user()->id;
            $license->enabled=0;
            $license->save();
        }
        $elecs=  elec::where('user_id', $user->id)->get();
        foreach($elecs as $elec){
            $elec->deleted_by = Auth()->user()->id;
            $elec->enabled=0;
            $elec->save();
        }
        $waters=  water::where('user_id', $user->id)->get();
        foreach($waters as $water){
            $water->deleted_by = Auth()->user()->id;
            $water->enabled=0;
            $water->save();
        }


        $licArchives=  ArchiveLicense::where('model_id', $user->id)->where('model_name', 'App\\Models\\User')->get();
        foreach($licArchives as $licArchive){
            $licArchive->deleted_by = Auth()->user()->id;
            $licArchive->enabled=0;
            $licArchive->save();
        }
        $jobLicArchieves=  jobLicArchieve::where('model_id', $user->id)->where('model_name', 'App\\Models\\User')->get();
        foreach($jobLicArchieves as $jobLicArchieve){
            $jobLicArchieve->deleted_by = Auth()->user()->id;
            $jobLicArchieve->enabled=0;
            $jobLicArchieve->save();
        }

        $archives=  Archive::where('model_id', $user->id)->where('model_name', 'App\\Models\\User')->get();
        foreach($archives as $archive){
            $copyTo=CopyTo::where('archive_id',$archive->id)->get();
            foreach($copyTo as $copy){
                $copy->deleted_by = Auth()->user()->id;
                $copy->enabled = 0;
                $copy->save();
            }

            $archive->deleted_by = Auth()->user()->id;
            $archive->enabled=0;
            $archive->save();
        }

        $copyTo=CopyTo::where('model_id', $user->id)->where('model_name', 'App\\Models\\User')->get();
        foreach($copyTo as $copy){
            $copy->deleted_by = Auth()->user()->id;
            $copy->enabled = 0;
            $copy->save();
        }

        if ($user) {



            return response()->json(['success'=>trans('admin.subscriber_added')]);

        }

     

        return response()->json(['error'=>$validator->errors()->all()]);
       
    }
    
    function masterQuery($where='',$ticketFiltter='',$json_ticketFiltter=''){
        $sql="";
        // $lastTicket= LastTicket::find(1);
        for($i=1;$i<=27;$i++){
            // if($i==3||$i==23) continue;
            if($i==1)
                $sql.=" SELECT `id`, 1 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` $ticketFiltter";
            else if($i==19)
                $sql.=" UNION SELECT `id`, 2 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` $ticketFiltter".$json_ticketFiltter;
            else
                $sql.=" UNION SELECT `id`, 2 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` $ticketFiltter";
        }
        $sql.=" UNION SELECT `id`, 2 related, `active_trans`, `ticket_status` FROM `app_ticket29s` $ticketFiltter";
        return "select * from (".$sql.") a ".$where;
    }
   
    public function getUserTicket(Request $request){
        $ticketFiltter='where 1 ';
        $ticketFiltter.=' and customer_id='.$request['subscribe_id'];
        $json_ticketFiltter=''/*' or json_contains(`beneficiaries_id`,"\"'.$request['subscribe_id'].'\"","$")=1 '*/;
        $activeRec= $this->masterQuery(" where app_trans.id = a.active_trans ",$ticketFiltter,$json_ticketFiltter);
        $res=DB::select("SELECT app_trans.*,admins.nick_name,admins.image FROM `app_trans` join admins on app_trans.sender_id=admins.id WHERE  EXISTS ($activeRec) order by id desc");
        $arr=array();
        for($i=0;$i<count($res);$i++){
            
            $ticket=DB::select("SELECT `app_ticket".$res[$i]->related."s`.*, admins.nick_name  FROM `app_ticket".$res[$i]->related."s` join admins on `app_ticket".$res[$i]->related."s`.created_by=admins.id where  `app_ticket".$res[$i]->related."s`.id=".$res[$i]->ticket_id);
            
            if($ticket){
                
                $ticket['trans']=$res[$i];
                $ticket['config']=DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type)[0];
                if($res[$i]->related==23){
                    $name=Constant::where('id',$ticket[0]->task_type)->first();
                    if($name!=null){
                        $ticket['config']->ticket_name=$name->name;
                    }
                }
                // $ticket['response']=DB::select("SELECT app_responses.*,admins.nick_name,admins.image,t_constant.name FROM `app_responses` join admins join t_constant on app_responses.created_by=admins.id and app_responses.i_status=t_constant.id  where trans_id=".$res[$i]->id." order by id desc limit 1");

                $arr[]=$ticket;
            }
        }
        return $arr;
    }
    
    public function getUserData (Request $request){

        $user['info'] = User::find($request['subscribe_id']);
        
        $user['allowedEmp']=json_decode($user['info']->allowed_emp);
        
        $user['allAdmin'] =Admin::where('enabled','1')->get();

        $model = $user['info']->model;

        $ArchiveCount = count(Archive::where('model_id',$request['subscribe_id'])->where('enabled',1)

        ->where('model_name',$model)->get());

        // $Archive =Archive::where('model_id',$request['subscribe_id'])->where('enabled',1)

        // ->where('model_name',$model)->with('files')->with('archiveType')->with('copyTo')->with('Admin')->orderBy('archives.date', 'DESC')->get();

        

        $user['outArchiveCount'] = count(Archive::where('model_id',$request['subscribe_id'])->where('enabled',1)

        ->where('model_name',$model)->where('type','outArchive')->get());

        $user['inArchiveCount']  = count(Archive::where('model_id',$request['subscribe_id'])->where('enabled',1)

        ->where('model_name',$model)->where('type','inArchive')->get());

        $user['otherArchiveCount']  = Archive::where('model_id',$request['subscribe_id'])->where('enabled',1)

        ->where('model_name',$model)->whereNotIn('type', ['outArchive','inArchive','contractArchive'])->count();
        
        $user['certCount'] =Cert::where('citizen_id',$request['subscribe_id'])->where('t_farfromcenter.e_type','!=',4)->count();
        $user['warningCount'] =Cert::where('citizen_id',$request['subscribe_id'])->where('t_farfromcenter.e_type',4)->count();

        $user['licArchiveCount'] = count(ArchiveLicense::where('model_id',$request['subscribe_id'])->where('enabled',1)

        ->where('model_name',$model)->where('type','licArchive')->get());

        $user['licFileArchiveCount'] = count(ArchiveLicense::where('model_id',$request['subscribe_id'])->where('enabled',1)

        ->where('model_name',$model)->where('type','licFileArchive')->get());

        $user['copyToCount']  = count(CopyTo::where('model_id',$request['subscribe_id'])->where('enabled',1)

        ->where('model_name',$model)->get());

        $user['linkToCount']  = count(AgendaTopic::where('connected_to',$request['subscribe_id'])

        ->where('model',$model)->get());
        
        $user['tradeArchiveCount'] = TradeArchive::where('model_id', $request['subscribe_id'])->where('enabled', 1)
            ->where('model_name', $model)->count();

        $user['licCount'] = count(license::where('user_id','=',$request['subscribe_id'])->where('enabled',1)->get());

        $user['waterCount'] = count(water::where('user_id','=',$request['subscribe_id'])->where('enabled',1)->get());

        $user['elecCount']= count(elec::where('user_id','=',$request['subscribe_id'])->where('enabled',1)->get());

        // $ArchiveLic =ArchiveLicense::where('model_id',$request['subscribe_id'])

        // ->where('model_name',$model)->with('files')->get();

        // $ArchiveLic = ArchiveLicense::where('model_id',$request['subscribe_id'])->where('enabled',1)

        // ->where('model_name',$model)->select('archive_licenses.*', 't_constant.name as license_type_name')

        // ->leftJoin('t_constant', 't_constant.id', 'archive_licenses.license_id')->get();

        // foreach($ArchiveLic as $row){

        //     $attach=json_decode($row->json_feild);

        //     foreach($attach as $key=>$value){

        //         foreach((array) $value as $key=>$val){

        //             $temp=array();

        //             $temp['real_name']=$key;

        //             $temp['url']=$val;

        //         }

        //         //dd($temp);

        //         $row->files[]=$temp;

        //     }

        // }

        // $user['ArchiveLic'] = $ArchiveLic;

        $ArchiveLicCount =count(ArchiveLicense::where('model_id',$request['subscribe_id'])->where('enabled',1)

        ->where('model_name',$model)->get());

        $ArchiveJobLic =jobLicArchieve::where('model_id',$request['subscribe_id'])->where('enabled',1)

        ->where('model_name',$model)

        ->select('job_lic_archieves.*')

        ->where('job_lic_archieves.enabled',1)

        ->with('craftType')
        
        ->with('licenseRating')

        ->with('files')->get();
        
        $jobLic=jobLic::where('user_id',$request['subscribe_id'])->get();
        foreach($jobLic as $job){
            $carbon = new Carbon($job->end_date);
            $nowDate = Carbon::now();
            // dd($carbon,$nowDate);
            $isSertEnd = $carbon->gt($nowDate);
             $cost=0;
            if($isSertEnd==false){
               $res= $carbon->diffInDays($nowDate, false);
               $years=intval($res/365);
               $years+=(($res%365)>0?1:0);
               
               $setting = Setting::first();
               $cost=($setting->job_lic_cost*$years);
            //   dd($setting->job_lic_cost,$cost,$years);
               $job['years']=$years;
               $job['cost']=$cost;
            }else{
                $job['years']=0;
                $job['cost']=0;
            }
            $job['statuse']=$isSertEnd;
        }

        $user['ArchiveJobLic'] = $ArchiveJobLic;
        $user['JobLic'] = $jobLic;

        $ArchiveJobLicCount =count(jobLicArchieve::where('model_id',$request['subscribe_id'])->where('enabled',1)

        ->where('model_name',$model)->get());

        $user['ArchiveJobLicCount'] = $ArchiveJobLicCount;
        $user['JobLicCount'] = sizeof($jobLic);

        // $user['Archive'] = $Archive;

        // $CopyTo = CopyTo::where('model_id',$request['subscribe_id'])->where('enabled',1)

        // ->where('model_name',$model)->with('archive','archive.files')->with('archive','archive.admin')->get();

        // $user['copyTo'] = $CopyTo;

        $jalArchiveCount = count(AgendaTopic::where('connected_to',$request['subscribe_id'])
        ->where('model',$model)->get());

        // $jalArchive = AgendaTopic::with('AgendaDetail')->with('AgendaDetail.AgendaExtention')->with('AgendaDetail.AgendaExtention.Admin')
        // ->where('connected_to',$request['subscribe_id'])
        // ->where('model',$model)->get();
        // foreach($jalArchive as $row)
        //             {
        //                     if($row->file_ids!="null"){
        //                         $row->setAttribute('files',File::whereIn('id',json_decode($row->file_ids))->get());
        //                     }
        //                     else
        //                     {
        //                         $row->setAttribute('files',array());
        //                     }
        //             }
        // $user['jalArchive'] = $jalArchive;

        $jalArchiveCount = count(AgendaTopic::where('connected_to',$request['subscribe_id'])

        ->where('model',$model)->get());

        $user['contractArchiveCount']  = count(Archive::where('model_id',$request['subscribe_id'])->where('enabled',1)
        ->where('model_name',$model)->where('type', 'contractArchive')->get());

        $CopyToCount = count(CopyTo::where('model_id',$request['subscribe_id'])->where('enabled',1)

        ->where('model_name',$model)->get());



        if($user['info']->job_title_id){

            $user['job_title'] = Constant::where('id',$user['info']->job_title_id)->first()->name;

        }

        if($user['info']->group_id){

            $user['group'] = Constant::where('id',$user['info']->group_id)->first()->name;

        }

        // if($user['info']['addresse_id']){

        //     $user['address'] = Address::where('id', $user['info']['addresse_id'])->first();

        // }
        $user['EarchLicCount'] = Earh_lic::whereJsonContains('id2',strval($request['subscribe_id']))->where('enabled',1)->count();
        $user['ArchiveCount'] = $ArchiveCount + $CopyToCount +$ArchiveLicCount+$jalArchiveCount+$user['certCount']+$user['warningCount']+$user['EarchLicCount']+ $user['tradeArchiveCount'];

        // $user['job_title'] = JobTitle::where('id',$user['info']->job_title_id)->first()->name;

        // $user['group'] = Group::where('id',$user['info']->group_id)->first()->name;

        // $user['address'] = Address::where('id', $user['info']['addresse_id'])->first();

        if(isset($user['info']->city_id)){

            $user['city'] =City::where('id',$user['info']->city_id)->first()->name;
        }

        else{

        $user['city']= '';

        // $user['address']['details']='';

        // $user['address']['notes']='';

        }

        if(isset($user['info']->town_id)){

            $user['town'] =Town::where('id',$user['info']->town_id)->first()->name;

        }

        else
        $user['town']='';

        if(isset($user['info']->region_id)){

            $user['region'] =Region::where('id',$user['info']->region_id)->first()->name;
        }

        else{
        $user['region']='';
        }

        return $user;



    }
    
    public function subscribe_info(Request $request)
    {
        $user['info'] = User::find($request['subscribe_id']);
        $user['allowedEmp']=json_decode($user['info']->allowed_emp);
        
        if($user['allowedEmp']!=null){
            for($i=0; $i < sizeof($user['allowedEmp']) ;$i++){
                if($user['allowedEmp'][$i] == Auth()->user()->id){
                    $res=$this->getUserTicket($request);
                    // dd($res);
                    $user=$this->getUserData($request);
                    $user['tikets']=$res;
                    return response()->json($user);
                    
                }
            }
        }else{ 
            $res=$this->getUserTicket($request);
            $user=$this->getUserData($request);
            $user['tikets']=$res;
            return response()->json($user);
            
        }
            
        return response()->json(['status'=>false,'errors'=>array('not_allowed'=>array('ليس لديك صلاحية لعرض هذا المواطن'))]);
        
    }
    
    public function subscriber_tasks(Request $request){
        $user['info'] = User::find($request['subscribe_id']);
        $res=$this->getUserTicket($request);
        $user['tikets']=$res;
        if($user)
            return response()->json($user);
        else{
            return response()->json(['status'=>false,'errors'=>array('not_allowed'=>array('ليس لديك صلاحية لعرض هذا المواطن'))]);
        }
    }
    
    public function subscriberOutArchive(Request $request){
        $Archive =Archive::select('archives.*', 't_constant.name as type_id_name')
        ->where('enabled',1)
        ->where('model_id',$request['subscriber_id'])
        ->where('model_name','App\\Models\\User')
        ->where('type','outArchive')
        ->leftJoin('t_constant', 't_constant.id', 'archives.type_id')
        ->with('archiveType')->with('files')->with('copyTo')->with('Admin')->orderBy('archives.date', 'ASC')->get();

        return DataTables::of($Archive)

        ->addIndexColumn()

        ->make(true);

    }

    public function subscriberInArchive(Request $request){
        $Archive =Archive::select('archives.*', 't_constant.name as type_id_name')
        ->where('enabled',1)
        ->where('model_id',$request['subscriber_id'])
        ->where('model_name','App\\Models\\User')
        ->where('type','inArchive')
        ->leftJoin('t_constant', 't_constant.id', 'archives.type_id')
        ->with('archiveType')->with('files')->with('copyTo')->with('Admin')->orderBy('archives.date', 'ASC')->get();

        return DataTables::of($Archive)

        ->addIndexColumn()

        ->make(true);

    }
    
    public function subscriberCert(Request $request){
        $cert =Cert::select('t_farfromcenter.*', 't_certification.s_name_ar as type_id_name')
        ->where('citizen_id',$request['subscriber_id'])
        ->where('t_farfromcenter.e_type','!=',4)
        ->leftJoin('t_certification', 't_certification.pk_i_id', 't_farfromcenter.msgTitle')->with('Admin')->orderBy('t_farfromcenter.cer_date', 'DESC')->get();

        return DataTables::of($cert)

        ->addIndexColumn()

        ->make(true);

    }
    
    public function subscriberWarning(Request $request){
        $cert =Cert::select('t_farfromcenter.*', 't_certification.s_name_ar as type_id_name')
        ->where('citizen_id',$request['subscriber_id'])
        ->where('t_farfromcenter.e_type',4)
        ->leftJoin('t_certification', 't_certification.pk_i_id', 't_farfromcenter.msgTitle')->with('Admin')->orderBy('t_farfromcenter.cer_date', 'DESC')->get();

        return DataTables::of($cert)

        ->addIndexColumn()

        ->make(true);

    }
    
    public function subscriberLicArchive(Request $request){
        
       $ArchiveLic = ArchiveLicense::where('model_id',$request['subscriber_id'])->where('enabled',1)

        ->where('model_name','App\\Models\\User')->with('License')->select('archive_licenses.*', 't_constant.name as license_type_name')

        ->leftJoin('t_constant', 't_constant.id', 'archive_licenses.license_id')->get();
        foreach ($ArchiveLic as $row) {
            $attach = json_decode($row->json_feild);
            $files = array();
            foreach ($attach as $id) {
                $temp=(array) $id;
                $file = File::find($id->id);
                $file->real_name= array_search ($file->url, $temp);
                $files[] = $file;
            }
            $row->files = $files;
        }

        return DataTables::of($ArchiveLic)

        ->addIndexColumn()

        ->make(true);

    }
    
    public function subscriberTradeArchive(Request $request)
    {

        $Archive = TradeArchive::where('model_id', $request['subscriber_id'])->where('enabled', 1)
            ->where('model_name', 'App\\Models\\User')->with('Admin')->with('Type')->get();

        foreach ($Archive as $row) {
            $attach = json_decode($row->json_feild);
            $attachIds = json_decode($row->attach_ids) ?? array();
            $rawFiles=File::whereIn('id',$attachIds)->get();
            $count = sizeof($attachIds);
            $i = 0;
            $files = array();
            foreach ($attach as $key => $value) {
                // dd($value);

                foreach ((array) $value as $key => $val) {
                    $temp = array();
                    if ($i < $count) {
                        $temp['id'] = $attachIds[$i];
                        $temp['file_links'] = $rawFiles[$i]->file_links;
                        $i++;
                    } else {
                        $temp['id'] = 0;
                        $temp['file_links'] = [];
                    }
                    $temp['real_name'] = $key;
                    $temp['url'] = $val;


                }
                array_push($files, $temp);

                // dd($temp);


            }
            $row['arch_files'] = $files;
        }

        return DataTables::of($Archive)
            ->addIndexColumn()
            ->make(true);

    }

    public function subscriberCopyArchive(Request $request){

        $Archive = CopyTo::where('model_id',$request['subscriber_id'])->where('enabled',1)
        ->where('model_name','App\\Models\\User')->with('archive','archive.files')->with('archive','archive.Admin')->get();

        return DataTables::of($Archive)

        ->addIndexColumn()

        ->make(true);

    }

    public function subscriberJalArchive(Request $request){
    
        $Archive = AgendaTopic::with('AgendaDetail')->with('AgendaDetail.AgendaExtention')->with('AgendaDetail.AgendaExtention.Admin')
        ->where('connected_to',$request['subscriber_id'])
        ->where('model','App\\Models\\User')->get();
        foreach($Archive as $row)
        {
            if($row->file_ids!="null"){
                $row->setAttribute('files',File::whereIn('id',json_decode($row->file_ids))->get());
            }
            else
            {
                $row->setAttribute('files',array());
            }
        }
        // dd($Archive->all());
        return DataTables::of($Archive)

        ->addIndexColumn()

        ->make(true);

    }

    public function subscriberOtherArchive(Request $request){

        $Archive =Archive::select('archives.*', 't_constant.name as type_id_name')
        ->where('enabled',1)
        ->where('model_id',$request['subscriber_id'])
        ->where('model_name','App\\Models\\User')
        ->whereNotIn('type', ['outArchive','inArchive','contractArchive'])
        ->leftJoin('t_constant', 't_constant.id', 'archives.type_id')
        ->with('archiveType')->with('files')->with('copyTo')->with('Admin')->orderBy('archives.date', 'ASC')->get();

        return DataTables::of($Archive)

        ->addIndexColumn()

        ->make(true);

    }

    public function subscribercontractArchive(Request $request){
        $Archive =Archive::select('archives.*', 't_constant.name as type_id_name')
        ->where('enabled',1)
        ->where('model_id',$request['subscriber_id'])
        ->where('type','contractArchive')
        ->where('model_name','App\\Models\\User')
        ->leftJoin('t_constant', 't_constant.id', 'archives.type_id')
        ->with('archiveType')->with('copyTo')->with('files')->with('Admin')->orderBy('archives.date', 'ASC')->get();

        return DataTables::of($Archive)

        ->addIndexColumn()

        ->make(true);

    }
    
    public function subscriberEarh_lic(Request $request){
        
        $res= Earh_lic::whereJsonContains('id2',strval($request['subscriber_id']))->where('enabled',1)->with('Admin')->orderBy('date', 'ASC')->get();
        // dd($res);
        foreach($res as $row){
    	    $row['user_name']=json_decode($row->user_name);
    	    $row['hod_no']=json_decode($row->hod_no);
    	    $row['pice_no']=json_decode($row->pice_no);
    	    $row['user_national']=json_decode($row->user_national);
    	    $row['notes1']=json_decode($row->notes1);
    	    $row['notes2']=json_decode($row->notes2);
            
        }
        // $Archive =Archive::select('archives.*', 't_constant.name as type_id_name')
        // ->where('enabled',1)
        // ->where('model_id',$request['subscriber_id'])
        // ->where('model_name','App\\Models\\User')
        // ->where('type','outArchive')
        // ->leftJoin('t_constant', 't_constant.id', 'archives.type_id')
        // ->with('archiveType')->with('files')->with('copyTo')->with('Admin')->orderBy('archives.date', 'ASC')->get();

        return DataTables::of($res)

        ->addIndexColumn()

        ->make(true);

    }
    
    public function subscribe_info_all(Request $request) {

        $users= User::select('users.*','regions.name as region_name','cities.name as city_name',

        'towns.name as town_name','b.name as job_title_name','a.name as group_name')
        
        ->leftJoin('t_constant as b', 'b.id', 'users.job_title_id')

        ->leftJoin('t_constant as a', 'a.id', 'users.group_id')

        ->leftJoin('regions','users.region_id','regions.id')

        ->leftJoin('cities','users.city_id','cities.id')

        ->leftJoin('towns','users.town_id','towns.id')->where('users.enabled','1')->search($request)->orderBy('users.id', 'DESC');

        return DataTables::of($users)->addIndexColumn() ->make(true);

    }
    
    function sendForOne($request){
       $setting=Setting::find(13);
        $str1 = $request->smsNo;
        $pattern = "/\d{10}/";
        $mob='';
        $error=false;
        if( preg_match($pattern,$str1, $match) ){
            if(strlen($match[0])==10)
              $mob= substr ( $match[0] , 1,9);
            else
                $error= true;
        }
        else $error= true;
        
        $username=urlencode('Expand.ps');
        $password=urlencode('9836960');
        $sender  =urlencode('Expand.ps');
        $match=array();
        $message1=urlencode($request->smsText."-".$setting->name_ar);
        if(/*Auth()->user()->id == 74 ||*/ $error){
            $result=4004;
        }else{
            $result= file_get_contents("http://hotsms.ps/sendbulksms.php?user_name=".$username."&user_pass=".$password."&sender=".$sender."&mobile=$mob&type=2&text=".$message1);
        }
        $smslog= new Smslog();
        $smslog->sender=Auth()->user()->id;
        $smslog->txt=$request->smsText."-".$setting->name_ar;
        $smslog->s_mobile=$mob;
        $smslog->reciver_name=$request->subscriber_name;
        // $smslog->member_no=$request->member_no;
        $smslog->status=$result;
        $smslog->type=2;
        $smslog->save();
        if($result){
            return $result;  
        }else{
            return 4004;
        } 
    }
    
    function sendSMS(Request $request){
        
        if($request->sendForAll==1){
            return $this->sendForOne($request);
        }else if($request->sendForAll==2){
            $successSent=0;
            $failedSent=0;
            if($request->search!=null){
                $regions = Region::where('status',1)->where('name', 'like', '%' . trim($request->search) . '%')->get("id");
                $subscribers = User::where('enabled',1)->whereIn('region_id',$regions)->get();
            }else{
                $subscribers = User::where('enabled',1)->get();
            }
            foreach($subscribers as $subscriber){
                $request->smsNo=$subscriber->phone_one;
                $request->subscriber_name=$subscriber->name;
                $request->member_no=$subscriber->cutomer_num;
                $res=$this->sendForOne($request);
                if($res!=1001){
                    $request->smsNo=$subscriber->phone_two;
                    $res=$this->sendForOne($request);
                }
                ($res==1001)?$successSent++:$failedSent++;
            }
            return response()->json(['successSent'=>$successSent,'failedSent'=>$failedSent]);
        }
        return 4004;
    }

    public function subscriber($id){

        $subscriber = User::find($id);

        $city = City::get();

        $groups = Constant::where('parent',75)->where('status',1)->get();

        $jobTitle = Constant::where('parent',74)->where('status',1)->get();

        $type="subscriber";

        return view('dashboard.subscriber.show',compact('city','groups','jobTitle','type','subscriber')); 

    }
    
    public function mergeSubscribers(Request $request){
        // dd($request->all());
        
        if($request->superMergerID == null && $request->superMergerID == 0){
            return response()->json(['error'=>'No Super']);
        }
        if($request->mergerID==null){
           return response()->json(['error'=>'No subsriber']); 
        }
        
        $super = User::find($request->superMergerID);
        $mergeNote="تم دمج المواطنين ( ";
        if($super != null){
            $usersToMerge=User::whereIn('id',$request->mergerID)->get();
            
            if($usersToMerge != null){
                /////////////////////////// if super data is null take from other/////////////////////
                foreach($usersToMerge as $user){
                    $super->phone_one       = ($super->phone_one      ?? $user->phone_one);
                    $super->town_id         = ($super->town_id        ?? $user->town_id);
                    $super->city_id         = ($super->city_id        ?? $user->city_id);
                    $super->region_id       = ($super->region_id      ?? $user->region_id);
                    $super->details         = ($super->details        ?? $user->details);
                    $super->notes           = ($super->notes          ?? $user->notes);
                    $super->phone_two       = ($super->phone_two      ?? $user->phone_two) ;
                    $super->national_id     = ($super->national_id    ?? $user->national_id);
                    $super->cutomer_num     = ($super->cutomer_num    ?? $user->cutomer_num);
                    $super->bussniess_name  = ($super->bussniess_name ?? $user->bussniess_name);
                    $super->email           = ($super->email          ?? $user->email);
                    $super->username        = ($super->username       ?? $user->username);
                    $super->group_id        = ($super->group_id       ?? $user->group_id);
                    $super->job_title_id    = ($super->job_title_id   ?? $user->job_title_id);
                    $super->save();
                    $mergeNote.=$user->name." - ";
                }
                $super->notes.=$mergeNote." ) "
                ."مع هذا المواطن من قبل "
                .Auth()->user()->nick_name;
                $super->save();
                ////////////////////////////////////////////////////////////////////////////////////
                $this->mergeArchive($super,$usersToMerge,$request);
                $this->mergeTickets($super,$usersToMerge,$request);
                $this->mergeEarh_lic($super,$usersToMerge,$request);
                
                $waters     =Water::whereIn('user_id',$request->mergerID)->get();
                $elecs      =elec::whereIn('user_id',$request->mergerID)->get();
                $licens     =License::whereIn('user_id',$request->mergerID)->get();
                $jobLics    =jobLic::whereIn('user_id',$request->mergerID)->get();
                $warnings   =Warning::whereIn('subscriber_id',$request->mergerID)->get();
                $certs   =Cert::whereIn('citizen_id',$request->mergerID)->where('model',$super->model)->get();
                foreach($waters as $water){
                    $water->user_id=$super->id;
                    $water->save();
                }
                foreach($elecs as $elec){
                    $elec->user_id=$super->id;
                    $elec->save();
                }
                foreach($licens as $licen){
                    $licen->user_id=$super->id;
                    $licen->save();
                }
                foreach($jobLics as $jobLic){
                    $jobLic->user_id=$super->id;
                    $jobLic->name=$super->name;
                    $jobLic->save();
                }
                foreach($warnings as $warning){
                    $warning->subscriber_id=$super->id;
                    $warning->subscriber_name=$super->name;
                    $warning->save();
                }
                foreach($certs as $cert){
                    $cert->citizen_id=$super->id;
                    $cert->citizen_name=$super->name;
                    $cert->save();
                }
            }else{
                return response()->json(['error'=>'No subsriber']); 
            }
        }else{
            return response()->json(['error'=>'No Super']);
        }
        foreach($usersToMerge as $user){
            if($user->id != $super->id){
                $merge= new Merge();
                $merge->super_id    = $super->id;
                $merge->merged_id   = $user->id;
                $merge->name        = $user->name;
                $merge->phone       = $user->phone_one;
                $merge->national    = $user->national_id;
                $merge->merged_by   = Auth()->user()->id;
                $merge->save();
                $user->delete();
            }
        }
        return response()->json(['success'=>'done','super'=>$super->id]);
    }
    
    function mergeEarh_lic($super , $usersToMerge ,Request $request){
        foreach($usersToMerge as $user){
            $earh_lics  = Earh_lic::whereJsonContains('id2',strval($user->id))->get();
            
            foreach($earh_lics as $earh_lic){
                $id2s=json_decode($earh_lic->id2);
                for($i=0; $i<sizeof($id2s) ; $i++){
                    if(intval($id2s[$i]) == $user->id ){
                        $id2s[$i]=strval($super->id);
                    }
                }
                $earh_lic->id2   = json_encode($id2s);
                $earh_lic->save();
            }
        }
    }
    
    function mergeArchive($super , $usersToMerge ,Request $request){
        $agendaTopics       =AgendaTopic::whereIn('connected_to',$request->mergerID)->where('model',$super->model)->get();
        $archiveLicenses    =ArchiveLicense::whereIn('model_id',$request->mergerID)->where('model_name',$super->model)->get();
        $copyTos            =CopyTo::whereIn('model_id',$request->mergerID)->where('model_name',$super->model)->get();
        $archives           =Archive::whereIn('model_id',$request->mergerID)->where('model_name',$super->model)->get();
        foreach($agendaTopics as $agendaTopic){
            $agendaTopic->connected_to     =$super->id;
            $agendaTopic->connected_to_txt  =$super->name;
            $agendaTopic->save();
        }
        foreach($archiveLicenses as $archiveLicense){
            $archiveLicense->model_id   =$super->id;
            $archiveLicense->name       =$super->name;
            $archiveLicense->save();
        }
        foreach($copyTos as $copyTo){
            $copyTo->model_id   =$super->id;
            $copyTo->name       =$super->name;
            $copyTo->save();
        }
        foreach($archives as $archive){
            $archive->model_id   =$super->id;
            $archive->name       =$super->name;
            $archive->save();
        }
    }
    function mergeTickets($super , $usersToMerge ,Request $request){
        $AppTicket1s        =AppTicket1::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket1_1s      =AppTicket1::whereIn('owner_id',$request->mergerID)->get();
        $AppTicket2s        =AppTicket2::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket3s        =AppTicket3::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket3_1s      =AppTicket3::whereIn('owner_id',$request->mergerID)->get();
        $AppTicket4s        =AppTicket4::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket5s        =AppTicket5::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket6s        =AppTicket6::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket7s        =AppTicket7::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket8s        =AppTicket8::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket8_1s      =AppTicket8::whereIn('customer_id1',$request->mergerID)->get();
        $AppTicket8_2s      =AppTicket8::whereIn('customer_id2',$request->mergerID)->get();
        $AppTicket9s        =AppTicket9::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket10s       =AppTicket10::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket11s       =AppTicket11::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket11_1s     =AppTicket11::whereIn('customer_id1',$request->mergerID)->get();
        $AppTicket12s       =AppTicket12::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket13s       =AppTicket13::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket14s       =AppTicket14::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket15s       =AppTicket15::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket16s       =AppTicket16::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket17s       =AppTicket17::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket18s       =AppTicket18::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket19s       =AppTicket19::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket20s       =AppTicket20::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket21s       =AppTicket21::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket21_1s     =AppTicket21::whereIn('customer_id1',$request->mergerID)->get();
        $AppTicket22s       =AppTicket22::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket23s       =AppTicket23::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket24s       =AppTicket24::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket25s       =AppTicket25::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket25_1s     =AppTicket25::whereIn('customer_id1',$request->mergerID)->get();
        $AppTicket26s       =AppTicket26::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket27s       =AppTicket27::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket29s       =AppTicket29::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket34s       =AppTicket34::whereIn('customer_id',$request->mergerID)->where('customer_model',$super->model)->get();
        $AppTicket35s       =AppTicket35::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket35_1s     =AppTicket35::whereIn('customer_id1',$request->mergerID)->get();
        $AppTicket36s       =AppTicket36::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket39s       =AppTicket39::whereIn('customer_id',$request->mergerID)->get();
        $AppTicket40s       =AppTicket40::whereIn('customer_id',$request->mergerID)->get();
        
        foreach($AppTicket1s    as $AppTicket1){
            $AppTicket1->customer_id    =$super->id;
            $AppTicket1->customer_name  =$super->name;
            $AppTicket1->save();
        }
        foreach($AppTicket1_1s  as $AppTicket1_1){
            $AppTicket1_1->owner_id    =$super->id;
            $AppTicket1_1->owner_name  =$super->name;
            $AppTicket1_1->save();
        }
        foreach($AppTicket2s    as $AppTicket2){
            $AppTicket2->customer_id    =$super->id;
            $AppTicket2->customer_name  =$super->name;
            $AppTicket2->save();
        }
        foreach($AppTicket3s    as $AppTicket3){
            $AppTicket3->customer_id    =$super->id;
            $AppTicket3->customer_name  =$super->name;
            $AppTicket3->save();
        }
        foreach($AppTicket3_1s  as $AppTicket3_1){
            $AppTicket3_1->owner_id    =$super->id;
            $AppTicket3_1->owner_name  =$super->name;
            $AppTicket3_1->save();
        }
        foreach($AppTicket4s    as $AppTicket4){
            $AppTicket4->customer_id    =$super->id;
            $AppTicket4->customer_name  =$super->name;
            $AppTicket4->save();
        }
        foreach($AppTicket5s    as $AppTicket5){
            $AppTicket5->customer_id    =$super->id;
            $AppTicket5->customer_name  =$super->name;
            $AppTicket5->save();
        }
        foreach($AppTicket6s    as $AppTicket6){
            $AppTicket6->customer_id    =$super->id;
            $AppTicket6->customer_name  =$super->name;
            $AppTicket6->save();
        }
        foreach($AppTicket7s    as $AppTicket7){
            $AppTicket7->customer_id    =$super->id;
            $AppTicket7->customer_name  =$super->name;
            $AppTicket7->save();
        }
        foreach($AppTicket8s    as $AppTicket8){
            $AppTicket8->customer_id    =$super->id;
            $AppTicket8->customer_name  =$super->name;
            $AppTicket8->save();
        }
        foreach($AppTicket8_2s  as $AppTicket8_2){
            $AppTicket8->customer_id2    =$super->id;
            $AppTicket8->customer_name2  =$super->name;
            $AppTicket8->save();
        }
        foreach($AppTicket8_1s  as $AppTicket8_1){
            $AppTicket8_1->customer_id1    =$super->id;
            $AppTicket8_1->customer_name1  =$super->name;
            $AppTicket8_1->save();
        }
        foreach($AppTicket9s    as $AppTicket9){
            $AppTicket9->customer_id    =$super->id;
            $AppTicket9->customer_name  =$super->name;
            $AppTicket9->save();
        }
        foreach($AppTicket10s   as $AppTicket10){
            $AppTicket10->customer_id    =$super->id;
            $AppTicket10->customer_name  =$super->name;
            $AppTicket10->save();
        }
        foreach($AppTicket11s   as $AppTicket11){
            $AppTicket11->customer_id    =$super->id;
            $AppTicket11->customer_name  =$super->name;
            $AppTicket11->save();
        }
        foreach($AppTicket11_1s as $AppTicket11_1){
            $AppTicket11_1->customer_id1    =$super->id;
            $AppTicket11_1->customer_name1  =$super->name;
            $AppTicket11_1->save();
        }
        foreach($AppTicket12s   as $AppTicket12){
            $AppTicket12->customer_id    =$super->id;
            $AppTicket12->customer_name  =$super->name;
            $AppTicket12->save();
        }
        foreach($AppTicket13s   as $AppTicket13){
            $AppTicket13->customer_id    =$super->id;
            $AppTicket13->customer_name  =$super->name;
            $AppTicket13->save();
        }
        foreach($AppTicket14s   as $AppTicket14){
            $AppTicket14->customer_id    =$super->id;
            $AppTicket14->customer_name  =$super->name;
            $AppTicket14->save();
        }
        foreach($AppTicket15s   as $AppTicket15){
            $AppTicket15->customer_id    =$super->id;
            $AppTicket15->customer_name  =$super->name;
            $AppTicket15->save();
        }
        foreach($AppTicket16s   as $AppTicket16){
            $AppTicket16->customer_id    =$super->id;
            $AppTicket16->customer_name  =$super->name;
            $AppTicket16->save();
        }
        foreach($AppTicket17s   as $AppTicket17){
            $AppTicket17->customer_id    =$super->id;
            $AppTicket17->customer_name  =$super->name;
            $AppTicket17->save();
        }
        foreach($AppTicket18s   as $AppTicket18){
            $AppTicket18->customer_id    =$super->id;
            $AppTicket18->customer_name  =$super->name;
            $AppTicket18->save();
        }
        foreach($AppTicket19s   as $AppTicket19){
            $AppTicket19->customer_id    =$super->id;
            $AppTicket19->customer_name  =$super->name;
            $AppTicket19->save();
        }
        foreach($AppTicket20s   as $AppTicket20){
            $AppTicket20->customer_id    =$super->id;
            $AppTicket20->customer_name  =$super->name;
            $AppTicket20->save();
        }
        foreach($AppTicket21s   as $AppTicket21){
            $AppTicket21->customer_id    =$super->id;
            $AppTicket21->customer_name  =$super->name;
            $AppTicket21->save();
        }
        foreach($AppTicket21_1s as $AppTicket21_1){
            $AppTicket21_1->customer_id1    =$super->id;
            $AppTicket21_1->customer_name1  =$super->name;
            $AppTicket21_1->save();
        }
        foreach($AppTicket22s   as $AppTicket22){
            $AppTicket22->customer_id    =$super->id;
            $AppTicket22->customer_name  =$super->name;
            $AppTicket22->save();
        }
        foreach($AppTicket23s   as $AppTicket23){
            $AppTicket23->customer_id    =$super->id;
            $AppTicket23->customer_name  =$super->name;
            $AppTicket23->save();
        }
        foreach($AppTicket24s   as $AppTicket24){
            $AppTicket24->customer_id    =$super->id;
            $AppTicket24->customer_name  =$super->name;
            $AppTicket24->save();
        }
        foreach($AppTicket25s   as $AppTicket25){
            $AppTicket25->customer_id    =$super->id;
            $AppTicket25->customer_name  =$super->name;
            $AppTicket25->save();
        }
        foreach($AppTicket25_1s as $AppTicket25_1){
            $AppTicket25_1->customer_id1    =$super->id;
            $AppTicket25_1->customer_name1  =$super->name;
            $AppTicket25_1->save();
        }
        foreach($AppTicket26s   as $AppTicket26){
            $AppTicket26->customer_id    =$super->id;
            $AppTicket26->customer_name  =$super->name;
            $AppTicket26->save();
        }
        foreach($AppTicket27s   as $AppTicket27){
            $AppTicket27->customer_id    =$super->id;
            $AppTicket27->customer_name  =$super->name;
            $AppTicket27->save();
        }
        foreach($AppTicket29s   as $AppTicket29){
            $AppTicket29->customer_id    =$super->id;
            $AppTicket29->customer_name  =$super->name;
            $AppTicket29->save();
        }
        foreach($AppTicket34s   as $AppTicket34){
            $AppTicket34->customer_id    =$super->id;
            $AppTicket34->customer_name  =$super->name;
            $AppTicket34->save();
        }
        foreach($AppTicket35s   as $AppTicket35){
            $AppTicket35->customer_id    =$super->id;
            $AppTicket35->customer_name  =$super->name;
            $AppTicket35->save();
        }
        foreach($AppTicket35_1s as $AppTicket35_1){
            $AppTicket35_1->customer_id1    =$super->id;
            $AppTicket35_1->customer_name1  =$super->name;
            $AppTicket35_1->save();
        }
        foreach($AppTicket36s   as $AppTicket36){
            $AppTicket36->customer_id    =$super->id;
            $AppTicket36->customer_name  =$super->name;
            $AppTicket36->save();
        }
        foreach($AppTicket39s   as $AppTicket39){
            $AppTicket39->customer_id    =$super->id;
            $AppTicket39->customer_name  =$super->name;
            $AppTicket39->save();
        }
        foreach($AppTicket40s   as $AppTicket40){
            $AppTicket40->customer_id    =$super->id;
            $AppTicket40->customer_name  =$super->name;
            $AppTicket40->save();
        }
        
    }

}

