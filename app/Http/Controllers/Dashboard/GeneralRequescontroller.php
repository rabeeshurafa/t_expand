<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\linkedTo;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\TicketConfig;
use App\Models\Department;
use App\Models\Constant;
use App\Models\Region;
use App\Models\ArchiveRole;
use App\Models\Setting;
use App\Models\Vehicle;
use App\Models\AppTicket44;
use App\Models\Archive;
use App\Models\CopyTo;
use App\Models\File;
use App\Models\TradeArchive;
use App\Models\AgendaTopic;
use DB;

class GeneralRequescontroller extends Controller
{
    var $fees = array();

    function loadDefaul($type = '')
    {
        $screen = Menu::where('s_function_url', '=', $type)->get()->first();
        // dd($screen);
        $ticket = TicketConfig::where('id', '=', $screen->pk_i_id)->with('Admin')->get()->first();
        $ticket->flows = json_decode($ticket->flow);
        $department = Department::where('enabled', 1)->get();
        $this->fees = DB::select("select fees_json from app_ticket".$ticket->ticket_no."s where app_type=".$ticket->app_type." order by id desc limit 1");
        return $ticket;

    }

    public function vacationRequest()
    {
        $type = 'vacationRequest';
        $ticketInfo = $this->loadDefaul($type);
        $vacTypes = Constant::where('parent', 6060)->where('status', 1)->get();
        $department = Department::where('enabled', 1)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $fees = $this->fees;
        $app_no = 32;
        return view('dashboard.generalRequest_Tickts.vacationRequest',
                compact('type', 'ticketInfo', 'department', 'vacTypes', 'archive_config', 'app_no', 'fees'));
    }

    public function internalMemo()
    {
        $maxRec = AppTicket44::select('app_no')->where('year', date('Y'))->orderBy('id', 'desc')->limit(1)->get();
        $max = 1;
        if (sizeof($maxRec) > 0) {
            $max = $maxRec[0]->app_no + 1;
        }

        $type = 'internalMemo';
        $ticketInfo = $this->loadDefaul($type);
        $positions = Constant::where('parent', 65)->where('status', 1)->get();
        $department = Department::where('enabled', 1)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $fees = $this->fees;
        $app_no = 44;
        return view('dashboard.generalRequest_Tickts.internalMemo',
                compact('type', 'ticketInfo', 'department', 'archive_config', 'app_no', 'fees', 'max', 'positions'));
    }

    public function leavePermission()
    {
        $type = 'leavePermission';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $vacTypes = Constant::where('parent', 6055)->where('status', 1)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $fees = $this->fees;
        $app_no = 28;
        return view('dashboard.generalRequest_Tickts.leavePermission',
                compact('type', 'ticketInfo', 'department', 'vacTypes', 'archive_config', 'app_no', 'fees'));
    }

    public function collecting()
    {
        $type = 'collecting';
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $fees = $this->fees;
        $app_no = 29;
        return view('dashboard.generalRequest_Tickts.collecting',
                compact('type', 'ticketInfo', 'department', 'region', 'archive_config', 'app_no', 'fees'));
    }

    public function ambulance()
    {
        $type = 'ambulance';
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $nurses = Constant::where('parent', 6395)->where('status', 1)->get();
        $transfer_froms = Constant::where('parent', 6396)->where('status', 1)->get();
        $transfer_tos = Constant::where('parent', 6397)->where('status', 1)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $fees = $this->fees;
        $app_no = 45;
        return view('dashboard.generalRequest_Tickts.ambulance',
                compact('type', 'ticketInfo', 'department', 'region', 'app_no', 'fees', 'nurses', 'transfer_froms',
                        'transfer_tos', 'archive_config'));
    }

    public function requestSpareParts()
    {
        $type = 'requestSpareParts';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $fees = $this->fees;
        $app_no = 33;
        return view('dashboard.generalRequest_Tickts.requestSpareParts',
                compact('type', 'ticketInfo', 'department', 'archive_config', 'app_no', 'fees'));
    }

    public function PurchaseOrder()
    {
        $type = 'PurchaseOrder';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $fees = $this->fees;
        $app_no = 31;
        return view('dashboard.generalRequest_Tickts.purchaseOrder',
                compact('type', 'ticketInfo', 'department', 'archive_config', 'app_no', 'fees'));
    }

    public function networkDevelopment()
    {
        $type = 'networkDevelopment';
        $ticketInfo = $this->loadDefaul($type);
        $networkTypes = Constant::where('parent', 6058)->where('status', 1)->get();
        $department = Department::where('enabled', 1)->get();
        $setting = Setting::first();
        $region = Region::where('town_id', $setting->town_id)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $fees = $this->fees;
        $app_no = 30;
        return view('dashboard.generalRequest_Tickts.networkDevelopment',
                compact('type', 'ticketInfo', 'department', 'region', 'networkTypes', 'archive_config', 'app_no',
                        'fees'));
    }

    public function vehicleMaintenance()
    {
        $type = 'vehicleMaintenance';
        $ticketInfo = $this->loadDefaul($type);
        $vehicles = Vehicle::where('enabled', 1)->get();
        $department = Department::where('enabled', 1)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $fees = $this->fees;
        $app_no = 37;
        return view('dashboard.generalRequest_Tickts.vehicleMaintenance',
                compact('type', 'ticketInfo', 'department', 'archive_config', 'app_no', 'fees', 'vehicles'));
    }

    public function refueling()
    {
        $type = 'refueling';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $vehicles = Vehicle::where('enabled', 1)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $oilTypes = Constant::where('parent', 6109)->where('status', 1)->get();
        $oilmetrecies = Constant::where('parent', 6268)->where('status', 1)->get();
        $fees = $this->fees;
        $app_no = 38;
        return view('dashboard.generalRequest_Tickts.refueling',
                compact('type', 'ticketInfo', 'department', 'archive_config', 'app_no', 'fees', 'oilTypes',
                        'oilmetrecies', 'vehicles'));
    }

    public function getArchive($type, $Id)
    {
        if ($type == 'trade_archive') {
            $archive['info'] = TradeArchive::where('id', $Id)->first();
            $attach = json_decode($archive['info']->json_feild);
            $attachIds = json_decode($archive['info']->attach_ids) ?? array();
            $count = sizeof($attachIds);
            $i = 0;
            foreach ($attach as $key => $value) {
                foreach ((array) $value as $key => $val) {
                    $temp = array();
                    if ($i < $count) {
                        $temp['id'] = $attachIds[$i];
                        $i++;
                    } else {
                        $temp['id'] = 0;
                    }
                    $temp['real_name'] = $key;
                    $temp['url'] = $val;
                }
                //dd($temp);
                $archive['files'][] = $temp;
            }
        } else if ($type == 'finance_archive') {
            $archive['info'] = Archive::find($Id);
            $attach = json_decode($archive['info']->json_feild);
            foreach ($attach as $key => $value) {
                foreach ((array) $value as $key => $val) {
                    $temp = array();
                    $temp['id'] = 0;
                    $temp['real_name'] = $key;
                    $temp['url'] = $val;
                }
                //dd($temp);
                $archive['files'][] = $temp;
            }
        } else if ($type == 'agenda_archieve') {
            $archive['info'] = AgendaTopic::find($Id);
            $archive['info']->url = "agenda_archieve";
            $archive['files'] = [];
            if (is_array(json_decode($archive['info']->file_ids))) {
                $files = File::whereIn('id', json_decode($archive['info']->file_ids))->get(['id', 'real_name', 'url']);
            }
            if (isset($files) && $files != null) {
                foreach ($files as $file) {
                    $temp = array();
                    $temp['id'] = $file->id;
                    $temp['real_name'] = $file->real_name;
                    $temp['url'] = $file->url;
                }
                $archive['files'][] = $temp;
            }
        } else {
            $archive['info'] = Archive::find($Id);
            $archive['files'] = File::where('archive_id', '=', $Id)->where('model_name', 'App\Models\Archive')->get();
            if($type== 'jal_archieve'){
                $archive['CopyTo'] = linkedTo::where('archive_id', '=', $Id)->where('enabled',1)->get();
                $archive['jalType'] = Constant::where('id', $archive['info']->type_id)->first();
            }else{
                $archive['CopyTo'] = CopyTo::where('archive_id', '=', $Id)->where('enabled', 1)->get();
            }
        }
        if ($type == 'mun_archieve') {
            $archive['docTypes'] = Constant::where('parent', 49)->where('status', 1)->get();
        } else if ($type == 'proj_archieve') {
            $archive['docTypes'] = Constant::where('parent', 53)->where('status', 1)->get();
        } else if ($type == 'assets_archieve') {
            $archive['docTypes'] = Constant::where('parent', 9)->where('status', 1)->get();
        } else if ($type == 'emp_archieve') {
            $archive['docTypes'] = Constant::where('parent', 50)->where('status', 1)->get();
        } else if ($type == 'dep_archieve' || $type == 'contract_archieve') {
            $archive['docTypes'] = Constant::where('parent', 51)->where('status', 1)->get();
        } else if ($type == 'cit_archieve') {
            $archive['docTypes'] = Constant::where('parent', 52)->where('status', 1)->get();
        } else if ($type == 'law_archieve') {
            $archive['docTypes'] = Constant::where('parent', 101)->where('status', 1)->get();
        } else if ($type == 'trade_archive' || $type == 'finance_archive') {
            $archive['docTypes'] = Constant::where('parent', 105)->where('status', 1)->get();
        }
        return $archive;
    }

    public function trackingArchive($archiveType, $archiveId)
    {
        // dd($type,$archiveId);
        $archive = $this->getArchive($archiveType, $archiveId);
        if (Auth()->user()->id == 74) {
            // dd($archive);
        }
        $type = 'trackingArchive';
        $ticketInfo = $this->loadDefaul($type);
        $department = Department::where('enabled', 1)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->get();
        $app_no = 45;
        return view('dashboard.trackingArchive.index',
                compact('type', 'ticketInfo', 'department', 'archive_config', 'app_no', 'archive'));
    }
}
