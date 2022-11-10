<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ArchiveRole;
use App\Models\Constant;
use App\Models\File;
use App\Models\TaboArchive;
use App\Models\TaboData;
use App\Models\TaboExcel;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;

class TaboArchiveController extends Controller
{
    public function index()
    {
        $type = 'taboArchive';
        $url = "tabo_archive";
        $hod = TaboExcel::where('enabled', 1)->get();
        $archive_type = Constant::where('parent', 6444)->where('status', 1)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        return view('dashboard.archive.taboArchive', compact('type', 'url', 'hod', 'archive_type', 'archive_config'));
    }

    public function taboPieceAutoComplete(Request $request)
    {
        $taboData = TaboData::where('temp_no', 'like', '%'.$request->term.'%')->orWhere('final_no', 'like',
                '%'.$request->term.'%')->where('excel_id',
                $request->hod_id)->select('*',
                DB::raw("CONCAT(owner_name,' (',temp_no,') ','(',final_no,')' )AS label"))->with('hod')->get();
        return response()->json($taboData);
    }

    public function storeTaboArchive(Request $request)
    {
        $taboArchive = TaboArchive::find($request->id);
        if (!$taboArchive) {
            $taboArchive = new TaboArchive();
        }
        $taboArchive->hodId = $request->hodId;
        $taboArchive->tabo_data_id = $request->tabo_data_id;
        $taboArchive->pieceNo = $request->pieceNo;
        $taboArchive->hodNo = $request->hodNo;
        $taboArchive->citizenName = $request->citizenName;
        $taboArchive->citizenId = $request->citizenId;
        $taboArchive->areaName = $request->areaName;
        $taboArchive->area = $request->area;
        $taboArchive->cost = $request->cost;
        $taboArchive->msgTitle = $request->msgTitle;
        $taboArchive->archive_type = $request->archive_type;
        $taboArchive->notes = $request->notes;
        $taboArchive->added_by = Auth()->user()->id;
        $taboArchive->save();
        $files_ids = $request->formDataaaorgIdList;
        File::where('archive_id', $request->id)->where('model_name', 'App\Models\TaboArchive')
                ->update(['archive_id' => 0, 'model_name' => '']);
        if ($files_ids) {
            foreach ($files_ids as $id) {
                $file = File::find($id);
                $file->archive_id = $taboArchive->id;
                $file->model_name = "App\Models\TaboArchive";
                $file->save();
            }
        }
        if ($taboArchive->id != null && $taboArchive->id != 0) {
            return response()->json(['success' => trans('admin.archive_added'), 'id' => $taboArchive->id]);
        } else {
            return response()->json(['error' => 'فشل في عملية الحفظ', 'id' => $taboArchive->id]);
        }
    }

    public function taboArchiveInfoAll(Request $request)
    {
        $archive_config = ArchiveRole::where('type', 'taboArchive')->get();
        $my_id = strval(Auth()->user()->id);
        $ids = [];
        for ($i = 0; $i < count($archive_config); $i++) {
            $t = json_decode($archive_config[$i]->archiveroles);
            for ($j = 0; $j < count($t); $j++) {
                if ($t[$j] == $my_id) {
                    array_push($ids, $archive_config[$i]->empid);
                }
            }
        }
        array_push($ids, (int) $my_id);
        $archive = TaboArchive::select('tabo_archives.*', 'tabo_excels.hod_name as hod_name')
                ->where('tabo_archives.enabled', '1')
                ->whereIn('tabo_archives.added_by', $ids)
                ->orderBy('tabo_archives.id', 'DESC')
                ->with(['Admin', 'files'])
                ->leftJoin('tabo_excels', 'tabo_excels.id', 'tabo_archives.hodId');
        if($request->hodId != null && $request->hodId != ''){
            $archive=$archive->where('tabo_archives.hodId',$request->hodId);
        }
        if($request->tabo_data_id != null && $request->tabo_data_id != ''){
            $archive=$archive->where('tabo_archives.tabo_data_id',$request->tabo_data_id);
        }
        return DataTables::of($archive)->addIndexColumn()->make(true);
    }

    public function taboArchive_info(Request $request)
    {
        $archive = TaboArchive::find($request->id)->with('files')->first();
        return response()->json($archive);
    }

    public function delete(Request $request)
    {
        $archive = TaboArchive::find($request->id);
        $archive->enabled = 0;
        $archive->deleted_by = Auth()->user()->id;
        $archive->save();
        return response()->json(['success' => trans('admin.subscriber_added')]);
    }
}