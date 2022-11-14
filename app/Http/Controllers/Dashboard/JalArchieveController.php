<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\JalRequest;
use App\Managers\UpdateSubscriberManager;
use Illuminate\Http\Request;
use App\Models\Archive;
use App\Models\File;
use App\Models\linkedTo;
use Illuminate\Support\Facades\Auth;

class JalArchieveController extends Controller
{
    // public function store_jal_archive(Request $request){
    //     $archive = new Archive();
    //     $archive->model_id =$request->customerid;
    //     $archive->type_id =$request->archive_type   ;
    //     $archive->name =$request->customername;
    //     $archive->model_name =$request->customerType;
    //     $archive->date =$request->msgDate;
    //     $archive->title =$request->msgTitle;
    //     $archive->type =$request->msgType;
    //     $archive->serisal =$request->msgid;
    //     $archive->url =  $request->url;
    //     $archive->add_by = Auth()->user()->id;
    //     $archive->save();

    //     $files_ids = $request->formDataaaorgIdList;
    //     if($files_ids ){
    //     foreach($files_ids as $id){
    //         $file = File::find($id);
    //         $file->archive_id = $archive->id;
    //         $file->model_name = "App\Models\Archive";
    //         $file->save();
    //     }
    //     }
    //     if($request->copyToText[0] != null){
    //         for($i= 0 ; $i< count($request->copyToText) ; $i++){
    //             $copyTo = new linkedTo();
    //             $copyTo->archive_id =  $archive->id;
    //             $copyTo->model_id =  $request->copyToID[$i];
    //             $copyTo->name =  $request->copyToCustomer[$i];
    //             $copyTo->model_name =  $request->copyToType[$i];
    //             $copyTo->save();
    //         }
    //     }
    //     if ($archive) {
    //         return response()->json(['success'=>trans('admin.archive_added')]);
    //     }
    //         return response()->json(['error'=>$validator->errors()->all()]);
    // }
    public function store_jal_archive(JalRequest $request)

    {
//        dd($request->all());
        $archive = Archive::where('id', $request->ArchiveID)->first();
        if ($archive) {

            $archive->model_id = $request->customerid;

            $archive->type_id = $request->archive_type;

            $archive->name = $request->customername == '0' ? '' : $request->customername;

            $archive->model_name = $request->customerType;

            if ($request->msgDate) {
                $from = explode('/', ($request->msgDate));

                $from = $from[2] . '-' . $from[1] . '-' . $from[0];
            } else {
                $from = "0000-00-00";
            }
            $archive->date = $from;

            $archive->title = $request->msgTitle;

            $archive->type = $request->msgType;

            $archive->serisal = $request->msgid;
            $archive->subject = $request->subject;
            $archive->decision = $request->decision;
            $archive->notes = $request->notes;

            $archive->url = $request->url;

            $archive->save();

            $files_ids = $request->formDataaaorgIdList;
            File::where('archive_id', $request->ArchiveID)
                    ->update(['archive_id' => 0, 'model_name' => '']);
            if ($files_ids) {

                foreach ($files_ids as $id) {

                    $file = File::find($id);

                    $file->archive_id = $archive->id;

                    $file->model_name = "App\Models\Archive";

                    $file->save();

                }

            }
            linkedTo::where('archive_id', $archive->id)->delete();
            if ($request->copyToText[0] != null) {

                for ($i = 0; $i < count($request->copyToText); $i++) {
                    $copyToCustomer=$request->copyToText[$i];
                    if($request->copyToID[$i] != 0 && $request->copyToID[$i] != null) {
                        if($request->copyToType[$i]=="App\Models\User" ){
                            UpdateSubscriberManager::updateCNationalID($request->copyToID[$i],$request->national_id[$i]);
                        }
                        $copyToCustomer=$request->copyToCustomer[$i];
                    }
                    $copyTo = new linkedTo();
                    $copyTo->archive_id = $archive->id;
                    $copyTo->model_id = $request->copyToID[$i];
                    $copyTo->name = $copyToCustomer;
                    $copyTo->model_name = $request->copyToType[$i];
                    $copyTo->national_id = $request->national_id[$i];
                    $copyTo->save();
                }

            }

        } else {

            $archive = new Archive();

            $archive->model_id = $request->customerid;

            $archive->type_id = $request->archive_type;

            $archive->name = $request->customername == '0' ? '' : $request->customername;

            $archive->model_name = $request->customerType;

            if ($request->msgDate) {
                $from = explode('/', ($request->msgDate));

                $from = $from[2] . '-' . $from[1] . '-' . $from[0];
            } else {
                $from = "0000-00-00";
            }
            $archive->date = $from;

            $archive->title = $request->msgTitle;

            $archive->type = $request->msgType;

            $archive->serisal = $request->msgid;

            $archive->url = $request->url;
            $archive->subject = $request->subject;
            $archive->decision = $request->decision;
            $archive->notes = $request->notes;
            $archive->add_by = Auth()->user()->id;

            //dd( $request->customername=='0',$request->customername,$archive);
            $archive->save();

            $files_ids = $request->formDataaaorgIdList;

            if ($files_ids) {

                foreach ($files_ids as $id) {

                    $file = File::find($id);

                    $file->archive_id = $archive->id;

                    $file->model_name = "App\Models\Archive";

                    $file->save();

                }

            }

            if ($request->copyToText[0] != null) {

                for ($i = 0; $i < count($request->copyToText); $i++) {
                    $copyToCustomer=$request->copyToText[$i];
                    if($request->copyToID[$i] != 0 && $request->copyToID[$i] != null) {
                        if($request->copyToType[$i]=="App\Models\User" ){
                            UpdateSubscriberManager::updateCNationalID($request->copyToID[$i],$request->national_id[$i]);
                        }
                        $copyToCustomer=$request->copyToCustomer[$i];
                    }
                    $copyTo = new linkedTo();
                    $copyTo->archive_id = $archive->id;
                    $copyTo->model_id = $request->copyToID[$i];
                    $copyTo->name = $copyToCustomer;
                    $copyTo->model_name = $request->copyToType[$i];
                    $copyTo->national_id = $request->national_id[$i];
                    $copyTo->save();
                }

            }

        }

        if ($archive) {

            return response()->json(['success' => trans('admin.archive_added'), 'id' => $archive->id]);

        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    function deleteJalArchive(Request $request){
        $linkedTos=linkedTo::where('archive_id',$request->id)->get();
        foreach ($linkedTos as $linkedTo){
            $linkedTo->enabled=0;
            $linkedTo->deleted_by=Auth()->user()->id;
            $linkedTo->save();
        }
        $archive=Archive::find($request->id);
        $archive->enabled=0;
        $archive->deleted_by=Auth()->user()->id;
        $archive->save();
        return response()->json(['success' => 'done']);
    }

    public function archieve_info(Request $request)

    {

        $archive['info'] = Archive::find($request['archive_id']);

        $archive['files'] = File::where('archive_id', '=', $request['archive_id'])->where('model_name', 'App\Models\Archive')->get();
        $archive['CopyTo'] = linkedTo::where('archive_id', '=', $request['archive_id'])->get();

        return response()->json($archive);

    }
}
