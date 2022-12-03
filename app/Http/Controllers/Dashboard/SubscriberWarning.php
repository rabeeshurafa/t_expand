<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Yajra\DataTables\DataTables;
use App\Models\Constant;
use App\Models\Warning;
use App\Models\File;
use App\Models\Archive;
use App\Managers\AttatchmentManager;
use DateTime;
use DB;


class SubscriberWarning extends Controller
{
    public function index()
    {
        $type = 'warning';
        $warningTypes = Constant::where('parent', 6228)->where('status', 1)->get();
        $warningReceives = Constant::where('parent', 6265)->where('status', 1)->get();
        $warningStatus = Constant::where('parent', 6229)->where('status', 1)->get();
        return view('dashboard.subscribeWarning.index',
                compact('type', 'warningTypes', 'warningStatus', 'warningReceives'));
    }

    function prepearAttach(Request $request)
    {
        $attach_ids = $request->attach_ids;
        $attachName = $request->attachName1;
        $attachArr = array();
        if ($attach_ids) {
            for ($i = 0; $i < sizeof($attach_ids); $i++) {
                if ($attach_ids[$i] != null) {
                    $temp = array();
                    $temp['attachName'] = trim($attachName[$i]);
                    $temp['attach_ids'] = trim($attach_ids[$i]);
                    $attachArr[] = $temp;
                }
            }
        }
        return $attachArr;
    }

    public function store_warning(Request $request)
    {

        // dd($request->all());
        DB::beginTransaction();
        $warning = Warning::find($request->warningId);
        if ($warning == null) {
            $warning = new Warning();
        }

        if ($request->date != null && $request->date != '') {
            $date = explode('/', ($request->date));

            $date = $date[2].'-'.$date[1].'-'.$date[0];
            $warning->warning_date = $date;
        } else {
            $warning->warning_date = null;
        }

        if ($request->deleteDate != null && $request->deleteDate != '') {
            $deleteDate = explode('/', ($request->deleteDate));

            $deleteDate = $deleteDate[2].'-'.$deleteDate[1].'-'.$deleteDate[0];
            $warning->remove_date = $deleteDate;
        } else {
            $warning->remove_date = null;
        }


        $warning->add_by = Auth()->user()->id;
        $warning->subscriber_id = $request->subscriberID;
        $warning->subscriber_name = $request->subscriberName;
        $warning->warning_type = $request->warningType;
        $warning->hod_no = $request->hodNo;
        $warning->piece_no = $request->peiceNo;
        $warning->receive = $request->receive;
        $warning->warning_reason = $request->warningReason;
        $warning->warning_status = $request->warningStatuse;
        $warning->remove_reason = $request->deleteReason;
        $warning->file_ids = json_encode($this->prepearAttach($request));

        $warning->save();

        if ($request->warningId == 0 || $request->warningId == null) {
            $link = '';
            $name = 'اخطارات';
            $this->saveWarningArchieve($request, $name, $link);
        }
        if (($request->warningId != 0 || $request->warningId != null) && ($request->notArchived != null)) {
            $link = '';
            $name = 'اخطارات';
            $this->saveScannedArchieve($request, $name, $link);
        }

        DB::commit();
        if ($warning) {

            return response()->json(['success' => trans('admin.employee_added')]);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    function saveWarningArchieve(Request $request, $taskname = '', $tasklink = '', $model = 'App\\Models\\User')
    {
        $files_ids = $request->attach_ids;

        if ($files_ids) {
            $i = 0;
            foreach ($files_ids as $id) {
                if ($id != null) {
                    $archive = new Archive();
                    $archive->model_id = $request->subscriberID;
                    $archive->type_id = '6046';
                    $archive->name = $request->subscriberName;
                    $archive->model_name = $model;
                    $date = date("Y/m/d");
                    $from = explode('/', ($date));
                    $from = $from[0].'-'.$from[1].'-'.$from[2];
                    $archive->date = $from;
                    $archive->task_name = $taskname;
                    $archive->task_link = $tasklink;
                    $archive->title = $request->attachName1[$i];
                    $archive->type = 'WarningArchive';
                    $archive->serisal = '';
                    $archive->url = 'Warning_archieve';
                    $archive->add_by = Auth()->user()->id;
                    //dd( $request->customername=='0',$request->customername,$archive);
                    $archive->save();
                    $file = File::find($id);
                    $file->archive_id = $archive->id;
                    $file->model_name = "App\Models\Archive";
                    $file->save();
                }
                $i++;
            }

        }
    }

    function saveScannedArchieve(Request $request, $taskname = '', $tasklink = '', $model = 'App\\Models\\User')
    {
        $files_ids = $request->attach_ids;
        foreach ($request->notArchived ?? [] as $notArchivedId) {
            if ($notArchivedId != null) {
                $index = array_search($notArchivedId, $files_ids ?? []);
                $archive = new Archive();
                $archive->model_id = $request->subscriberID;
                $archive->type_id = '6046';
                $archive->name = $request->subscriberName;
                $archive->model_name = $model;
                $archive->date = date("Y-m-d");
                $archive->task_name = $taskname;
                $archive->task_link = $tasklink;
                $archive->title = $request->attachName1[$index];
                $archive->type = 'WarningArchive';
                $archive->serisal = '';
                $archive->url = 'Warning_archieve';
                $archive->add_by = Auth()->user()->id;
                $archive->save();
                $file = File::find($notArchivedId);
                $file->archive_id = $archive->id;
                $file->model_name = "App\Models\Archive";
                $file->save();
            }
        }
    }


    public function warning_info(Request $request)
    {
        // dd($request->all);

        $warning['info'] = Warning::where('id', $request['warning_id'])->first();
        if ($warning['info']->file_ids != null) {
            $warning['info']->setAttribute('Files',
                    AttatchmentManager::getAttach(json_decode($warning['info']->file_ids)));
        }
        return response()->json($warning);

    }

    public function warning_delete(Request $request)
    {
        // dd($request->all());
        $warning = Warning::find($request['warning_id']);
        $warning->deleted_by = Auth()->user()->id;
        $warning->enabled = 0;
        $warning->save();

        if ($warning) {
            return response()->json(['success' => trans('admin.subscriber_added')]);

        }
        return response()->json(['error' => $validator->errors()->all()]);

    }

    function getAttach($file_ids = array())
    {
        $attachArr = array();
        if (is_array($file_ids)) {
            foreach ($file_ids as $row) {
                $row->Files = File::where('id', $row->attach_ids)->get();
            }
        }
        return $file_ids;
    }

    public function warning_info_all(Request $request)
    {
        $warnings = Warning::select('warnings.*', 't.name as warningType', 's.name as warningStatus')
                ->leftJoin('t_constant as t', 't.id', 'warnings.warning_type')
                ->leftJoin('t_constant as s', 's.id', 'warnings.warning_status')
                ->orderBy('warnings.id', 'DESC')->where('warnings.enabled', 1);

        if ($request->search_warningType != null && $request->search_warningType != 0) {
            $warnings = $warnings->where('warnings.warning_type', $request->search_warningType);
        }
        if ($request->search_warningStatuse != null && $request->search_warningStatuse != 0) {
            $warnings = $warnings->where('warnings.warning_status', $request->search_warningStatuse);
        }
        $from = null;
        $to = null;
        if ($request->search_from && $request->search_to) {
            try {
                $from = date_create(($request->get('search_from')));

                $from = explode('/', ($request->get('search_from')));

                $from = $from[2].'-'.$from[1].'-'.$from[0];

                $to = date_create(($request->get('search_to')));

                $to = explode('/', ($request->get('search_to')));
                if ($to[0] == 31) {
                    $to = $to[2].'-'.$to[1].'-'.($to[0]);
                } else {
                    $to = $to[2].'-'.$to[1].'-'.($to[0] + 1);
                }
            } catch (\Exception $e) {
                $from = null;
                $to = null;
            }

        }

        if ($to != null && $from != null) {
            if (DateTime::createFromFormat('Y-m-d', $to) !== false && DateTime::createFromFormat('Y-m-d',
                            $to) !== $from) {
                $warnings = $warnings->whereBetween('warnings.warning_date', [$from, $to]);
            }
        }
        $warnings = $warnings->get();
        foreach ($warnings as $warning) {
            if ($warning->file_ids != null) {
                $warning->setAttribute('Files', $this->getAttach(json_decode($warning->file_ids)));
            }
        }
        return DataTables::of($warnings)
                ->addIndexColumn()
                ->make(true);

    }

}

