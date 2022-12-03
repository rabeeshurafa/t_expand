<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Constant;
use App\Models\DailyWork;
use App\Models\Work;
use App\Models\File;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DailyWorkController extends Controller
{
    public function index()
    {
        $workState = Constant::where('parent', 6427)->where('status', 1)->get();
        $type = "dailyWork_view";
        return view('dashboard.dailyWork.dailyWork', compact('type', 'workState'));
    }

    public function reportIndex()
    {
        $type = "reporth_view";
        $workState = Constant::where('parent', 6427)->where('status', 1)->get();
        return view('dashboard.dailyWork.report', compact('type', 'workState'));
    }

    public function printDailyWorkReport($from, $to, $emp_id, $mostt, $state)
    {
        $request = new Request();
        $request->replace([
                'from' => $from, 'to' => $to, 'name' => $emp_id, 'mostt' => $mostt, 'state' => $state, 'print' => 1
        ]);
        if ($state == 0) {
            $stateName = 'الكل';
        } else {
            $stateName = Constant::where('id', $state)->first();
        }
        if ($emp_id != 0 && $emp_id != null & $emp_id != '') {
            $emp_name = Admin::find($emp_id)->nick_name;
        } else {
            $emp_name = 'الكل';
        }
        $works = $this->workReport($request);
        $beneficialCount = 0;
        foreach ($works as $work) {
            if ($work->beneficial) {
                $beneficialCount++;
            }
        }
        return view('dashboard.dailyWork.print',
                compact('works', 'stateName', 'from', 'to', 'emp_name', 'beneficialCount'));
    }

    function prepearAttach($attachName, $attach_ids)
    {
//        $attachNameTemp = $attachName;
//        $attachName = array();
//        foreach ($attachNameTemp as $attach) {
//            if ($attach != null || $attach != '') {
//                array_push($attachName, $attach);
//            }
//        }
        $attachArr = array();
        if ($attach_ids) {
            for ($i = 0; $i < sizeof($attach_ids); $i++) {
                if ($attach_ids[$i] != 1) {
                    $temp = array();
                    $temp['attachName'] = trim($attachName[$i]);
                    $temp['attach_ids'] = trim($attach_ids[$i]);
                    $attachArr[] = $temp;
                }
            }
        }
        return $attachArr;
    }

    public function saveReport(Request $request)
    {
        $daily_work = DailyWork::find($request->rowId);
        if ($daily_work == null) {
            $daily_work = new DailyWork();
        }

        $daily_work->name = $request->formDataNameAR;
        $daily_work->model_id = $request->nameId;

        $date = explode('/', $request->date);
        $daily_work->date = $date[2].'-'.$date[1].'-'.$date[0];
        $daily_work->day = $request->day;
        $daily_work->start = $request->start;
        $daily_work->end = $request->end;
        $daily_work->added_by = Auth()->user()->id;
        $daily_work->files = $this->prepearAttach($request->attachName, $request->attach_ids);
        $daily_work->save();
        Work::where('day_work_id', $daily_work->id)->delete();
        for ($i = 0; $i < sizeof($request->work); $i++) {
            if ($request->work[$i] != null) {
                $work = Work::withTrashed()->find($request->work_id[$i]);

                if (!$work) {
                    $work = new Work();
                } else {
                    $work->restore();
                }
                $work->day_work_id = $daily_work->id;
                $work->date = $date[2].'-'.$date[1].'-'.$date[0];
                $work->work = $request->work[$i];
                $work->start = $request->from[$i];
                $work->end = $request->to[$i];
                $work->beneficial_id = $request->beneficialId[$i];
                $work->beneficial_name = $request->beneficial[$i];
                $work->beneficial_model = $request->beneficialModel[$i];
                ///////// if the user update beneficial by removeing it
                if (!$request->beneficial[$i]) {
                    $work->beneficial_id = null;
                    $work->beneficial_model = null;
                }
//                $work->notes = $request->note[$i];
                $work->state = $request->state[$i];
                $work->added_by = Auth()->user()->id;
                $work->save();
            }
        }
    }

    public function showReport(Request $request)
    {
        //Auth()->user()->id;
        if (Auth()->user()->id != 74 || Auth()->user()->id != 135) {
            $daily_work = DailyWork::where('model_id', $request->nameID)->get();
        } else {
            $daily_work = DailyWork::get();
        }

        $tempr = array();
        foreach ($daily_work as $sub) {
            $morfarr = array();
            $sub['work'] = json_decode($sub->work);
            $sub['fromTime'] = json_decode($sub->timefrom);
            $sub['toTime'] = json_decode($sub->timeto);
            $sub['most'] = json_decode($sub->most);
            $sub['note'] = json_decode($sub->note);
            $sub['morf'] = json_decode($sub->rowId);
            if ($sub['morf'] != null) {
                for ($i = 0; $i < sizeof($sub['morf']); $i++) {
                    $getfile = File::where('id', $sub['morf'][$i])->first();
                    array_push($morfarr, $getfile);
                }
            }
            $sub['morf'] = $morfarr;
            array_push($tempr, $sub);
        }
        return DataTables::of($tempr)->addIndexColumn()->make(true);
    }

    public function updateReport(Request $request)
    {
        $empWork = DailyWork::where('id', $request->work_id)->first();
        $empWork['work'] = json_decode($empWork->work);
        $empWork['fromTime'] = json_decode($empWork->timefrom);
        $empWork['toTime'] = json_decode($empWork->timeto);
        $empWork['most'] = json_decode($empWork->most);
        $empWork['note'] = json_decode($empWork->note);

        if (Auth()->user()->id == $empWork->model_id && $empWork->date == date("Y-m-d")) {
            return response()->json(['empWork' => $empWork, 'update' => 1]);
        } else {
            return response()->json(['empWork' => $empWork, 'update' => 0]);
        }

    }

    public function update_by_field(Request $request)
    {
        $date = explode('/', $request->date);
        $datee = $date[2].'-'.$date[1].'-'.$date[0];
        $empWork = DailyWork::where('model_id', $request->model_id)->where('date', $datee)->with('work')->first();
        if ($empWork && $empWork->files != null) {
            $temp = [];
            foreach ($empWork->files as $file) {
                $fileObj = $file;
                $rowFile = File::find($file->attach_ids);
                if ($rowFile) {
                    $fileObj->url = $rowFile->url;
                    $fileObj->real_name = $rowFile->real_name;
                    $fileObj->extension = $rowFile->extension;
                    $temp[] = $fileObj;
                }
            }
            $empWork->fileObj = $temp;
        }
        return response()->json($empWork);

    }

    public function workReport(Request $request)
    {
        if ($request->print == 1) {
            $from1 = $request->from;
            $to2 = $request->to;
        } else {
            $date1 = explode('/', $request->from);
            $from1 = $date1[2].'-'.$date1[1].'-'.$date1[0];

            $date2 = explode('/', $request->to);
            $to2 = $date2[2].'-'.$date2[1].'-'.$date2[0];
        }
        $searched = Work::/*with('day')->*/ with('stateName')->whereBetween('date', [$from1, $to2]);
        if ($request->name != null && $request->name != "" && $request->name != 0) {
            $searched = $searched->where('added_by', intval($request->name));
        }
        if ($request->mostt != null && $request->mostt != "" && $request->mostt != 0) {
            $searched = $searched->whereJsonContains('beneficial_id', intval($request->mostt));
        }
        if ($request->state != null && $request->state != "" && $request->state != 0) {
            $searched = $searched->where('state', $request->state);
        }
        if ($request->print == 1) {
            return $searched->get();
        } else {
            return DataTables::of($searched)->addIndexColumn()->make(true);
        }
    }
}
