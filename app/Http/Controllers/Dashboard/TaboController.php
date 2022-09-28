<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\City;

use App\Models\Admin;

use App\Models\Town;
use App\Models\File;
use App\Models\User;

use App\Models\Department;

use App\Models\TaboData;

use App\Models\TaboExcel;

use Yajra\DataTables\DataTables;

use App\Http\Requests\ExtentionRequest;

use App\Imports\TaboImport;
use App\Imports\TaboFinalImport;

use App\Models\Setting;

use Excel;


class TaboController extends Controller

{
    public function getTaboData(Request $request)
    {
        $tabo= TaboData::where('enabled',1)->orderBy('id', 'DESC')->with('hod')->get();

        return DataTables::of($tabo)
                        ->addIndexColumn()
                        ->make(true);
    }
    public function taboDataIndex(Request $request)
    {
        $type = 'taboData';
        $hod = TaboExcel::get();
        return view('dashboard.tabo.tabo_data', compact('type','hod'));

    }
    public function addNewInfo(Request $request)
    {
        $taboData= TaboData::where('id',intval($request->id))->first();

        if(!$taboData)
            return false;
        $taboData->price =$request->price;
        $taboData->wasel =$request->wasel;
        $taboData->timespay =$request->timespay;
        $taboData->notes =$request->notes;
        $taboData->save();
        return $taboData->id;
    }
    public function taboExcelIndex(Request $request)
    {
        $type = 'taboExcel';
        $taboExcels=TaboExcel::where('enabled',1)->get();
        return view('dashboard.tabo.tabo_excel', compact('type','taboExcels'));

    }
    
    public function taboPrint1($id)
    {
        $type = 'taboPrint1';
        $setting= Setting::first();
        $tabo= TaboData::where('id', intval($id))->with('hod')->first();
        return view('dashboard.tabo.tabo1', compact('type','tabo','setting'));

    }
    public function taboPrint2($id)
    {
        $type = 'taboPrint2';
        $tabo= TaboData::where('id', intval($id))->with('hod')->first();
        $setting= Setting::first();
        return view('dashboard.tabo.tabo2', compact('type','tabo','setting'));

    }
    public function taboPrint3($id)
    {
        $type = 'taboPrint3';
        $setting= Setting::first();
        $tabo= TaboData::where('id', intval($id))->with('hod')->first();

        return view('dashboard.tabo.tabo3', compact('type','tabo','setting'));

    }
    public function taboPrint4($id)
    {
        $type = 'taboPrint4';
        $tabo= TaboData::where('id', intval($id))->with('hod')->first();
        $setting= Setting::first();
        
        return view('dashboard.tabo.tabo4', compact('type','tabo','setting'));

    }
    
    public function uploadFile(Request $request){
        // dd($request->all());

        if ($request->hasFile('file_tabo')) {
            $file=$request->file('file_tabo');
            $taboExcelData=new TaboExcel();
            $taboExcelData->hod_name =$request->hod_name;
            $taboExcelData->hod_no =$request->hod_no;
            $taboExcelData->created_by = Auth()->user()->id;
            $url = upload_image($file, 'image_');
            if ($url) 
            {
                $uploaded_files = File::create([
                    'url' => $url,
                    'real_name' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                ]);
            }
            
            $taboExcelData->excel_name =$file->getClientOriginalName();
            $taboExcelData->excel_path =$url;
            $taboExcelData->save();
            
            Excel::import(new TaboImport($taboExcelData->id), realpath($url));
            return response()->json(['file'=>$uploaded_files,'Input'=>'file_tabo']);
        }
    }
    
    public function uploadFinalFile(Request $request){
        // dd($request->all());

        if ($request->hasFile('file_tabo')) {
            $file=$request->file('file_tabo');
            
            
            $taboExcelData=TaboExcel::where('id',$request->excelId)->first();
            if($taboExcelData ==null)
                $taboExcelData=new TaboExcel();
            
            $taboExcelData->hod_name =$request->hod_name;
            $taboExcelData->hod_no =$request->hod_no;
            $taboExcelData->created_by = Auth()->user()->id;
            $url = upload_image($file, 'image_');
            if ($url) 
            {
                $uploaded_files = File::create([
                    'url' => $url,
                    'real_name' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                ]);
            }
            
            $taboExcelData->excel_name2 =$file->getClientOriginalName();
            $taboExcelData->excel_path2 =$url;
            $taboExcelData->is_final =1;
            $taboExcelData->save();
            
            Excel::import(new TaboFinalImport($taboExcelData->id), realpath($url));
            return response()->json(['file'=>$uploaded_files,'Input'=>'file_tabo']);
        }
    }
    
    public function saveNewData(Request $request)
    {
        if($request->ownerId==0 || $request->ownerId==null){
            $user = new User();
            $user->phone_one    = $request->phone;
            $user->name         = $request->NameAR;
            $user->national_id  = $request->nationality;
            $user->add_by       = Auth()->user()->id;
            $user->save();
            $request->ownerId=$user->id;
        }
        if(!$request->data_id)
        $taboData=new TaboData();
        else
        $taboData= TaboData::where('id',intval($request->data_id))->first();
        $taboData->excel_id =$request->hodId;
        $taboData->temp_no =$request->partTemp;
        $taboData->owner_name =$request->NameAR;
        $taboData->owner_id =$request->ownerId;
        $taboData->area =$request->area;
        $taboData->final_no =$request->partFinal;
        $taboData->phoneNo =$request->phone;
        $taboData->nationality =$request->nationality;
        $taboData->notes =$request->notes;
        $taboData->save();
        return $taboData->id;
    }
    
    public function getExcelInfo(Request $request){
        $taboExcels=TaboExcel::where('id',$request->id)->first();
        return response()->json($taboExcels);
    }
    
    public function getExcelInfo_all(){
        $taboExcels=TaboExcel::where('enabled',1)->get();
        return response()->json($taboExcels);
    }

    public function getItemTabo(Request $request){
        $taboData = TaboData::where('id',intval($request->id))->first();
        return response()->json($taboData);
        
    }
    
    public function deleteExcel(Request $request){
        $taboExcel = TaboExcel::where('id',intval($request->id))->first();
        $taboExcel->enabled=0;
        $taboExcel->deleted_by=Auth()->user()->id;
        $taboExcel->save();
        
        $taboData = TaboData::where('excel_id',$taboExcel->id)->get();
        foreach($taboData as $data){
            $data->enabled=0;
            $data->deleted_by=Auth()->user()->id;
            $data->save();
        }
        
        $taboExcels=TaboExcel::where('enabled',1)->get();
        return response()->json($taboExcels);
        
    }

}

