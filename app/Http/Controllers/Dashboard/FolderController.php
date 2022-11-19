<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AgendaTopic;
use App\Models\Archive;
use App\Models\Cert;
use App\Models\City;
use App\Models\CopyTo;
use App\Models\File;
use App\Models\Folder;
use App\Models\Region;
use App\Models\Setting;
use App\Models\Town;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FolderController extends Controller
{
    public function index()
    {
        $city = City::where('status', 1)->get();
        $setting = Setting::first();
        $town = Town::where('city_id', $setting->city_id)->where('status', 1)->get();
        $region = Region::where('status', 1)->get();
        $type = 'folder';
        return view('dashboard.Folder.index', compact('type', 'city', 'town', 'region'));
    }

    public function store(Request $request)
    {
        $folder = Folder::find($request->id);
        if ($folder == null) {
            $folder = new Folder();
        }
        $folder->name = $request->name;
        $folder->year1 = $request->year1;
        $folder->month1 = $request->month1;
        $folder->year2 = $request->year2;
        $folder->month2 = $request->month2;
        $folder->fromNo = $request->fromNo;
        $folder->toNo = $request->toNo;
        $folder->total = $request->total;
        $folder->encoding = $request->encoding;
        $folder->notes = $request->notes;
        $folder->place = $request->place;
        $folder->added_by = Auth()->user()->id;
        $res = $folder->save();
        if ($res) {
            return response()->json(['status' => true]);
        }
        return response()->json(['error' => true]);
    }

    public function folderInfo(Request $request)
    {
        $folder = Folder::find($request->id);
        $folder->out = Archive::where('enabled', 1)
                ->where('model_id', $request['id'])
                ->where('model_name', 'App\\Models\\Folder')
                ->where('type', 'outArchive')
                ->count();
        $folder->in = Archive::where('enabled', 1)
                ->where('model_id', $request['id'])
                ->where('model_name', 'App\\Models\\Folder')
                ->where('type', 'inArchive')
                ->count();
        $folder->copy = CopyTo::where('model_id', $request['id'])->where('enabled', 1)
                ->where('model_name', 'App\\Models\\Folder')->count();
        $folder->agenda = AgendaTopic::where('connected_to', $request['id'])
                ->where('model', 'App\\Models\\Folder')->count();
        $folder->other = Archive::where('enabled', 1)
                ->where('model_id', $request['id'])
                ->where('model_name', 'App\\Models\\Folder')
                ->whereNotIn('type', ['outArchive', 'inArchive', 'contractArchive', 'financeArchive'])->count();
        $folder->contract = Archive::where('enabled', 1)
                ->where('model_id', $request['id'])
                ->where('type', 'contractArchive')
                ->where('model_name', 'App\\Models\\Folder')->count();
        $folder->finance = Archive::where('enabled', 1)
                ->where('model_id', $request['id'])
                ->where('type', 'financeArchive')
                ->where('model_name', 'App\\Models\\Folder')->count();

        return response()->json($folder);
    }

    public function folderOutArchive(Request $request)
    {
        $Archive = Archive::select('archives.*', 't_constant.name as type_id_name')
                ->where('enabled', 1)
                ->where('model_id', $request['id'])
                ->where('model_name', 'App\\Models\\Folder')
                ->where('type', 'outArchive')
                ->leftJoin('t_constant', 't_constant.id', 'archives.type_id')
                ->with('archiveType')->with('files')->with('copyTo')->with('Admin')->orderBy('archives.date',
                        'DESC')->get();

        return DataTables::of($Archive)
                ->addIndexColumn()
                ->make(true);

    }

    public function folderInArchive(Request $request)
    {
        $Archive = Archive::select('archives.*', 't_constant.name as type_id_name')
                ->where('enabled', 1)
                ->where('model_id', $request['id'])
                ->where('model_name', 'App\\Models\\Folder')
                ->where('type', 'inArchive')
                ->leftJoin('t_constant', 't_constant.id', 'archives.type_id')
                ->with('archiveType')->with('files')->with('copyTo')->with('Admin')->orderBy('archives.date',
                        'DESC')->get();

        return DataTables::of($Archive)
                ->addIndexColumn()
                ->make(true);

    }

    public function folderCopyArchive(Request $request)
    {

        $Archive = CopyTo::where('model_id', $request['id'])->where('enabled', 1)
                ->where('model_name', 'App\\Models\\Folder')->with('archive', 'archive.files')->with('archive',
                        'archive.Admin')->get();

        return DataTables::of($Archive)
                ->addIndexColumn()
                ->make(true);

    }

    public function folderJalArchive(Request $request)
    {

        $Archive = AgendaTopic::with('AgendaDetail')->with('AgendaDetail.AgendaExtention')->with('AgendaDetail.AgendaExtention.Admin')
                ->where('connected_to', $request['id'])
                ->where('model', 'App\\Models\\Folder')->get();
        foreach ($Archive as $row) {
            if ($row->file_ids != "null") {
                $row->setAttribute('files', File::whereIn('id', json_decode($row->file_ids))->get());
            } else {
                $row->setAttribute('files', array());
            }
        }
        // dd($Archive->all());
        return DataTables::of($Archive)
                ->addIndexColumn()
                ->make(true);

    }

    public function folderOtherArchive(Request $request)
    {

        $Archive = Archive::select('archives.*', 't_constant.name as type_id_name')
                ->where('enabled', 1)
                ->where('model_id', $request['id'])
                ->where('model_name', 'App\\Models\\Folder')
                ->whereNotIn('type', ['outArchive', 'inArchive', 'contractArchive', 'financeArchive'])
                ->leftJoin('t_constant', 't_constant.id', 'archives.type_id')
                ->with('archiveType')->with('files')->with('copyTo')->with('Admin')->orderBy('archives.date',
                        'DESC')->get();

        return DataTables::of($Archive)
                ->addIndexColumn()
                ->make(true);

    }

    public function foldercontractArchive(Request $request)
    {
        $Archive = Archive::select('archives.*', 't_constant.name as type_id_name')
                ->where('enabled', 1)
                ->where('model_id', $request['id'])
                ->where('type', 'contractArchive')
                ->where('model_name', 'App\\Models\\Folder')
                ->leftJoin('t_constant', 't_constant.id', 'archives.type_id')
                ->with('archiveType')->with('copyTo')->with('files')->with('Admin')->orderBy('archives.date',
                        'DESC')->get();

        return DataTables::of($Archive)
                ->addIndexColumn()
                ->make(true);

    }

    public function folderfinaceArchive(Request $request)
    {
        $Archive = Archive::select('archives.*', 't_constant.name as type_id_name')
                ->where('enabled', 1)
                ->where('model_id', $request['id'])
                ->where('type', 'financeArchive')
                ->where('model_name', 'App\\Models\\Folder')
                ->leftJoin('t_constant', 't_constant.id', 'archives.type_id')
                ->with('archiveType')->with('files')->with('Admin')->orderBy('archives.created_at', 'DESC')->get();
        foreach ($Archive as $row) {
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

        return DataTables::of($Archive)
                ->addIndexColumn()
                ->make(true);

    }

    public function folderInfoALl(Request $request)
    {
        $folder = Folder::get();
        return DataTables::of($folder)->addIndexColumn()->make(true);
    }

    public function folderAutoComplete(Request $request)
    {
        $folders = Folder::where('name', 'like', '%'.$request->term.'%')->select('id', 'name as label')->get();
        return response()->json($folders);
    }

    public function delete(Request $request)
    {
        $folder = Folder::find($request->id);
        $folder->deleted_by = Auth()->user()->id;
        $folder->save();
        $folder->delete();
        return response()->json(['status' => true]);
    }

}

?>