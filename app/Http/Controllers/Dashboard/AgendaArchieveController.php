<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Admin;
use App\Models\User;
use App\Models\AgendaDetail;
use App\Models\AgendaTopic;
use App\Models\AgendaExtention;
use Session;
use DB;
use App\Http\Requests\MeetingTitleRequest;
use Illuminate\Support\Facades\Storage;

class AgendaArchieveController extends Controller
{
    public function creatImages($images){
        $data=$images;

        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);

            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                return 0;
                // throw new \Exception('invalid image type');
            }
            $data = str_replace( ' ', '+', $data );
            $data = base64_decode($data);

            if ($data === false) {
                return 0;
                // throw new \Exception('base64_decode failed');
            }
        } else {
            return 0;
            // throw new \Exception('did not match data URI with image data');
        }
        $name='scanner'. rand(3, 999) . '-' . time();
        // file_put_contents(public_path('storage').'/'.$name. '.'.$type, $data);
        Storage::disk('s3')->put(($name.'.'.$type), $data);
        $file=new File();
        $file->real_name=$name.'.'.$type;
        $file->extension=$type;
        $file->url=Storage::cloud()->url(($name.'.'.$type));
        $file->type='2';
        $file->save();
        return $file;
    }
    public function creatPdf($images){
        $pdf_base64 = $images;
        $pdf_base64 = substr($pdf_base64, strpos($pdf_base64, ',') + 1);
        $pdf_decoded = base64_decode ($pdf_base64,true);
        if (strpos($pdf_decoded, '%PDF') !== 0) {
            return 0;
            // throw new Exception('Missing the PDF file signature');
        }

        $name='scanner'. rand(3, 999) . '-' . time();
        Storage::disk('s3')->put(($name.'.pdf'), $pdf_decoded);
        $file=new File();
        $file->real_name=$name.'.pdf';
        $file->extension='pdf';
        $file->url=Storage::cloud()->url(($name.'.pdf'));
        $file->type='2';
        $file->save();
        return $file;
    }
    
    public function saveScanedFile($type,$data){
        if($type == 'application/pdf'){
            $file=$this->creatPdf($data);
        }else{
            $file=$this->creatImages($data);
        }
        if($file){
            return $file;
        }else{
            return false;
        }
    }
    
    public function agendaAttach(Request $request){
        if($request->scannedRow > 0 && $request->mimeType != null && $request->scannedFileSrc != null){
            $file=$this->saveScanedFile($request->mimeType,$request->scannedFileSrc);
            $all_files['all_files'] =[$file];
            return response()->json($all_files); 
        }else {
            $frm=isset($request->fromname)?$request->fromname:'subject1';
            
            if ($request->hasFile($frm.'UploadFile')) {
                $files=$request->file($frm.'UploadFile');
                foreach ($files as $file)
                {
                    $url = $this->upload_image($file
                        , 'quipent_');
                    if ($url) 
                    {
                        // $uploaded_files['files'] = File::create([
                        //     'url' => $url,
                        //     'real_name' => $file->getClientOriginalName(),
                        //     'extension' => $file->getClientOriginalExtension(),
                        // ]);
                        $uploaded_files['files'] = File::create(['url' => $url['path'],'real_name' => $url['name'],'extension' => $url['extension'],'type'=>'2']);
                    }
                    $data[] = $uploaded_files;
                }
                foreach($data as $row){
                    $files_ids[] = $row['files']->id;
                }
                Session::put('files_ids', $files_ids);
    
                $all_files['all_files'] = File::whereIn('id',$files_ids)->get();
                return response()->json($all_files);
            }
        }
    }
    public function searchEmpByName(Request $request)
    {
        $emp_data = $request['term'];
        $names = Admin::where('name', 'like', '%' . $emp_data . '%')->select('*', 'name as label')->get();
        return response()->json($names);
    } 
    public function searchSubscriberByName(Request $request)
    {
        $emp_data = $request['term'];
        $names = User::where('name', 'like', '%' . $emp_data . '%')->select('*', 'name as label')->get();
        return response()->json($names);
    } 

    public function doAddMeetingTitles(Request $request){
           // dd($_POST);
        if($request->id)
            $agendaExtention=AgendaExtention::find($request->id);
        else
           $agendaExtention = new AgendaExtention();
           $agendaExtention->name = $request->name_ar1;
           $agendaExtention->employee = json_encode(($request->MemberPerIDList??array()));
           $agendaExtention->admin = $request->managerID;
           $agendaExtention->users = json_encode($request->MemberIDList);
           $agendaExtention->signature_emp = $request->signature_emp;
           $agendaExtention->signature_jobtitle = $request->signature_jobtitle;
            // dd($agendaExtention);
           $agendaExtention->save();
        if ($agendaExtention) {
            return response()->json(['status'=>trans('admin.extention_added')]);
        }else{
            return response()->json(['status'=>$validator->errors()->all()]);
        }
    }

    public function deleteMeetingTitle(Request $request){
        $data = AgendaExtention::find($request['id']);
        if($data !=null){
            $data->enabled=0;
            $data->deleted_by=Auth()->user()->id;
            $data->save();
            
            $agendaDetails=AgendaDetail::where('agenda_extention_id',$data->id)->get();
            if($agendaDetails !=null)
                foreach($agendaDetails as $agendaDetail){
                    $agendaDetail->enabled=0;
                    $agendaDetail->deleted_by=Auth()->user()->id;
                    $agendaDetail->save();
                    
                    $agendaTopics=AgendaTopic::where('detail_id',$agendaDetail->id)->get();
                    if($agendaTopics !=null)
                        foreach($agendaTopics as $agendaTopic){
                            $agendaTopic->enabled=0;
                            $agendaTopic->deleted_by=Auth()->user()->id;
                            $agendaTopic->save();
                        }
                    
                }
            
            
        }
        return response()->json(['success'=>trans('admin.meeting_deleted')]);
    }

    public function getMeetingDetailsByID(Request $request){
        $meetingTitleList = AgendaExtention::with('Admin')->findOrFail($request['id']);
        //dd($meetingTitleList);
        $data=array();
        $data['id']=$meetingTitleList->id;
        $data['name']=$meetingTitleList->name;
        $data['employee']=json_decode($meetingTitleList->employee);
        //dd(json_decode($meetingTitleList->employee));
        $empWithPriv=json_decode($meetingTitleList->employee);
        if(is_array($empWithPriv) && count($empWithPriv)>0)
            $data['employeeData']=Admin::whereIn('id',$empWithPriv)->get();
        else
            $data['employeeData']=array();
        $data['admin']=$meetingTitleList->admin;
        $data['adminData']=Admin::find($meetingTitleList->admin);
        $data['users']=json_decode($meetingTitleList->users);
        $data['usersData']=Admin::whereIn('id',is_array(json_decode($meetingTitleList->users))?json_decode($meetingTitleList->users):array())->get();
        $data['signature_emp']=$meetingTitleList->signature_emp;
        $data['signature_empData']=Admin::find($meetingTitleList->signature_emp);
        $data['signature_jobtitle']=$meetingTitleList->signature_jobtitle;
        return response()->json($data);
    }
    public function ajaxEndMeeting(Request $request){
        $meetingID=$request->meetingIDEnd;
        $res=0;
        if($meetingID!=0)
        {
        $agendaDetail = AgendaDetail::where('id','=',$meetingID)->first();
        $agendaDetail->is_closed=1;
        $res=$agendaDetail->save();
        }
        //dd($res);
        if ($res) {

            return response()->json(['success'=>'تم انهاء الجلسة']);
        }

        return response()->json(['error'=>'لم يتم انهاء الجلسة']);
       
    }
    function getAttach( $file_ids=array()){
        $attachArr=array();
        if(is_array($file_ids))
            foreach($file_ids as $row){
                $row->Files=File::where('id',$row->attach_ids)->get();
            }
        return $file_ids;
    }
    function meetingAttach(Request $request){
        $meetingID=$request->meetingID;
        $res=array();
        if($meetingID!=0)
        {
        $agendaDetail = AgendaDetail::where('id','=',$meetingID)->first();
        $res=$this->getAttach(json_decode($agendaDetail->file_ids));
        }

        return response()->json($res);
    }
    function prepearAttach(Request $request){
        $attach_ids=$request->attach_ids;
        $attachNameTemp=$request->attachName??[];
        $attachName=array();
        foreach($attachNameTemp as $name){
            if(!empty($name)){
                array_push($attachName,$name);
            }
        }
        if(sizeof($attachName) < sizeof($attach_ids)){
            $deff=sizeof($attach_ids)-sizeof($attachName);
            for($i=0 ; $i<$deff ; $i++){
                array_push($attachName,'');
            }
        }
        $attachArr=array();
        if($attach_ids)
        for($i=0;$i<sizeof($attach_ids);$i++){
            $temp=array();
            $temp['attachName']=trim($attachName[$i]);
            $temp['attach_ids']=trim($attach_ids[$i]);
            $attachArr[]=$temp;
        }
        return $attachArr;
    }
    public function attachMeeting(Request $request){
        $meetingID=$request->meetingID;
        $res=0;
        if($meetingID!=0)
        {
        $agendaDetail = AgendaDetail::where('id','=',$meetingID)->first();
        $agendaDetail->file_ids	=json_encode($this->prepearAttach($request));
        // $agendaDetail->is_closed=1;
        $res=$agendaDetail->save();
        }
        //dd($res);
        if ($res) {

            return response()->json(['success'=>'تم حفظ المرفقات']);
        }

        return response()->json(['error'=>'لم يتم الحفظ']);
       
    }
    public function ajaxDisplayMeeting(Request $request){
        
        $meetingTitleName=$request->meetingTitleName;
        $agendaNum=$request->agendaNum;
        $agendaDetail = AgendaDetail::where('agenda_extention_id','=',$meetingTitleName)->where('agenda_number','=',$agendaNum)->get()->first();
         //dd($agendaDetail);
        if($agendaDetail)
            foreach($agendaDetail->AgendaTopic as $row){
                if(is_array(json_decode($row->file_ids)))
                $row->setAttribute('files',File::whereIn('id',json_decode($row->file_ids))->get());
                else
                $row->setAttribute('files',array());
                $row->setAttribute('AgendaTopic',AgendaTopic::where('detail_id',$row->id)->orderBy('id', 'asc')->get());
            }
            else{
            $agendaDetail=array();
            }
            
        //$meetingTitleList = AgendaTopic::where('detail_id','=',$agendaDetail->id)->get();//findOrFail($request['id']);
        return response()->json($agendaDetail);
    }
    public function archieve_agenda_report(Request $request)
    {   
            $agendaDetail['result'] = AgendaDetail::query();
            
            if ($request->get('meetingTitleName')) {
                $agendaDetail['result']->where('agenda_extention_id','=',$request->get('meetingTitleName'));
            }

            if ($request->get('agendaNum')) {

               $agendaDetail['result']->where('agenda_number','=',$request->get('agendaNum'));
            }

            if ($request->get('start') && $request->get('end')) {

                $from = date_create(($request->get('start')));

                $from = explode('/', ($request->get('start')));

                $from = $from[2] . '-' . $from[1] . '-' . $from[0];

                $to = date_create(($request->get('end')));

                $to = explode('/', ($request->get('end')));

                $to = $to[2] . '-' . $to[1] . '-' . $to[0];

                $agendaDetail['result']->whereBetween('agenda_date', [$from, $to]);

            }

            $agendaDetail['result'] = $agendaDetail['result']->with('AgendaTopic')->get();
            //dd($agendaDetail['result']);
            if($agendaDetail['result'])
            {
            foreach($agendaDetail['result'] as $agendaDetails)
                foreach($agendaDetails->AgendaTopic as $row)
                    {
                        // dd($row);
                        // if ($request->get('customerid')&&$request->get('customerType'))
                        // {
                        //     // dd($request->all());
                        //     //$row->where('connected_to','=',$request->get('customerid'))->where('model','=',$request->get('customerType'));
                        //   if($row->connected_to!=$request->get('customerid')&&$row->model!=$request->get('customerType'))
                        //     {  
                        //     $row->setAttribute('flg','1');
                        //     $agendaDetails->AgendaTopic->forget($row);
                        //         unset($row);
                        //         // $agendaDetails->setAttribute('agenda_topic',array());
                        //       continue;
                        //     }
                        
                        // } 
                        
                            if($row->file_ids!="null"){
                                $row->setAttribute('files',File::whereIn('id',json_decode($row->file_ids))->get());
                            }
                            else
                            {
                                $row->setAttribute('files',array());
                            }
                            
                        // }
                        
                    }
            }
            //dd($agendaDetail['result']);
        return response()->json($agendaDetail);

    }
    public function doEditMeetingTitle(Request $request){
        $agendaExtention = AgendaExtention::find($request['id']);
        $agendaExtention->name = $request['meetingnamear'];
        $agendaExtention->employee = json_encode($request->meetingPerEmpList);
        $agendaExtention->admin = $request->meetingmanager;
        $agendaExtention->users = json_encode($request->MemberNameList);
        $agendaExtention->save();
     if ($agendaExtention) {
         return response()->json(['success'=>trans('admin.extention_added')]);
     }else{
         return response()->json(['error'=>$validator->errors()->all()]);
     }
 }
    
    function upload_image($file, $prefix){
        // if($file){
        //     $files = $file;
        //     $imageName = $prefix.rand(3,999).'-'.time().'.'.$files->extension();
        //     $image = "storage/".$imageName;
        //     $files->move(public_path('storage'), $imageName);
        //     $getValue = $image;
        //     return $getValue;
        // }
        $filePath = $file->hashName();
        // Storage::disk('s3')->put($filePath, file_get_contents($file));
        Storage::disk('s3')->put($filePath, fopen($file, 'r+'));
    
        return [
            'name' => $file->getClientOriginalName(),
            'extension'=>$file->getClientOriginalExtension(),
            'path' => Storage::cloud()->url($filePath)
        ];
    }
    public function ajaxSaveMeeting(Request $request){
        ///dd($request);
        $meetingID=$request->meetingID;
        $lastorder=$request->lastorder;
            $agendaDetail =new AgendaDetail();
        if($request->meetingID==0){
            
            $agendaExtention=AgendaExtention::find($request->meetingTitleName);
            $agendaDetail->agenda_number=$request->agendaNum;
            // if($request->agendaDate){
            // $from = explode('/', ($request->agendaDate));

            // $from = $from[2] . '-' . $from[1] . '-' . $from[0];
            // }
            // else{
            //   $from="0000-00-00";
            // }
            $agendaDetail->agenda_date=$request->agendaDate;
            $agendaDetail->agenda_extention_id=$request->meetingTitleName;
            $agendaDetail->signature_emp = $request->signature_emp;
            $agendaDetail->signature_jobtitle = $request->signature_jobtitle;
            $meetingID=$agendaDetail->save();
        }
        
        $descision=$request->input("descisiontxt".$lastorder);
        if(!$descision)
        $descision="";
        $agendaTopic=new AgendaTopic();
        $agendaTopic->title=$request->input("topicTitle".$lastorder);
        $agendaTopic->connected_to=$request->input("applicantID".$lastorder);
        $agendaTopic->model=$request->input("applicantType".$lastorder);
        $agendaTopic->descision=$descision;
        $agendaTopic->file_ids=json_encode($request->input("subject".$lastorder."id"));
        $agendaTopic->connected_to_txt=$request->input("applicantName".$lastorder);
        $agendaTopic->detail_id=($request->meetingID==0)?$agendaDetail->id:$request->meetingID;
        $agendaTopic->created_by=Auth()->user()->id;
        $topicid=$agendaTopic->save();
        $data=array('id'=>$agendaDetail->id,'topicid'=>$agendaTopic->id);
        //dd($data);
        return response()->json($data);
    }
    public function ajaxSaveDesicion(Request $request){
        ///dd($request);
        $meetingID=$request->meetingID;
        $lastorder=$request->lastorder;
        $agendaTopic=AgendaTopic::find($request->input("topicid".$lastorder));
        $agendaTopic->title=$request->input("topicTitle".$lastorder);
        $user=$request->input("applicantID".$lastorder);
        if($user == null)
        {
            $user=0;
        }
        $agendaTopic->connected_to=$user;
        $agendaTopic->model=$request->input("applicantType".$lastorder);
        $agendaTopic->descision=$request->input("descisiontxt".$lastorder);
        $agendaTopic->file_ids=json_encode($request->input("subject".$lastorder."id"));
        $agendaTopic->connected_to_txt=$request->input("applicantName".$lastorder);
        $agendaTopic->detail_id=$meetingID;
        $agendaTopic->created_by=Auth()->user()->id;
        $topicid=$agendaTopic->save();
        $data=array('id'=>$meetingID,'topicid'=>$topicid);
        return response()->json($data);
    }
    public function printDes(Request $request){
        ///dd($request);
        $res=AgendaTopic::with('AgendaDetail')->with('AgendaDetail.AgendaExtention')->with('AgendaDetail.AgendaExtention.Admin')->find($request->id);
        $type='printDes';
       return view('dashboard.archive.printDes',compact('res'));
        
    }

}
