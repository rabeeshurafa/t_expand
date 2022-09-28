<?php



namespace App\Http\Controllers\Dashboard;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Http\Requests\EarchLicRequest;

use Yajra\DataTables\DataTables;

use App\Models\Earh_lic;


class EarchLicController extends Controller

{

    public function index(){
        $type = 'EarchLic';
        return view('dashboard.EarchLic.index',compact('type'));
    }

    public function saveEarchLic(EarchLicRequest $request){
        // dd($request->all());
        if($request->id&&$request->id!=0)
            {
                $earchLic=Earh_lic::where('id','=',$request->id)->first();
            }
        else
            {
                $earchLic = new Earh_lic();
            }
        // dd($earchLic);
          $earchLic->cert_no = $request->certid;
          
        $date = explode('/', $request->certdate);
        $earchLic->date = $date[2].'-'.$date[1].'-'.$date[0];

        $earchLic->wasl_no = $request->recept_no;
        $earchLic->area = $request->peacem;
        $earchLic->cert_cost = $request->fees;
        $earchLic->total = (intval($request->peacem)*0.2)+$request->fees;
        $earchLic->proj_id = $request->projectid;
        $earchLic->proj_name = $request->projectname;
        $earchLic->sponser_id = $request->sponserid;
        $earchLic->sponser_model = $request->sponsermodel;
        $earchLic->sponser_name = $request->sponser;
        $earchLic->area_name = $request->areaname2;
        $earchLic->peaceNo_2 = $request->peaceNo_2;
        $earchLic->sequareNo_2 = $request->sequareNo_2;
        $earchLic->added_by =Auth()->user()->id;
        
        $user_name=array();
        $user_id=array();
        $user_name2=array();
        $user_id2=array();
        $hod_no=array();
        $pice_no=array();
        $notes1=array();
        $notes2=array();
        $user_national=array();
          
          for($i=0 ; $i<sizeof($request->NameARList) ; $i++ ){
              if($request->NameARList[$i]!=null){
                  array_push($user_name, $request->NameARList[$i]);
                  if(sizeof($request->id1)>$i)
                  array_push($user_id, ($request->id1[$i]??''));
                  
                  if(sizeof($request->s_notes)>$i)
                  array_push($notes1, ($request->s_notes[$i]??''));
                  
                  if(sizeof($request->peaceNo)>$i)
                  array_push($pice_no, ($request->peaceNo[$i]??''));
                  
                  if(sizeof($request->sequareNo)>$i)
                  array_push($hod_no, ($request->sequareNo[$i]??''));
                  
              }
          }
          for($i=0 ; $i<sizeof($request->name2) ; $i++ ){
              if($request->name2[$i]!=null){
                  array_push($user_name2, $request->name2[$i]);
                  
                  if(sizeof($request->id2)>$i)
                  array_push($user_id2, ($request->id2[$i]??''));
                  
                  if(sizeof($request->ssn)>$i)
                  array_push($user_national, ($request->ssn[$i]??''));
                  
                  if(sizeof($request->s_notes2)>$i)
                  array_push($notes2, ($request->s_notes2[$i]??''));
              }
          }
          
          
          $earchLic->user_name      = json_encode($user_name);
          $earchLic->user_id        = json_encode($user_id);
          $earchLic->hod_no         = json_encode($hod_no);
          $earchLic->pice_no	    = json_encode($pice_no);
          $earchLic->notes1	        = json_encode($notes1);
          $earchLic->user_national  = json_encode($user_national);
          $earchLic->name2          = json_encode($user_name2);
          $earchLic->id2            = json_encode($user_id2);
          $earchLic->notes2         = json_encode($notes2);
          $earchLic->save();

        if ($earchLic) {
            return response()->json(['status'=>trans('admin.extention_added'),'earchLic'=>$earchLic]);
        }else{
            return response()->json(['status'=>$validator->errors()->all()]);
        }
    }
    
    public function printLicEarth($appid=0)
	{
	    $res=Earh_lic::where('id','=',$appid)->first();
	    $res['user_name']=json_decode($res->user_name);
	    $res['name2']=json_decode($res->name2);
	    $res['hod_no']=json_decode($res->hod_no);
	    $res['pice_no']=json_decode($res->pice_no);
	    $res['user_national']=json_decode($res->user_national);
	    $res['notes1']=json_decode($res->notes1);
	    $res['notes2']=json_decode($res->notes2);
	   // dd($res);
        return view('dashboard.EarchLic.printLicEarth', compact('res'));
    }
    
    public function all_EarchLic(){
        $res=Earh_lic::where('enabled',1)->orderby('id','DESC')->get();
        
        foreach($res as $row){
            if($row->name2!=null)
    	        $row['user_name']=json_decode($row->name2);
    	    else
    	        $row['user_name']=json_decode($row->user_name);
    	        
    	    if($row->sequareNo_2==null && ($row->hod_no!=null && $row->hod_no!='[]'))
    	        $row->sequareNo_2=(json_decode($row->hod_no, true))[0];
    	        
    	    if($row->peaceNo_2==null && ($row->pice_no!=null && $row->pice_no!='[]'))
    	        $row->peaceNo_2=(json_decode($row->pice_no, true))[0];
    	    
    	    $row['user_national']=json_decode($row->user_national);
    	    $row['notes1']=json_decode($row->notes1);
    	    $row['notes2']=json_decode($row->notes2);
            
        }
	   // dd($res);
        return DataTables::of($res)->addIndexColumn()->make(true);
        
    }
    
    public function earchLic_info(Request $requset){
        $res=Earh_lic::where('id',$requset->id)->first();
        
	    $res['user_name']=json_decode($res->user_name);
	    $res['user_id']=json_decode($res->user_id);
	    
	    $res['name2']=json_decode($res->name2);
	    $res['id2']=json_decode($res->id2);
	    
	    $res['hod_no']=json_decode($res->hod_no);
	    $res['pice_no']=json_decode($res->pice_no);
	    $res['user_national']=json_decode($res->user_national);
	    $res['notes1']=json_decode($res->notes1);
	    $res['notes2']=json_decode($res->notes2);
         
	   // dd($res);
        return response()->json($res);
        
    }
    
    public function earchLic_delete(Request $request)
    {
        // dd($request->all());
        $res= Earh_lic::find($request['id']);
        $res->deleted_by = Auth()->user()->id;
        $res->enabled=0;
        $res->save();
        
        if ($res) {
            return response()->json(['success'=>trans('admin.subscriber_added')]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
       
    }

}

