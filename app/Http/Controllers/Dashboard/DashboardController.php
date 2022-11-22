<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use Illuminate\Http\Request;
use DB;
use App\Models\LastTicket;
use Yajra\DataTables\DataTables;
use App\Models\Constant;
use App\Models\AppTrans;
use App\Models\Setting;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    var $archiveNames = array(
            'out_archieve' => 'صادر',
            'in_archieve' => 'وارد',
            'mun_archieve' => 'المؤسسة',
            'proj_archieve' => 'المشاريع',
            'assets_archieve' => 'الاصول',
            'emp_archieve' => 'الموظفين',
            'cit_archieve' => 'المواطنين',
            'law_archieve' => 'قوانين واجراءات',
            'dep_archieve' => 'اتفاقيات وعقود',
            'contract_archieve' => 'اتفاقيات وعقود',
            'finance_archive' => 'قسم المالية',
            'trade_archive' => 'المعاملات',
            'agenda_archieve' => 'الجلسات',
            'jal_archieve' => 'الجلسات',
    );
    public function getTypeAr($type)
    {
        if ($type == 'outArchive' || $type == 'out_archieve') {
            return 'الصادر';
        } else if ($type == 'inArchive' || $type == 'in_archieve') {
            return 'الوارد';
        } else if ($type == 'citArchive' || $type == 'cit_archieve') {
            return 'المواطنين';
        } else if ($type == 'customerArchive' || $type == 'customer_archieve') {
            return 'الزبائن';
        } else if ($type == 'munArchive' || $type == 'mun_archieve') {
            return 'المؤسسة';
        } else if ($type == 'financeArchive' || $type == 'finance_archive') {
            return 'المالية';
        } else if ($type == 'projArchive' || $type == 'proj_archieve') {
            return 'المشاريع';
        } else if ($type == 'assetsArchive' || $type == 'assets_archieve') {
            return 'الاصول';
        } else if ($type == 'empArchive' || $type == 'emp_archieve') {
            return 'الموظفين';
        } else if ($type == 'contractArchive' || $type == 'dep_archieve') {
            return 'الاتفاقيات والعقود';
        } else if ($type == 'lawArchieve' || $type == 'law_archieve') {
            return 'القوانين والاجرائات';
        } else if ($type == 'tradeArchive' || $type == 'trade_archive') {
            return 'المعاملات';
        } else if ($type == 'certArchive') {
            return 'شهادات / مراسات خارجية';
        } else if ($type == 'taskArchive') {
            return 'الطلبات';
        } else if ($type == 'WarningArchive') {
            return 'الاخطارات';
        } else if ($type == 'licArchive') {
            return 'رخص البناء';
        } else if ($type == 'agArchive' || $type == 'jal_archive' || $type == 'jalArchive') {
            return 'الجلسات';
        } else if ($type == 'others') {
            return 'أخرى';
        }
        return $type;
    }
    public function dashboard_info()
    {
        $archive_info = $this->getArchiveInfo();
        return $archive_info;
    }
    public function getArchiveInfo()
    {
        $archive['attachmentSize'] = 0;
        $archive_max = Archive::where('enabled', 1)
            ->whereNotNull('type')
            ->select(FacadesDB::raw("SUM(`sizeAttachments`) as sizeAttachments"))->first();
        $sum = 0;
        if($archive_max) { 
            $sum+= $archive_max->sizeAttachments;
        }
        $settings = Setting::first('max_upload');
        $max_upload =  $settings->max_upload;
        // foreach ($archive_max as $row) {
        //     $sizeAttachments = (float)$row->sizeAttachments;
        //     $sizeAttachments = round($sizeAttachments, 3);
        //     $sum_max = $sum_max +  $sizeAttachments;
        // }
        $sum = round($sum / 1000, 3);
        $archive['attachmentSize'] = $sum;
        $archive['used'] = round($sum / ((int)$max_upload * 1000), 4);
        $archive['max_upload'] = $max_upload;
        return $archive;
    }
    function masterQuery($where = '')
    {
        $sql = "";
        $lastTicket = LastTicket::find(1);
        for ($i = 1; $i <= $lastTicket->last_ticket; $i++) {
            if (Schema::hasTable('app_ticket3s')) {
                if ($i == 1) {
                    $sql .= " SELECT `id`, 1 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` where ticket_status != 5003";
                } // $sql.=" SELECT `id`, 1 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` where ticket_status in(1,5002)";
                else {
                    $sql .= " UNION SELECT `id`, 2 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` where ticket_status != 5003";
                }
                // $sql.=" UNION SELECT `id`, 2 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` where ticket_status in(1,5002)";
            } else {
                if ($i == 3) {
                    continue;
                }
                if ($i == 1) {
                    $sql .= " SELECT `id`, 1 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` where ticket_status != 5003";
                } // $sql.=" SELECT `id`, 1 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` where ticket_status in(1,5002)";
                else {
                    $sql .= " UNION SELECT `id`, 2 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` where ticket_status != 5003";
                }
                // $sql.=" UNION SELECT `id`, 2 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` where ticket_status in(1,5002)";
            }
        }
        return "select * from (".$sql.") a ".$where;
    }

    function indexMasterQuery($where = '', $start = 1, $end = 0)
    {
        $sql = "";
        $lastTicket = LastTicket::find(1);

        if ($end > $lastTicket->last_ticket) {
            $end = $lastTicket;
        }

        for ($i = $start; $i <= $end; $i++) {
            if ($i == 3) {
                continue;
            }
            if ($i == $start) {
                $sql .= " SELECT `id`, 1 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` where ticket_status in(1,5002)";
            } else {
                $sql .= " UNION SELECT `id`, 2 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` where ticket_status in(1,5002)";
            }
        }
        return "select * from (".$sql.") a ".$where;
    }

    function masterQuery2($where = '')
    {
        $sql = "";
        $lastTicket = LastTicket::find(1);
        for ($i = 1; $i <= $lastTicket->last_ticket; $i++) {
            if ($i == 3) {
                continue;
            }
            if ($i == 1) {
                $sql .= " SELECT `id`, 1 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` ";
            } else {
                $sql .= " UNION SELECT `id`, 2 related, `active_trans`, `ticket_status` FROM `app_ticket".$i."s` ";
            }
        }
        return "select * from (".$sql.") a ".$where;
    }

    function myTask()
    {
        $activeRec = $this->masterQuery(" where app_trans.id = a.active_trans");
        $res = DB::select("SELECT app_trans.*,admins.nick_name,admins.image FROM `app_trans` join admins on app_trans.sender_id=admins.id WHERE `reciver_id`=".Auth()->user()->id." and EXISTS ($activeRec) order by id desc");
        $arr = array();
        // dd($res);
        for ($i = 0; $i < count($res); $i++) {
            // $ticket=DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status in (1,5002) and id=".$res[$i]->ticket_id);
            $ticket = DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status !=6283 and id=".$res[$i]->ticket_id);
            if ($ticket) {
                // $ticket['trans']=$res[$i];
                // $ticket['config']=DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type)[0];
                // $ticket['response']=DB::select("SELECT app_responses.*,admins.nick_name,admins.image FROM `app_responses` join admins on app_responses.created_by=admins.id where trans_id=".$res[$i]->id." order by id desc limit 1");
                $arr[] = $ticket;
            }
        }
        //dd($arr);
        return $arr;
    }

    function sentTask()
    {
        $activeRec = $this->masterQuery(" where app_trans.id = a.active_trans");
        $res = DB::select("SELECT app_trans.*,admins.nick_name,admins.image FROM `app_trans` join admins on app_trans.reciver_id=admins.id WHERE app_trans.id in(
                            SELECT max(app_trans.id) id FROM `app_trans` where `sender_id`=".Auth()->user()->id."  group by `ticket_id`,`related`
                        ) order by app_trans.id desc");

        $arr = array();
        for ($i = 0; $i < count($res); $i++) {
            $ticket = DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status not in (5003) and id=".$res[$i]->ticket_id);
            if ($ticket) {
                // $ticket['trans']=$res[$i];
                // $config=DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type);
                // if(!$config){
                //     echo "SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type;
                //     exit;
                // }
                // $ticket['config']=DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type)[0];
                // $ticket['response']=DB::select("SELECT app_responses.*,admins.nick_name,admins.image FROM `app_responses` join admins on app_responses.created_by=admins.id where trans_id=".$res[$i]->id." order by id desc limit 1");
                $arr[] = $ticket;
            }
        }
        //dd($arr);
        return $arr;
    }

    function waittingTask()
    {
        $activeRec = $this->masterQuery(" where app_trans.id = a.active_trans");
        $res = DB::select("SELECT app_trans.*,admins.nick_name,admins.image FROM `app_trans` join admins on app_trans.reciver_id=admins.id 
        WHERE app_trans.id in(
                            SELECT max(app_trans.id) id FROM `app_trans` where `reciver_id`=".
                Auth()->user()->id."  group by `ticket_id`,`related` 
                        ) order by app_trans.id desc");
        $arr = array();

        for ($i = 0; $i < count($res); $i++) {
            $ticket = DB::select("SELECT `app_ticket".$res[$i]->related."s`.*,ifnull(t_constant.name,'') tname 
            FROM `app_ticket".$res[$i]->related."s` left join t_constant
            on t_constant.id=`app_ticket".$res[$i]->related."s`.ticket_status 
            where ticket_status =6283 and `app_ticket".$res[$i]->related."s`.id=".$res[$i]->ticket_id." and `app_ticket".$res[$i]->related."s`.active_trans = ".$res[$i]->id);
            // where ticket_status not in (1,5002,5003) and `app_ticket".$res[$i]->related."s`.id=".$res[$i]->ticket_id." and `app_ticket".$res[$i]->related."s`.active_trans = ".$res[$i]->id);


            if ($ticket) {
                // $ticket['trans']=$res[$i];
                // $ticket['config']=DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type)[0];
                // $ticket['response']=DB::select("SELECT app_responses.*,admins.nick_name,admins.image FROM `app_responses` join admins on app_responses.created_by=admins.id where trans_id=".$res[$i]->id." order by id desc limit 1");
                $arr[] = $ticket;
            }
        }
        //dd($arr);
        return $arr;
    }

    function taggedTask()
    {
        $activeRec = $this->masterQuery(" where app_trans.id = a.active_trans");
        $res = DB::select("SELECT app_trans.*,admins.nick_name,admins.image FROM `app_trans` join admins on app_trans.reciver_id=admins.id WHERE app_trans.id in(
                            SELECT max(app_trans.id) id FROM `app_trans` where json_contains(`tagged_users`,'\"".Auth()->user()->id."\"','$')=1 and json_contains(`finished_tag`,'\"".Auth()->user()->id."\"','$')=0  group by `ticket_id`,`related`
                        ) order by app_trans.id desc");
        $arr = array();
        for ($i = 0; $i < count($res); $i++) {
            $ticket = DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status !=5003 and id=".$res[$i]->ticket_id);
            if ($ticket) {
                // $ticket['trans']=$res[$i];
                // $ticket['config']=DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type)[0];
                // $ticket['response']=DB::select("SELECT app_responses.*,admins.nick_name,admins.image FROM `app_responses` join admins on app_responses.created_by=admins.id where trans_id=".$res[$i]->id." order by id desc limit 1");
                $arr[] = $ticket;
            }
        }
        //dd($arr);
        return $arr;
    }

    public function index()
    {
        $type = 'intro';
        $myTask = $this->myTask();
        $sentTask = $this->sentTask();
        $waittingTask = $this->waittingTask();
        $ticketTypeList = Constant::where('parent', 6029)->where('status', 1)->get();
        $taggedTask = $this->taggedTask();
        return view('dashboard.index',
                compact('type', 'myTask', 'sentTask', 'ticketTypeList', 'waittingTask', 'taggedTask'));
    }

    public function getMyTaskAjax()
    {
        $activeRec = $this->masterQuery(" where app_trans.id = a.active_trans");
        $res = DB::select("SELECT app_trans.*,admins.nick_name,admins.image FROM `app_trans` join admins on app_trans.sender_id=admins.id WHERE `reciver_id`=".Auth()->user()->id." and EXISTS ($activeRec) order by id desc");
        $arr = array();
        // dd($res);
        for ($i = 0; $i < count($res); $i++) {
            $ticket = DB::select("SELECT `app_ticket".$res[$i]->related."s`.*,ifnull(t_constant.name,'مفتوح') tname 
            FROM `app_ticket".$res[$i]->related."s` left join t_constant
            on t_constant.id=`app_ticket".$res[$i]->related."s`.ticket_status  where ticket_status !=6283 and `app_ticket".$res[$i]->related."s`.id=".$res[$i]->ticket_id);

            // $ticket=DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status !=6283 and id=".$res[$i]->ticket_id);
            // $ticket=DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status in (1,5002) and id=".$res[$i]->ticket_id);
            if ($ticket) {
                $ticket['trans'] = $res[$i];
                $ticket['config'] = DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type)[0];
                if ($res[$i]->related == 23) {
                    $constant = Constant::where('id', $ticket[0]->task_type)->first();
                    if ($constant != null) {
                        $ticket['ticketName'] = $constant->name;
                    }
                } else if ($res[$i]->related == 24) {
                    $constant = Constant::where('id', $ticket[0]->complaint_type)->first();
                    if ($constant != null) {
                        $ticket['ticketName'] = $constant->name;
                    }
                } else if ($res[$i]->related == 16) {
                    $constant = Constant::where('id', $ticket[0]->task_type)->first();
                    if ($constant != null) {
                        $ticket['ticketName'] = $constant->name;
                    }
                } else if ($res[$i]->related == 44) {
                    $ticket['ticketName'] = $ticket[0]->topic;
                }else if ($res[$i]->related == 46) {
                    if($ticket['0']->archive_type=='jal_archieve'){
                        $archive= Archive::find($ticket['0']->archive_id);
                        if($archive){
                            $ticket['0']->archive_title=$archive->subject;
                        }
                    }
                    $ticket['config']->ticket_name .= ' ' . $this->archiveNames[$ticket[0]->archive_type];
                }
                $ticket['response'] = DB::select("SELECT app_responses.*,admins.nick_name,admins.image FROM `app_responses` join admins on app_responses.created_by=admins.id where trans_id=".$res[$i]->id." order by id desc limit 1");
                $arr[] = $ticket;
            }
        }
        return DataTables::of($arr)
                ->addIndexColumn()
                ->make(true);
    }

    public function getMyWaterTaskAjax()
    {
        $activeRec = $this->indexMasterQuery(" where app_trans.id = a.active_trans and app_trans.ticket_type = 2 ", 1,
                11);
        $res = DB::select("SELECT app_trans.*,admins.nick_name,admins.image FROM `app_trans` join admins on app_trans.sender_id=admins.id WHERE `reciver_id`=".Auth()->user()->id." and EXISTS ($activeRec) order by id desc");
        $arr = array();
        // dd($res);
        for ($i = 0; $i < count($res); $i++) {
            $ticket = DB::select("SELECT `app_ticket".$res[$i]->related."s`.*,ifnull(t_constant.name,'مفتوح') tname 
            FROM `app_ticket".$res[$i]->related."s` left join t_constant
            on t_constant.id=`app_ticket".$res[$i]->related."s`.ticket_status  where ticket_status !=6283 and `app_ticket".$res[$i]->related."s`.id=".$res[$i]->ticket_id);
            // $ticket=DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status !=6283 and id=".$res[$i]->ticket_id);
            // $ticket=DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status in (1,5002) and id=".$res[$i]->ticket_id);
            if ($ticket) {
                $ticket['trans'] = $res[$i];
                $ticket['config'] = DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type)[0];

                $ticket['response'] = DB::select("SELECT app_responses.*,admins.nick_name,admins.image FROM `app_responses` join admins on app_responses.created_by=admins.id where trans_id=".$res[$i]->id." order by id desc limit 1");
                $arr[] = $ticket;
            }
        }
        return DataTables::of($arr)
                ->addIndexColumn()
                ->make(true);
    }

    public function getMyElecTaskAjax()
    {
        $activeRec = $this->masterQuery(" where app_trans.id = a.active_trans and app_trans.ticket_type = 1 ", 1, 17);
        $res = DB::select("SELECT app_trans.*,admins.nick_name,admins.image FROM `app_trans` join admins on app_trans.sender_id=admins.id WHERE `reciver_id`=".Auth()->user()->id." and EXISTS ($activeRec) order by id desc");
        $arr = array();
        // dd($res);
        for ($i = 0; $i < count($res); $i++) {
            $ticket = DB::select("SELECT `app_ticket".$res[$i]->related."s`.*,ifnull(t_constant.name,'مفتوح') tname 
            FROM `app_ticket".$res[$i]->related."s` left join t_constant
            on t_constant.id=`app_ticket".$res[$i]->related."s`.ticket_status  where ticket_status !=6283 and `app_ticket".$res[$i]->related."s`.id=".$res[$i]->ticket_id);
            // $ticket=DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status !=6283 and id=".$res[$i]->ticket_id);
            // $ticket=DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status in (1,5002) and id=".$res[$i]->ticket_id);
            if ($ticket) {
                $ticket['trans'] = $res[$i];
                $ticket['config'] = DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type)[0];
                $ticket['response'] = DB::select("SELECT app_responses.*,admins.nick_name,admins.image FROM `app_responses` join admins on app_responses.created_by=admins.id where trans_id=".$res[$i]->id." order by id desc limit 1");
                $arr[] = $ticket;
            }
        }
        return DataTables::of($arr)
                ->addIndexColumn()
                ->make(true);
    }

    public function getMyEngTaskAjax()
    {
        $activeRec = $this->masterQuery(" where app_trans.id = a.active_trans");
        $res = DB::select("SELECT app_trans.*,admins.nick_name,admins.image FROM `app_trans` join admins on app_trans.sender_id=admins.id WHERE `reciver_id`=".Auth()->user()->id." and EXISTS ($activeRec) order by id desc");
        $arr = array();
        // dd($res);
        for ($i = 0; $i < count($res); $i++) {
            $ticket = DB::select("SELECT `app_ticket".$res[$i]->related."s`.*,ifnull(t_constant.name,'مفتوح') tname 
            FROM `app_ticket".$res[$i]->related."s` left join t_constant
            on t_constant.id=`app_ticket".$res[$i]->related."s`.ticket_status  where ticket_status !=6283 and `app_ticket".$res[$i]->related."s`.id=".$res[$i]->ticket_id);
            // $ticket=DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status !=6283 and id=".$res[$i]->ticket_id);
            // $ticket=DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status in (1,5002) and id=".$res[$i]->ticket_id);
            if ($ticket) {
                $ticket['trans'] = $res[$i];
                $ticket['config'] = DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type)[0];
                $ticket['response'] = DB::select("SELECT app_responses.*,admins.nick_name,admins.image FROM `app_responses` join admins on app_responses.created_by=admins.id where trans_id=".$res[$i]->id." order by id desc limit 1");
                $arr[] = $ticket;
            }
        }
        return DataTables::of($arr)
                ->addIndexColumn()
                ->make(true);
    }

    public function getMyOtherTaskAjax()
    {
        $activeRec = $this->masterQuery(" where app_trans.id = a.active_trans");
        $res = DB::select("SELECT app_trans.*,admins.nick_name,admins.image FROM `app_trans` join admins on app_trans.sender_id=admins.id WHERE `reciver_id`=".Auth()->user()->id." and EXISTS ($activeRec) order by id desc");
        $arr = array();
        // dd($res);
        for ($i = 0; $i < count($res); $i++) {
            $ticket = DB::select("SELECT `app_ticket".$res[$i]->related."s`.*,ifnull(t_constant.name,'مفتوح') tname 
            FROM `app_ticket".$res[$i]->related."s` left join t_constant
            on t_constant.id=`app_ticket".$res[$i]->related."s`.ticket_status  where ticket_status !=6283 and `app_ticket".$res[$i]->related."s`.id=".$res[$i]->ticket_id);
            // $ticket=DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status !=6283 and id=".$res[$i]->ticket_id);
            // $ticket=DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status in (1,5002) and id=".$res[$i]->ticket_id);
            if ($ticket) {
                $ticket['trans'] = $res[$i];
                $ticket['config'] = DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type)[0];
                $ticket['response'] = DB::select("SELECT app_responses.*,admins.nick_name,admins.image FROM `app_responses` join admins on app_responses.created_by=admins.id where trans_id=".$res[$i]->id." order by id desc limit 1");
                $arr[] = $ticket;
            }
        }
        return DataTables::of($arr)
                ->addIndexColumn()
                ->make(true);
    }

    public function getWatingTaskAjax()
    {
        $activeRec = $this->masterQuery(" where app_trans.id = a.active_trans");
        $res = DB::select("SELECT app_trans.*,admins.nick_name,admins.image FROM `app_trans` join admins on app_trans.reciver_id=admins.id 
        WHERE app_trans.id in(
                            SELECT max(app_trans.id) id FROM `app_trans` where `reciver_id`=".
                Auth()->user()->id."  group by `ticket_id`,`related` 
                        ) order by app_trans.id desc");
        $arr = array();

        for ($i = 0; $i < count($res); $i++) {
            $ticket = DB::select("SELECT `app_ticket".$res[$i]->related."s`.*,ifnull(t_constant.name,'') tname 
            FROM `app_ticket".$res[$i]->related."s` left join t_constant
            on t_constant.id=`app_ticket".$res[$i]->related."s`.ticket_status 
            where ticket_status =6283 and `app_ticket".$res[$i]->related."s`.id=".$res[$i]->ticket_id." and `app_ticket".$res[$i]->related."s`.active_trans = ".$res[$i]->id);


            if ($ticket) {
                $ticket['trans'] = $res[$i];
                $ticket['config'] = DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type)[0];
                if ($res[$i]->related == 23) {
                    $constant = Constant::where('id', $ticket[0]->task_type)->first();
                    if ($constant != null) {
                        $ticket['ticketName'] = $constant->name;
                    }
                } else if ($res[$i]->related == 24) {
                    $constant = Constant::where('id', $ticket[0]->complaint_type)->first();
                    if ($constant != null) {
                        $ticket['ticketName'] = $constant->name;
                    }
                } else if ($res[$i]->related == 16) {
                    $constant = Constant::where('id', $ticket[0]->task_type)->first();
                    if ($constant != null) {
                        $ticket['ticketName'] = $constant->name;
                    }
                } else if ($res[$i]->related == 44) {
                    $ticket['ticketName'] = $ticket[0]->topic;
                } else if ($res[$i]->related == 46) {
                    if($ticket['0']->archive_type=='jal_archieve'){
                        $archive= Archive::find($ticket['0']->archive_id);
                        if($archive){
                            $ticket['0']->archive_title=$archive->subject;
                        }
                    }
                    $ticket['config']->ticket_name .= ' '.$this->archiveNames[$ticket[0]->archive_type];
                }
                $ticket['response'] = DB::select("SELECT app_responses.*,admins.nick_name,admins.image FROM `app_responses` join admins on app_responses.created_by=admins.id where trans_id=".$res[$i]->id." order by id desc limit 1");
                $arr[] = $ticket;
            }
        }
        //dd($arr);
        // return $arr;
        return DataTables::of($arr)
                ->addIndexColumn()
                ->make(true);
    }

    function getTaggedTaskAjax()
    {
        // $activeRec= $this->masterQuery(" where app_trans.id = a.active_trans");
        $res = DB::select("SELECT app_trans.*,admins.nick_name,admins.image FROM `app_trans` join admins on app_trans.reciver_id=admins.id WHERE app_trans.id in(
                            SELECT max(app_trans.id) id FROM `app_trans` where json_contains(`tagged_users`,'\"".Auth()->user()->id."\"','$')=1 
                            and json_contains(`finished_tag`,'\"".Auth()->user()->id."\"','$')=0 group by `ticket_id`,`related`
                        ) order by app_trans.id desc");
        $arr = array();
        for ($i = 0; $i < count($res); $i++) {
            // $ticket=DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status !=5003 and id=".$res[$i]->ticket_id);

            $ticket = DB::select("SELECT `app_ticket".$res[$i]->related."s`.*,ifnull(t_constant.name,'مفتوح') tname 
            FROM `app_ticket".$res[$i]->related."s` left join t_constant
            on t_constant.id=`app_ticket".$res[$i]->related."s`.ticket_status  where ticket_status !=5003 and `app_ticket".$res[$i]->related."s`.id=".$res[$i]->ticket_id);
            if ($ticket) {
                // $ticket['activeTrans']=AppTrans::where('id',$ticket[0]->active_trans)->with('Admin')->first();
                $ticket['trans'] = DB::select("SELECT app_trans.*,admins.nick_name,admins.image FROM `app_trans` join admins on app_trans.reciver_id=admins.id WHERE app_trans.id=".$ticket[0]->active_trans)[0];
                // $ticket['trans']=$res[$i];
                $ticket['config'] = DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type)[0];
                if ($res[$i]->related == 23) {
                    $constant = Constant::where('id', $ticket[0]->task_type)->first();
                    if ($constant != null) {
                        $ticket['ticketName'] = $constant->name;
                    }
                } else if ($res[$i]->related == 24) {
                    $constant = Constant::where('id', $ticket[0]->complaint_type)->first();
                    if ($constant != null) {
                        $ticket['ticketName'] = $constant->name;
                    }
                } else if ($res[$i]->related == 16) {
                    $constant = Constant::where('id', $ticket[0]->task_type)->first();
                    if ($constant != null) {
                        $ticket['ticketName'] = $constant->name;
                    }
                } else if ($res[$i]->related == 44) {
                    $ticket['ticketName'] = $ticket[0]->topic;
                } else if ($res[$i]->related == 46) {
                    if($ticket['0']->archive_type=='jal_archieve'){
                        $archive= Archive::find($ticket['0']->archive_id);
                        if($archive){
                            $ticket['0']->archive_title=$archive->subject;
                        }
                    }
                    $ticket['config']->ticket_name .= ' '.$this->archiveNames[$ticket[0]->archive_type];
                }
                // $ticket['response']=DB::select("SELECT app_responses.*,admins.nick_name,admins.image FROM `app_responses` join admins on app_responses.created_by=admins.id where trans_id=".$res[$i]->id." order by id desc limit 1");
                $ticket['response'] = DB::select("SELECT app_responses.*,admins.nick_name,admins.image FROM `app_responses` join admins on app_responses.created_by=admins.id where trans_id=".$ticket['trans']->id." and created_by=".$ticket['trans']->reciver_id." order by id desc limit 1");
                $arr[] = $ticket;
            }
        }
        if (Auth()->user()->id == 74) {
            // dd($arr);
        }

        return DataTables::of($arr)
                ->addIndexColumn()
                ->make(true);
    }

    function getSenTTaskAjax()
    {
        $activeRec = $this->masterQuery(" where app_trans.id = a.active_trans");
        $res = DB::select("SELECT app_trans.*,admins.nick_name,admins.image FROM `app_trans` join admins on app_trans.reciver_id=admins.id WHERE app_trans.id in(
                            SELECT max(app_trans.id) id FROM `app_trans` where `sender_id`=".Auth()->user()->id."  group by `ticket_id`,`related`
                        ) order by app_trans.id desc");

        $arr = array();
        for ($i = 0; $i < count($res); $i++) {

            $ticket = DB::select("SELECT * FROM `app_ticket".$res[$i]->related."s` where ticket_status !=5003 and id=".$res[$i]->ticket_id);
            // dd($ticket,$res[$i]);
            if ($ticket) {
                $ticket['trans'] = $res[$i];
                $config = DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type);
                $ticket['config'] = DB::select("SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type)[0];
                $ticket['response'] = DB::select("SELECT app_responses.*,admins.nick_name,admins.image FROM `app_responses` join admins on app_responses.created_by=admins.id where trans_id=".$res[$i]->id." order by id desc limit 1");
                if (!$config) {
                    echo "SELECT * FROM `ticket_configs` where ticket_no=".$res[$i]->related." and app_type=".$res[$i]->ticket_type;
                    exit;
                }

                if ($res[$i]->related == 23) {
                    $constant = Constant::where('id', $ticket[0]->task_type)->first();
                    if ($constant != null) {
                        $ticket['ticketName'] = $constant->name;
                    }
                } else if ($res[$i]->related == 24) {
                    $constant = Constant::where('id', $ticket[0]->complaint_type)->first();
                    if ($constant != null) {
                        $ticket['ticketName'] = $constant->name;
                    }
                } else if ($res[$i]->related == 16) {
                    $constant = Constant::where('id', $ticket[0]->task_type)->first();
                    if ($constant != null) {
                        $ticket['ticketName'] = $constant->name;
                    }
                } else if ($res[$i]->related == 44) {
                    $ticket['ticketName'] = $ticket[0]->topic;
                } else if ($res[$i]->related == 46) {
                    if($ticket['0']->archive_type=='jal_archieve'){
                        $archive= Archive::find($ticket['0']->archive_id);
                        if($archive){
                            $ticket['0']->archive_title=$archive->subject;
                        }
                    }
                    $ticket['config']->ticket_name .= ' '.$this->archiveNames[$ticket[0]->archive_type];
                }


                $arr[] = $ticket;
            }
        }
        //dd($arr);
        return DataTables::of($arr)
                ->addIndexColumn()
                ->make(true);
    }

}
