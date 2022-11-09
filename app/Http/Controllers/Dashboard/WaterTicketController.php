<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\TicketConfig;
use App\Models\Constant;
use App\Models\Region;
use App\Models\Department;
use App\Models\User;
use App\Models\File;
use App\Models\water;
use App\Models\elec;
use App\Models\License;
use App\Models\Archive;
use App\Models\AgendaTopic;
use App\Models\CopyTo;
use App\Models\ArchiveLicense;
use DB;
use App\Models\ArchiveRole;
use App\Models\Cert;
use App\Models\Setting;
use App\Models\Warning;
use App\Models\Admin;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class WaterTicketController extends Controller
{
    var $app_type = 1;
    var $fees = array();

    function loadDefaul($type = '')
    {
        $screen = Menu::where('s_function_url', '=', $type)->get()->first();
        $ticket = TicketConfig::where('id', '=', $screen->pk_i_id)->with('Admin')->get()->first();
        $ticket->flows = json_decode($ticket->flow);
        $department = Department::where('enabled', 1)->get();
        $this->fees = DB::select("select fees_json from app_ticket".$ticket->ticket_no."s where app_type=".$ticket->app_type." order by id desc limit 1");
        return $ticket;

    }

    public function getUserData(Request $request)
    {

        $user['info'] = User::find($request['id']);

        $model = $user['info']->model;

        $ArchiveCount = Archive::where('model_id', $request['id'])->where('enabled', 1)
                ->where('model_name', $model)->count();

        $user['outArchiveCount'] = Archive::where('model_id', $request['id'])->where('enabled', 1)
                ->where('model_name', $model)->where('type', 'outArchive')->count();

        $user['inArchiveCount'] = Archive::where('model_id', $request['id'])->where('enabled', 1)
                ->where('model_name', $model)->where('type', 'inArchive')->count();

        $user['otherArchiveCount'] = Archive::where('model_id', $request['id'])->where('enabled', 1)
                ->where('model_name', $model)->whereNotIn('type', ['outArchive', 'inArchive'])->count();

        $user['licArchiveCount'] = ArchiveLicense::where('model_id', $request['id'])->where('enabled', 1)
                ->where('model_name', $model)->where('type', 'licArchive')->count();

        $user['licFileArchiveCount'] = ArchiveLicense::where('model_id', $request['id'])->where('enabled', 1)
                ->where('model_name', $model)->where('type', 'licFileArchive')->count();

        $user['copyToCount'] = CopyTo::where('model_id', $request['id'])->where('enabled', 1)
                ->where('model_name', $model)->count();

        $user['linkToCount'] = AgendaTopic::where('connected_to', $request['id'])
                ->where('model', $model)->count();

        $jalArchiveCount = AgendaTopic::where('connected_to', $request['asset_id'])
                ->where('model', $model)->count();

        $user['certCount'] = Cert::where('citizen_id', $request['id'])->where('t_farfromcenter.e_type', 1)->count();

        $user['contractArchiveCount'] = Archive::where('model_id', $request['asset_id'])->where('enabled', 1)
                ->where('model_name', $model)->where('type', 'contractArchive')->count();

        $CopyToCount = CopyTo::where('model_id', $request['id'])->where('enabled', 1)
                ->where('model_name', $model)->count();

        $ArchiveLicCount = ArchiveLicense::where('model_id', $request['id'])->where('enabled', 1)
                ->where('model_name', $model)->count();

        $user['ArchiveCount'] = $ArchiveCount + $CopyToCount + $ArchiveLicCount + $jalArchiveCount;

        return $user;

    }

    public function appCustomer(Request $request)
    {

        $subscriber_data = $request['id'];
        $valid = 1;
        $errorList = array();
        $names = User::where('id', $request['id'])->where('enabled',
                1)->select('*')->with('jobLic')->with('License')->get();
        $warnings = Warning::where('warning_status', 6240)->where('enabled', 1)->where('subscriber_id',
                $request['id'])->with('type')->with('addBy')->get();
        foreach ($warnings as $warning) {
            // dd($warning->addBy);
            $dept = Department::where('id', $warning->addBy->department_id)->first();
            $warning->setAttribute("dept", $dept);
        }
        $msg = '';

        foreach ($names as $name) {
            foreach ($name->jobLic as $job) {
                $carbon = new Carbon($job->end_date);
                $nowDate = Carbon::now();
                $isSertEnd = $carbon->gt($nowDate);
                $cost = 0;
                if ($isSertEnd == false) {
                    $res = $carbon->diffInDays($nowDate, false);
                    $years = intval($res / 365);
                    $years += (($res % 365) > 0 ? 1 : 0);

                    $setting = Setting::first();
                    $cost = ($setting->job_lic_cost * $years);
                    $job['years'] = $years;
                    $job['cost'] = $cost;
                } else {
                    $job['years'] = 0;
                    $job['cost'] = 0;
                }
                if (!$isSertEnd && $job['years'] > 0) {
                    $errorList[] = 'المشترك لديه رخص حرف منتهية بتاريخ: '
                            .$job->end_date;
                }
                $job['statuse'] = $isSertEnd;

            }
            $name->setAttribute("validLic", $valid);
            if ($name->enabled == 0) {
                $errorList[] = 'حساب المستخدم معطل';
            }
            $name->setAttribute("errorList", $errorList);
            $name->setAttribute("warning", $warnings);
            $name->setAttribute("water",
                    water::with('Counter')->where('user_id', $request['id'])->where('enabled', 1)->get());
            $name->setAttribute("elec",
                    elec::with('Counter')->where('user_id', $request['id'])->where('enabled', 1)->get());
            $name->setAttribute("lic", license::where('user_id', $request['id'])->where('enabled', 1)->count());

        }

        if ($names->isNotEmpty()) {
            $names[0]->setAttribute("archive", $this->getUserData($request));
            //$html = view('dashboard.component.auto_complete', compact('names'))->render();
            return response()->json($names[0]);

        }
        return response()->json([]);

    }

    function upload_image($file, $prefix)
    {

        // if ($file) {

        //     $files = $file;

        //     $imageName = $prefix . rand(3, 999) . '-' . time() . '.' . $files->extension();

        //     $image = "storage/" . $imageName;

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

    function saveFilesArchieve(Request $request, $taskname, $tasklink, $attachid)
    {

        $i = count($request->attachName);
        $archive = new Archive();

        $archive->model_id = $request->subscriber_id;

        $archive->type_id = '6046';

        $archive->name = $request->subscriber_name;

        $archive->model_name = 'App\\Models\\User';

        $date = date("Y/m/d");

        $from = explode('/', ($date));

        $from = $from[0].'-'.$from[1].'-'.$from[2];

        $archive->date = $from;

        $archive->task_name = $taskname;

        $archive->task_link = $tasklink;

        $archive->title = $request->attachName[($i - 1)];

        $archive->type = 'taskArchive';

        $archive->serisal = '';

        $archive->url = 'cit_archieve';

        $archive->add_by = Auth()->user()->id;

        $archive->save();

        $file = File::find($attachid);
        $file->archive_id = $archive->id;

        $file->model_name = "App\Models\Archive";

        $file->save();

    }

    function saveResFilesArchieve(Request $request, $taskname, $tasklink, $attachid)
    {

        $i = count($request->attachName1);
        $archive = new Archive();

        $archive->model_id = $request->subscriberId1;

        $archive->type_id = '6046';

        $archive->name = $request->subscriberName1;

        $archive->model_name = 'App\\Models\\User';

        $date = date("Y/m/d");

        $from = explode('/', ($date));

        $from = $from[0].'-'.$from[1].'-'.$from[2];

        $archive->date = $from;

        $archive->task_name = $taskname;

        $archive->task_link = $tasklink;

        $archive->title = $request->attachName1[($i - 1)];

        $archive->type = 'taskArchive';

        $archive->serisal = '';

        $archive->url = 'cit_archieve';

        $archive->add_by = Auth()->user()->id;

        $archive->save();

        $file = File::find($attachid);
        $file->archive_id = $archive->id;

        $file->model_name = "App\Models\Archive";

        $file->save();

    }

    function saveCertFilesArchieve(Request $request, $taskname, $tasklink, $attachid)
    {

        $i = count($request->attachName);
        $archive = new Archive();

        $archive->model_id = $request->applicantID;


        $archive->type_id = '6046';

        $archive->name = $request->citizen_name;

        $archive->model_name = $request->model;

        $date = date("Y/m/d");

        $from = explode('/', ($date));

        $from = $from[0].'-'.$from[1].'-'.$from[2];

        $archive->date = $from;

        $archive->task_name = $taskname;

        $archive->task_link = $tasklink;

        $archive->title = $request->attachName[($i - 1)];

        $archive->type = 'certArchive';

        $archive->serisal = '';

        if ($request->model == 'App\\Models\\User') {
            $archive->url = 'cit_archieve';
        } else {
            $archive->url = 'org_archieve';
        }

        $archive->add_by = Auth()->user()->id;

        $archive->save();

        $file = File::find($attachid);
        $file->archive_id = $archive->id;

        $file->model_name = "App\Models\Archive";

        $file->save();

    }

    function saveWarningArchieve(Request $request, $taskname, $tasklink, $attachid)
    {

        $i = count($request->attachName1);
        $archive = new Archive();

        $archive->model_id = $request->subscriberID;


        $archive->type_id = '6046';

        $archive->name = $request->subscriberName;

        $archive->model_name = 'App\\Models\\User';

        $date = date("Y/m/d");

        $from = explode('/', ($date));

        $from = $from[0].'-'.$from[1].'-'.$from[2];

        $archive->date = $from;

        $archive->task_name = $taskname;

        $archive->task_link = $tasklink;

        $archive->title = $request->attachName1[($i - 1)];

        $archive->type = 'WarningArchive';

        $archive->serisal = '';

        $archive->url = 'Warning_archieve';

        $archive->add_by = Auth()->user()->id;

        $archive->save();

        $file = File::find($attachid);
        $file->archive_id = $archive->id;

        $file->model_name = "App\Models\Archive";

        $file->save();

    }

    public function uploadTicketAttach(Request $request)
    {
        // dd($request->all());
        $data = array();
        $files_ids = array();
        $name = $request->attachfileName ? $request->attachfileName : 'attachfile';
        if ($request->hasFile($name)) {
            $file = $request->file($name);
            $url = $this->upload_image($file, 'quipent_');
            if ($url) {
                $uploaded_files['files'] = File::create([
                        'url' => $url['path'], 'real_name' => $url['name'], 'extension' => $url['extension'],
                        'type' => '2',
                ]);
            }
            $data[] = $uploaded_files;

            foreach ($data as $row) {
                $files_ids[] = $row['files']->id;
            }
            $all_files['all_files'] = File::whereIn('id', $files_ids)->get();

            if ($request->app_id != null) {

                $link = 'viewTicket/'.$request->app_id.'/'.$request->tiketrelated;
                $name = $request->tiketName.' '.$request->tiketAppNo;
                $attachid = $all_files['all_files'][0]->id;
                $this->saveFilesArchieve($request, $name, $link, $attachid);

            } else if ($request->ticket_id != null) {

                $link = 'viewTicket/'.$request->ticket_id.'/'.$request->tiketrelated;
                $name = $request->tiketName.' '.$request->tiketAppNo;
                $attachid = $all_files['all_files'][0]->id;
                $this->saveResFilesArchieve($request, $name, $link, $attachid);

            } else if ($request->cer_pk_id != null) {

                $link = '';
                $name = 'شهادات / مراسات خارجية';
                $attachid = $all_files['all_files'][0]->id;
                $this->saveCertFilesArchieve($request, $name, $link, $attachid);

            } else if ($request->warningId != null) {

                $link = '';
                $name = 'اخطار';
                $attachid = $all_files['all_files'][0]->id;
                $this->saveWarningArchieve($request, $name, $link, $attachid);

            }
            return response()->json($all_files);

        }

    }

    public function prepareFlow($nextDeptIds, $nextEmpIds, $nextIsMandatorys, $defaultEmpToReceive)
    {
        $flow = array();
        $count = 0;
        $firstEmp = Admin::where('id', $defaultEmpToReceive)->first();
        $temp = array();
        if ($firstEmp != null) {
            $temp['nextDeptId'] = $firstEmp->department_id;
            $temp['nextEmpId'] = $firstEmp->id;
            $temp['nextIsMandatory'] = 2;
        } else {
            $temp['nextDeptId'] = 0;
            $temp['nextEmpId'] = 0;
        }
        $flow[] = $temp;
        if (is_array($nextDeptIds)) {
            foreach ($nextDeptIds as $nextDeptId) {
                if ($nextDeptId != null) {
                    $temp = array();
                    $temp['nextDeptId'] = $nextDeptId;
                    $temp['nextEmpId'] = $nextEmpIds[$count];
                    $temp['nextIsMandatory'] = $nextIsMandatorys[$count];
                    $flow[] = $temp;
                }
                $count++;
            }
        }
        return $flow;
    }

    public function storeDebtSittings(Request $request)
    {
//        dd($request->all());
        $ticketConfig = TicketConfig::find($request->id);
        $debtConfigs=[];
        for ($i = 0; $i < sizeof($request->debtIndex); $i++) {
            $debtConfigTemp=[];
            $debtConfigTemp['debtIndex']=$request->debtIndex[$i];
            $debtConfigTemp['isDebtMandatory']=$request->isDebtMandatory[$i];
            $debtConfigTemp['moneyResponsibleEmp']=$request[('moneyResponsibleEmp'.($i+1))]??array();
            $debtConfigTemp['payedResponsibleEmp']=$request[('payedResponsibleEmp'.($i+1))]??array();
            $debtConfigs[] = $debtConfigTemp;
        }
        $ticketConfig->debt_settings=$debtConfigs;
        $ticketConfig2 = TicketConfig::find($request->id);
        $res=$ticketConfig->save();
        if ($res) {

            return response()->json(['success' => 'تمت العملية بنجاح']);
        }

        return response()->json(['error' => 'حدث خطأ غير متوقع']);
    }

    public function store_config(Request $request)
    {
        $ticketConfig = TicketConfig::find($request->id);
        $ticketConfig->single_receive = $request->single_receive;
        $ticketConfig->show_receipt = $request->show_receipt;
        $ticketConfig->receipt_is_need = $request->receipt_is_need;
        $ticketConfig->has_price_list = $request->has_price_list;
        $ticketConfig->dept_id = $request->dept_id;
        $ticketConfig->send_sms = $request->send_sms;
        $ticketConfig->emp_to_receive = $request->reciver;
        $ticketConfig->time_to_close = $request->time_to_close;
        $ticketConfig->has_clearance = $request->has_clearance;
        $ticketConfig->has_attach = $request->has_attach;
        $ticketConfig->has_debt_list = $request->has_debt_list;
        $ticketConfig->force_attach = $request->force_attach;
        $ticketConfig->show_archive = $request->show_archive;
        $ticketConfig->apply_with_finished_license = $request->apply_with_finished_license;
        $ticketConfig->apply_for_band_customer = $request->apply_for_band_customer;
        $ticketConfig->public_app = $request->public_app;
        $ticketConfig->can_reply = $request->can_reply;
        $ticketConfig->emp_to_close_json = json_encode(is_array($request->emp_to_close_json) ? $request->emp_to_close_json : array());
        $ticketConfig->emp_to_revoke_json = json_encode(is_array($request->emp_to_revoke_json) ? $request->emp_to_revoke_json : array());
        $ticketConfig->emp_to_update_json = json_encode(is_array($request->emp_to_update_json) ? $request->emp_to_update_json : array());
        $ticketConfig->emp_to_reopen_ticket = json_encode(is_array($request->emp_to_reopen_ticket) ? $request->emp_to_reopen_ticket : array());
        $ticketConfig->emp_to_report_ticket = json_encode(is_array($request->emp_to_report_ticket) ? $request->emp_to_report_ticket : array());
        $ticketConfig->emp_to_tag_ticket = json_encode(is_array($request->emp_to_tag_ticket) ? $request->emp_to_tag_ticket : array());
        $ticketConfig->emp_to_access_portal = json_encode(is_array($request->emp_to_access_portal) ? $request->emp_to_access_portal : array());
        $ticketConfig->archive_btn = $request->archive_btn;
        if ($request->required_nationalID != null) {
            $ticketConfig->required_nationalID = $request->required_nationalID;
            $ticketConfig->show_nationalID = $request->show_nationalID;
        }
        $ticketConfig->joblic_btn = $request->joblic_btn;
        $ticketConfig->apps_btn = $request->apps_btn;
        $ticketConfig->id = $request->id;
        $ticketConfig->fk_i_updated_by = Auth()->user()->id;
        $ticketConfig->flow = json_encode($this->prepareFlow($request->nextDeptId, $request->nextEmpId,
                $request->nextIsMandatory, $request->reciver));
        $res = $ticketConfig->save();
        if ($res) {

            return response()->json(['success' => 'تمت العملية بنجاح']);
        }

        return response()->json(['error' => 'حدث خطأ غير متوقع']);
    }

    public function WaterSubscription()
    {
        $subsList = Constant::where('parent', 39)->where('status', 1)->get();
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $type = 'WaterSubscription';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $app_type = 2;
        $fees = $this->fees;
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $app_no = 1;
        return view('dashboard.water_ticket.subscription',
                compact('type', 'ticketInfo', 'department', 'subsList', 'region', 'app_type', 'fees', 'archive_config',
                        'app_no'));
    }

    public function WaterNewTicket3()
    {
        $type = 'WaterSubscription';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $app_type = 2;
        $fees = $this->fees;
        return view('dashboard.water_ticket.subscription',
                compact('type', 'ticketInfo', 'department', 'app_type', 'fees'));
    }

    public function waterLineDisconnect()
    {
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $type = 'waterLineDisconnect';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $app_type = 2;
        $fees = $this->fees;
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $app_no = 6;
        return view('dashboard.water_ticket.disconnect',
                compact('type', 'ticketInfo', 'region', 'department', 'app_type', 'fees', 'archive_config', 'app_no'));
    }

    public function globalWaterMalfunction()
    {
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $type = 'globalWaterMalfunction';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $app_type = 2;
        $fees = $this->fees;
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $app_no = 4;
        return view('dashboard.water_ticket.globalMalfunction',
                compact('type', 'ticketInfo', 'department', 'region', 'app_type', 'fees', 'archive_config', 'app_no'));
    }

    public function waterMalfunction()
    {
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $type = 'waterMalfunction';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $app_type = 2;
        $fees = $this->fees;
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $app_no = 2;
        return view('dashboard.water_ticket.malfunction',
                compact('type', 'ticketInfo', 'department', 'region', 'app_type', 'fees', 'archive_config', 'app_no'));
    }

    public function meterCheck()
    {
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $type = 'waterMeterCheck';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $app_type = 2;
        $fees = $this->fees;
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $app_no = 5;
        return view('dashboard.water_ticket.meterCheck',
                compact('type', 'ticketInfo', 'region', 'department', 'app_type', 'fees', 'archive_config', 'app_no'));
    }

    public function meterRead()
    {
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $type = 'waterMeterRead';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $app_type = 2;
        $fees = $this->fees;
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $app_no = 9;
        return view('dashboard.water_ticket.meterRead',
                compact('type', 'region', 'ticketInfo', 'department', 'app_type', 'fees', 'archive_config', 'app_no'));
    }

    public function waterPermission()
    {
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $subsList = Constant::where('parent', 6032)->get();
        $converterNos = Constant::where('parent', 6208)->get();
        $type = 'waterPermission';
        $ticketInfo = $this->loadDefaul($type);
        // dd($ticketInfo);
        $department = Department::where('enabled', '=', '1')->get();
        $app_type = 2;
        $fees = $this->fees;
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $app_no = 3;
        return view('dashboard.water_ticket.appTicket3',
                compact('type', 'region', 'ticketInfo', 'department', 'app_type', 'subsList', 'fees', 'archive_config',
                        'app_no', 'converterNos'));
    }

    public function waterLineReconnect()
    {
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $type = 'waterLineReconnect';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $app_type = 2;
        $fees = $this->fees;
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $app_no = 7;
        return view('dashboard.water_ticket.reconnect',
                compact('type', 'region', 'ticketInfo', 'department', 'app_type', 'fees', 'archive_config', 'app_no'));
    }

    public function disconnect()
    {
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $type = 'reconnect';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $app_type = 2;
        $fees = $this->fees;
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        return view('dashboard.water_ticket.disconnect',
                compact('type', 'ticketInfo', 'region', 'department', 'app_type', 'fees', '$archive_config'));
    }

    public function waiveSubscription()
    {
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $type = 'waiveWaterSubscription';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $app_type = 2;
        $fees = $this->fees;
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $app_no = 8;
        return view('dashboard.water_ticket.waiveSubscription',
                compact('type', 'region', 'ticketInfo', 'department', 'app_type', 'fees', 'archive_config', 'app_no'));
    }

    public function meterTransfer()
    {
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $type = 'waterMeterTransfer';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $app_type = 2;
        $fees = $this->fees;
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $app_no = 10;
        return view('dashboard.water_ticket.meterTransfer',
                compact('type', 'region', 'ticketInfo', 'department', 'app_type', 'fees', 'archive_config', 'app_no'));
    }

    public function waterFinancialTransfer()
    {
        $type = 'waterFinancialTransfer';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $app_type = 2;
        $fees = $this->fees;
        $app_no = 11;
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        return view('dashboard.water_ticket.FinancialTransfer',
                compact('type', 'ticketInfo', 'department', 'app_type', 'fees', 'archive_config', 'app_no'));
    }

    public function buildingSewage()
    {
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $type = 'buildingSewage';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $app_type = 2;
        $fees = $this->fees;
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $app_no = 41;
        return view('dashboard.water_ticket.buildingSewage',
                compact('type', 'ticketInfo', 'department', 'region', 'app_type', 'fees', 'archive_config', 'app_no'));
    }
}
