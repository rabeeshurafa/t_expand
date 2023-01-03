<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Managers\AttatchmentManager;
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
use stdclass;
use Carbon\Carbon;

class AgendaArchieveController extends Controller
{
    public function agendaArchiveForwording(Request $request)
    {
        $agendaDetail = AgendaDetail::with('AgendaExtention')->find($request->id);
        foreach ($agendaDetail->AgendaTopic as $row) {
            if (is_array(json_decode($row->file_ids))) {
                $row->setAttribute('files', File::whereIn('id', json_decode($row->file_ids))->get());
            } else {
                $row->setAttribute('files', array());
            }
        }
//        dd($agendaDetail);
        $agendaExtention = AgendaExtention::where('enabled', 1)->get();
        foreach ($agendaExtention as $agenda) {
            if ($agenda->employee == null) {
                $agenda->employee = json_encode(array());
            }
        }
        $type = 'agenda_archieve';

        $url = "agenda_archieve";

        $archive_type = AgendaExtention::get();

        return view('dashboard.archive.agenda',
                compact('type', 'archive_type', 'url', 'agendaExtention', 'agendaDetail'));

    }

    public function agendaAttach(Request $request)
    {
        if ($request->scannedRow > 0 && $request->mimeType != null && $request->scannedFileSrc != null) {
            $file = AttatchmentManager::saveScanedFile($request->mimeType, $request->scannedFileSrc);
            $all_files['all_files'] = [$file];
            return response()->json($all_files);
        } else {
            $frm = isset($request->fromname) ? $request->fromname : 'subject1';

            if ($request->hasFile($frm.'UploadFile')) {
                $files = $request->file($frm.'UploadFile');
                foreach ($files as $file) {
                    $url = AttatchmentManager::upload_image($file, 'quipent_');
                    if ($url) {
                        $file = new File();
                        $file->url = $url['path'];
                        $file->real_name = $url['name'];
                        $file->extension = $url['extension'];
                        $file->file_links = $url['fileLinks'];
                        $file->type = 2;
                        $file->save();
                        $uploaded_files['files'] = $file;
                    }
                    $data[] = $uploaded_files;
                }
                foreach ($data as $row) {
                    $files_ids[] = $row['files']->id;
                }
                Session::put('files_ids', $files_ids);

                $all_files['all_files'] = File::whereIn('id', $files_ids)->get();
                return response()->json($all_files);
            }
        }
    }

    public function searchEmpByName(Request $request)
    {
        $emp_data = $request['term'];
        $names = Admin::where('name', 'like', '%'.$emp_data.'%')->select('*', 'name as label')->get();
        return response()->json($names);
    }

    public function searchSubscriberByName(Request $request)
    {
        $emp_data = $request['term'];
        $names = User::where('name', 'like', '%'.$emp_data.'%')->select('*', 'name as label')->get();
        return response()->json($names);
    }

    public function doAddMeetingTitles(Request $request)
    {
        // dd($_POST);
        if ($request->id) {
            $agendaExtention = AgendaExtention::find($request->id);
        } else {
            $agendaExtention = new AgendaExtention();
        }
        $agendaExtention->name = $request->name_ar1;
        $agendaExtention->employee = json_encode(($request->MemberPerIDList ?? array()));
        $agendaExtention->admin = $request->managerID;
        $agendaExtention->users = json_encode($request->MemberIDList);
        $agendaExtention->signature_emp = $request->signature_emp;
        $agendaExtention->signature_jobtitle = $request->signature_jobtitle;
        // dd($agendaExtention);
        $agendaExtention->save();
        if ($agendaExtention) {
            return response()->json(['status' => trans('admin.extention_added')]);
        } else {
            return response()->json(['status' => $validator->errors()->all()]);
        }
    }

    public function deleteMeetingTitle(Request $request)
    {
        $data = AgendaExtention::find($request['id']);
        if ($data != null) {
            $data->enabled = 0;
            $data->deleted_by = Auth()->user()->id;
            $data->save();

            $agendaDetails = AgendaDetail::where('agenda_extention_id', $data->id)->get();
            if ($agendaDetails != null) {
                foreach ($agendaDetails as $agendaDetail) {
                    $agendaDetail->enabled = 0;
                    $agendaDetail->deleted_by = Auth()->user()->id;
                    $agendaDetail->save();

                    $agendaTopics = AgendaTopic::where('detail_id', $agendaDetail->id)->get();
                    if ($agendaTopics != null) {
                        foreach ($agendaTopics as $agendaTopic) {
                            $agendaTopic->enabled = 0;
                            $agendaTopic->deleted_by = Auth()->user()->id;
                            $agendaTopic->save();
                        }
                    }

                }
            }

        }
        return response()->json(['success' => trans('admin.meeting_deleted')]);
    }

    public function getMeetingDetailsByID(Request $request)
    {
        $meetingTitleList = AgendaExtention::with('Admin')->findOrFail($request['id']);
        //dd($meetingTitleList);
        $data = array();
        $data['id'] = $meetingTitleList->id;
        $data['name'] = $meetingTitleList->name;
        $data['employee'] = json_decode($meetingTitleList->employee);
        $empWithPriv = json_decode($meetingTitleList->employee);
        if (is_array($empWithPriv) && count($empWithPriv) > 0) {
            $data['employeeData'] = Admin::whereIn('id', $empWithPriv)->get();
        } else {
            $data['employeeData'] = array();
        }
        $data['admin'] = $meetingTitleList->admin;
        $data['adminData'] = Admin::find($meetingTitleList->admin);
        $data['users'] = json_decode($meetingTitleList->users);
        $data['usersData'] = Admin::whereIn('id',
                is_array(json_decode($meetingTitleList->users)) ? json_decode($meetingTitleList->users) : array())->get();
        $data['signature_emp'] = $meetingTitleList->signature_emp;
        $data['signature_empData'] = Admin::find($meetingTitleList->signature_emp);
        $data['signature_jobtitle'] = $meetingTitleList->signature_jobtitle;
        return response()->json($data);
    }

    public function ajaxEndMeeting(Request $request)
    {
        $meetingID = $request->meetingIDEnd;
        $res = 0;
        if ($meetingID != 0) {
            $agendaDetail = AgendaDetail::where('id', '=', $meetingID)->first();
            $agendaDetail->is_closed = 1;
            $res = $agendaDetail->save();
        }
        //dd($res);
        if ($res) {

            return response()->json(['success' => 'تم انهاء الجلسة']);
        }

        return response()->json(['error' => 'لم يتم انهاء الجلسة']);

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

    function meetingAttach(Request $request)
    {
        $meetingID = $request->meetingID;
        $res = array();
        if ($meetingID != 0) {
            $agendaDetail = AgendaDetail::where('id', '=', $meetingID)->first();
            $res = $this->getAttach(json_decode($agendaDetail->file_ids));
        }

        return response()->json($res);
    }

    function prepearAttach(Request $request)
    {
        $attach_ids = $request->attach_ids;
        $attachName = $request->attachName ?? [];
        $attachArr = array();
        if ($attach_ids) {
            for ($i = 0; $i < sizeof($attach_ids); $i++) {
                if($attach_ids[$i]!=null) {
                    $temp = array();
                    $temp['attachName'] = trim($attachName[$i]);
                    $temp['attach_ids'] = trim($attach_ids[$i]);
                    $attachArr[] = $temp;
                }
            }
        }
        return $attachArr;
    }

    public function attachMeeting(Request $request)
    {
        $meetingID = $request->meetingID;
        $res = 0;
        if ($meetingID != 0) {
            $agendaDetail = AgendaDetail::where('id', '=', $meetingID)->first();
            $agendaDetail->file_ids = json_encode($this->prepearAttach($request));
            // $agendaDetail->is_closed=1;
            $res = $agendaDetail->save();
        }
        //dd($res);
        if ($res) {

            return response()->json(['success' => 'تم حفظ المرفقات']);
        }

        return response()->json(['error' => 'لم يتم الحفظ']);

    }

    public function ajaxDisplayMeeting(Request $request)
    {
        $agenda_id = $request->agenda_id;
        $meetingTitleName = $request->meetingTitleName;
        $agendaNum = $request->agendaNum;
        $agendaDetail = AgendaDetail::where('agenda_extention_id', '=', $meetingTitleName)->where('agenda_number', '=',
                $agendaNum)->where('enabled', 1)->get()->first();
        if ($agendaDetail) {
            foreach ($agendaDetail->AgendaTopic as $row) {
                if (is_array(json_decode($row->file_ids))) {
                    $row->setAttribute('files', File::whereIn('id', json_decode($row->file_ids))->get());
                } else {
                    $row->setAttribute('files', array());
                }
                $row->setAttribute('AgendaTopic',
                        AgendaTopic::where('detail_id', $row->id)->where('enabled', 1)->orderBy('id', 'asc')->get());
            }
        } else {
            $agendaDetail = array();
        }

        //$meetingTitleList = AgendaTopic::where('detail_id','=',$agendaDetail->id)->get();//findOrFail($request['id']);
        return response()->json($agendaDetail);
    }

    public function archieve_agenda_report(Request $request)
    {
        $agendaDetail['result'] = AgendaDetail::query();

        if ($request->get('meetingTitleName')) {
            $agendaDetail['result']->where('agenda_extention_id', '=', $request->get('meetingTitleName'));
        }

        if ($request->get('agendaNum')) {

            $agendaDetail['result']->where('agenda_number', '=', $request->get('agendaNum'));
        }

        if ($request->get('start') && $request->get('end')) {

            $from = date_create(($request->get('start')));

            $from = explode('/', ($request->get('start')));

            $from = $from[2].'-'.$from[1].'-'.$from[0];

            $to = date_create(($request->get('end')));

            $to = explode('/', ($request->get('end')));

            $to = $to[2].'-'.$to[1].'-'.$to[0];

            $agendaDetail['result']->whereBetween('agenda_date', [$from, $to]);

        }

        $agendaDetail['result'] = $agendaDetail['result']->with('AgendaTopic')->get();
        //dd($agendaDetail['result']);
        if ($agendaDetail['result']) {
            foreach ($agendaDetail['result'] as $agendaDetails) {
                foreach ($agendaDetails->AgendaTopic as $row) {
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

                    if ($row->file_ids != "null") {
                        $row->setAttribute('files', File::whereIn('id', json_decode($row->file_ids))->get());
                    } else {
                        $row->setAttribute('files', array());
                    }

                    // }

                }
            }
        }
        //dd($agendaDetail['result']);
        return response()->json($agendaDetail);

    }

    public function doEditMeetingTitle(Request $request)
    {
        $agendaExtention = AgendaExtention::find($request['id']);
        $agendaExtention->name = $request['meetingnamear'];
        $agendaExtention->employee = json_encode($request->meetingPerEmpList);
        $agendaExtention->admin = $request->meetingmanager;
        $agendaExtention->users = json_encode($request->MemberNameList);
        $agendaExtention->save();
        if ($agendaExtention) {
            return response()->json(['success' => trans('admin.extention_added')]);
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    function upload_image($file, $prefix)
    {
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
                'extension' => $file->getClientOriginalExtension(),
                'path' => Storage::cloud()->url($filePath)
        ];
    }

    public function ajaxSaveMeeting(Request $request)
    {
        $rowToBeSaved = $request->rowToBeSaved;
        if ($request->meetingID == 0) {
            $agendaDetail = new AgendaDetail();
            $agendaDetail->agenda_number = $request->agendaNum;
            $agendaDetail->agenda_date = $request->agendaDate;
            $agendaDetail->agenda_extention_id = $request->meetingTitleName;
            $agendaDetail->signature_emp = $request->signature_emp;
            $agendaDetail->signature_jobtitle = $request->signature_jobtitle;
            $meetingID = $agendaDetail->save();
        } else {
            $agendaDetail = AgendaDetail::find($request->meetingID);
        }

        $descision = $request->input("descisiontxt".$rowToBeSaved);
        if (!$descision) {
            $descision = "";
        }
        $agendaTopic = AgendaTopic::find($request->input("topicid2".$rowToBeSaved));
        if (!$agendaTopic) {
            $agendaTopic = new AgendaTopic();
        }
        $agendaTopic->title = $request->input("topicTitle".$rowToBeSaved);
        $agendaTopic->connected_to = $request->input("applicantID".$rowToBeSaved);
        $agendaTopic->model = $request->input("applicantType".$rowToBeSaved);
        $agendaTopic->converterFrom = $request->input("converterFrom".$rowToBeSaved);
        $agendaTopic->recommendation = $request->input("recommendation".$rowToBeSaved);
        $agendaTopic->agendaDetailId = $request->input("agendaDetailId".$rowToBeSaved);
        $agendaTopic->agendaTopicId = $request->input("agendaTopicId".$rowToBeSaved);
        $agendaTopic->descision = $descision;
        $agendaTopic->file_ids = json_encode($request->input("subject".$rowToBeSaved."id"));
        $agendaTopic->connected_to_txt = $request->input("applicantName".$rowToBeSaved);
        $agendaTopic->detail_id = ($request->meetingID == 0) ? $agendaDetail->id : $request->meetingID;
        $agendaTopic->created_by = Auth()->user()->id;
        $topicid = $agendaTopic->save();
        $data = array('id' => $agendaDetail->id, 'topicid' => $agendaTopic->id);
        //dd($data);
        return response()->json($data);
    }

    public function ajaxSaveDesicion(Request $request)
    {
        ///dd($request);
        $meetingID = $request->meetingID;
        $lastorder = $request->lastorder;
        $agendaTopic = AgendaTopic::find($request->input("topicid".$lastorder));
        $agendaTopic->title = $request->input("topicTitle".$lastorder);
        $user = $request->input("applicantID".$lastorder);
        if ($user == null) {
            $user = 0;
        }
        $agendaTopic->connected_to = $user;
        $agendaTopic->model = $request->input("applicantType".$lastorder);
        $agendaTopic->descision = $request->input("descisiontxt".$lastorder);
        $agendaTopic->file_ids = json_encode($request->input("subject".$lastorder."id"));
        $agendaTopic->connected_to_txt = $request->input("applicantName".$lastorder);
        $agendaTopic->converterFrom = $request->input("converterFrom".$lastorder);
        $agendaTopic->recommendation = $request->input("recommendation".$lastorder);
        $agendaTopic->agendaDetailId = $request->input("agendaDetailId".$lastorder);
        $agendaTopic->agendaTopicId = $request->input("agendaTopicId".$lastorder);
        $agendaTopic->detail_id = $meetingID;
        $agendaTopic->created_by = Auth()->user()->id;
        $topicid = $agendaTopic->save();
        $data = array('id' => $meetingID, 'topicid' => $topicid);
        return response()->json($data);
    }

    public function printMeeting($agenda_id)
    {
        if (!$agenda_id) {
            return response()->json(404);
        }
        $agendaDetail = AgendaDetail::where('id', '=', $agenda_id)->where('enabled', 1)->with('AgendaExtention',
                'AgendaTopic')->first();
        //dd($agendaDetail);
        if ($agendaDetail) {
            foreach ($agendaDetail->AgendaTopic as $row) {
                if (is_array(json_decode($row->file_ids))) {
                    $row->setAttribute('files', File::whereIn('id', json_decode($row->file_ids))->get());
                } else {
                    $row->setAttribute('files', array());
                }
                $row->setAttribute('AgendaTopic',
                        AgendaTopic::where('detail_id', $row->id)->where('enabled', 1)->orderBy('id', 'asc')->get());
            }
            $data['agendaDetail'] = $agendaDetail;
            $meetingTitleList = $agendaDetail->AgendaExtention;
            $data['employee'] = json_decode($meetingTitleList->employee);
            $data['usersData'] = Admin::whereIn('id',
                    is_array(json_decode($meetingTitleList->users)) ? json_decode($meetingTitleList->users) : array())->get();
            $empWithPriv = $meetingTitleList->employee ? json_decode($meetingTitleList->employee) : null;
            if (is_array($empWithPriv) && count($empWithPriv) > 0) {
                $data['employeeData'] = Admin::whereIn('id', $empWithPriv)->get();
            } else {
                $data['employeeData'] = array();
            }

            $employeeNames = [];
            foreach ($data['usersData'] as $employee) {
                $employeeNames[] = $employee->nick_name;
            }

            $date = $agendaDetail->agenda_date;
            $data['date'] = $date;
            /// in carbon m/d/y so will swap it //////
            if ($date) {
                $newDate = explode('/', $date);
                $swap = $newDate[1];
                $newDate[1] = $newDate[0];
                $newDate[0] = $swap;
                $newDate = implode('/', $newDate);

                $carbon = new Carbon($newDate);
                $carbon = $carbon->format('l');

                $days = [
                        'Saturday' => 'السبت',
                        'Sunday' => 'الأحد',
                        'Monday' => 'الاثنين',
                        'Tuesday' => 'الثلاثاء',
                        'Wednesday' => 'الاربعاء',
                        'Thursday' => 'الخميس',
                        'Friday' => 'الجمعة'
                ];
                $data['day'] = $days[$carbon];
            } else {
                $data['day'] = '';
            }
            $data['meeting_name'] = $meetingTitleList->name;
            $data['employeeName'] = implode(', ', $employeeNames);
            $data['employeeNameArr'] = $employeeNames;
            $data['admin'] = $meetingTitleList->admin;
            $data['adminData'] = Admin::find($meetingTitleList->admin);
            $data['users'] = json_decode($meetingTitleList->users);
            $data['print_input'] = $agendaDetail->print_input ? json_decode($agendaDetail->print_input) : null;
            $data['signature_emp'] = $meetingTitleList->signature_emp;
            $data['signature_empData'] = Admin::find($meetingTitleList->signature_emp);
            $data['signature_jobtitle'] = $meetingTitleList->signature_jobtitle;
        }
//        dd($data);
        return view('dashboard.archive.printMeeting', compact('data'));
    }

    public function printDes(Request $request)
    {
        ///dd($request);
        $res = AgendaTopic::with('AgendaDetail')->with('AgendaDetail.AgendaExtention')
                ->with('AgendaDetail.AgendaExtention.Admin')->find($request->id);
//        dd($res);
        if ($res) {
            $res->print_input = $res->print_input ? json_decode($res->print_input) : null;
        }
        $type = 'printDes';
        return view('dashboard.archive.printDes', compact('res'));

    }

    public function savePrintMeeting(Request $request)
    {
        $print_input = new stdclass();
        foreach ($request->all() as $key => $val) {
            $print_input->$key = $val;
        }
        $agenda_id = $request->meeting_id;
        if (!$agenda_id) {
            return response()->json(404);
        }
        $agendaDetail = AgendaDetail::where('id', '=', $agenda_id)->where('enabled', 1)->first();
        if ($agendaDetail == null) {
            return response()->json(404);
        }
        $agendaDetail->print_input = json_encode($print_input);
        $agendaDetail->save();
        if ($agendaDetail) {
            return response()->json(['info' => $agendaDetail, 'status' => true, 'message' => trans('تم الحفظ')]);
        }
        return response()->json(['status' => false, ',message' => 'حدث خطأ']);
    }

    public function savePrintDes(Request $request)
    {
        $print_input = new stdclass();
        foreach ($request->all() as $key => $val) {
            $print_input->$key = $val;
        }
        $agenda_id = $request->topic_id;
        if (!$agenda_id) {
            return response()->json(404);
        }
        $agendaTopic = AgendaTopic::where('id', '=', $agenda_id)->where('enabled', 1)->first();
        if ($agendaTopic == null) {
            return response()->json(404);
        }
        $agendaTopic->print_input = json_encode($print_input);
        $agendaTopic->save();
        if ($agendaTopic) {
            return response()->json(['info' => $agendaTopic, 'status' => true, 'message' => trans('تم الحفظ')]);
        }
        return response()->json(['status' => false, ',message' => 'حدث خطأ']);
    }
}
