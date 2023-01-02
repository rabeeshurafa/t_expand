<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AgendaTopic;
use App\Models\CopyTo;
use App\Models\TradeArchive;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Admin;
use App\Models\User;
use App\Models\TicketConfig;
use App\Models\Constant;
use App\Models\Region;
use App\Models\AppTicket1;
use App\Models\AppTicket2;
use App\Models\AppTicket3;
use App\Models\AppTicket4;
use App\Models\AppTicket5;
use App\Models\AppTicket6;
use App\Models\AppTicket7;
use App\Models\AppTicket8;
use App\Models\AppTicket9;
use App\Models\AppTicket10;
use App\Models\AppTicket11;
use App\Models\AppTicket12;
use App\Models\AppTicket13;
use App\Models\AppTicket14;
use App\Models\AppTicket15;
use App\Models\AppTicket16;
use App\Models\AppTicket17;
use App\Models\AppTicket18;
use App\Models\AppTicket19;
use App\Models\AppTicket20;
use App\Models\AppTicket21;
use App\Models\AppTicket22;
use App\Models\AppTicket23;
use App\Models\AppTicket24;
use App\Models\AppTicket25;
use App\Models\AppTicket26;
use App\Models\AppTicket27;
use App\Models\AppTicket28;
use App\Models\AppTicket29;
use App\Models\AppTicket30;
use App\Models\AppTicket31;
use App\Models\AppTicket32;
use App\Models\AppTicket33;
use App\Models\AppTicket34;
use App\Models\AppTicket35;
use App\Models\AppTicket36;
use App\Models\AppTicket37;
use App\Models\AppTicket38;
use App\Models\AppTicket39;
use App\Models\AppTicket40;
use App\Models\AppTicket41;
use App\Models\AppTicket42;
use App\Models\AppTicket43;
use App\Models\AppTicket44;
use App\Models\AppTicket45;
use App\Models\AppTicket46;
use App\Http\Requests\TicketRequest;
use App\Http\Requests\TicketRequest2;
use App\Http\Requests\TicketRequest3;
use App\Http\Requests\TicketRequest4;
use App\Http\Requests\TicketRequest5;
use App\Http\Requests\TicketRequest6;
use App\Http\Requests\TicketRequest7;
use App\Http\Requests\TicketRequest8;
use App\Http\Requests\TicketRequest9;
use App\Http\Requests\TicketRequest11;
use App\Http\Requests\TicketRequest12;
use App\Http\Requests\TicketRequest13;
use App\Http\Requests\TicketRequest14;
use App\Http\Requests\TicketRequest15;
use App\Http\Requests\TicketRequest16;
use App\Http\Requests\TicketRequest17;
use App\Http\Requests\TicketRequest18;
use App\Http\Requests\TicketRequest19;
use App\Http\Requests\TicketRequest20;
use App\Http\Requests\TicketRequest21;
use App\Http\Requests\TicketRequest22;
use App\Http\Requests\Ticket23Request;
use App\Http\Requests\Ticket39Request;
use App\Http\Requests\Ticket40Request;
use App\Http\Requests\Ticket44Request;
use App\Http\Requests\Ticket15Request;
use App\Http\Requests\TicketRequest45;
use App\Models\Setting;
use App\Models\AppTrans;
use App\Models\water;
use App\Models\elec;
use App\Models\License;
use App\Models\Smslog;
use App\Models\AppResponse;
use App\Models\Department;
use App\Models\Order;
use App\Models\PortalTicket;
use DB;
use App\Models\Archive;
use stdClass;

class AppOp extends Controller
{
    var $user_name = '';
    var $user_pass = '';
    var $sender = '';

    function prepearAttach(Request $request)
    {
        $attach_ids = $request->attach_ids;
//        $attachNameTemp = ($request->attachName ?? array());
        $attachName = ($request->attachName ?? array());
//        foreach ($attachNameTemp as $attach) {
//            if ($attach != null || $attach != '') {
//                array_push($attachName, $attach);
//            }
//        }
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

    function prepearFees(Request $request)
    {
        $feesValue = $request->feesValue;
        $feesValue2 = $request->feesValue2;
        $feesText = $request->feesText;
        $attachArr = array();
        if ($feesText) {
            for ($i = 0; $i < sizeof($feesText); $i++) {
                if (trim($feesText[$i]) != '') {
                    $temp = array();
                    $temp['feesText'] = trim($feesText[$i]);
                    $temp['feesValue'] = trim($feesValue[$i]);
                    $temp['feesValue2'] = trim($feesValue2[$i]);
                    $attachArr[] = $temp;
                }
            }
        }
        return $attachArr;
    }

    function prepeardebt(Request $request)
    {
        $debtName = $request->debtname;
        $debtValue = $request->debtValue;
        $debtEmp = $request->debtEmp;
        $debtEmpID = $request->debtEmpID;
        $newDebtEmp = $request->newDebtEmp;
        $newDebtEmpID = $request->newDebtEmpID;
        $debtPayed = $request->debtPayed;
        $debtVoucher = $request->debtVoucher;
        $debtArr = array();
        if ($debtName) {
            for ($i = 0; $i < sizeof($debtName); $i++) {
                if (trim($debtName[$i]) != '') {
                    $temp = array();
                    $temp['debtName'] = trim($debtName[$i]);
                    $temp['debtValue'] = trim($debtValue[$i]);
                    $temp['newDebtEmpID'] = trim($newDebtEmpID[$i]);
                    $temp['newDebtEmp'] = trim($newDebtEmp[$i]);
                    $temp['debtEmpID'] = trim($debtEmpID[$i]);
                    $temp['debtEmp'] = trim($debtEmp[$i]);
                    $temp['debtPayed'] = trim($debtPayed[$i]);
                    $temp['debtVoucher'] = trim($debtVoucher[$i]);
                    $debtArr[] = $temp;
                }
            }
        }
        return $debtArr;
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

    function updateCMobile($customer, $mobile)
    {
        $mystring = $mobile;
        $findme = '056';

        $user = User::find($customer);
        if (!$user) {
            return;
        }
        //dd($user);
        $pri = substr($mystring, 0, 3);
        if ($pri == $findme) {
            $user->phone_two = $mystring;
        } else {
            $user->phone_one = $mystring;
        }
        $user->save();
    }

    function updateCNationalID($customer, $nationalID)
    {
        $mystring = $nationalID;

        $user = User::find($customer);
        if (!$user) {
            return;
        }
        //dd($user);

        $user->national_id = $nationalID;
        $user->save();
    }

    function dowaivesubscription(Request $request)
    {
        // dd($request->all());
        if ($request->related == 8) {
            $ticket = AppTicket8::where('id', $request->ticket_id)->first();

            if ($ticket->subs != null && $ticket->app_type == 2) {
                $subs = Water::whereIn('id', json_decode($ticket->subs))->get();
                if ($subs != null) {
                    foreach ($subs as $water) {
                        $water->user_id = $ticket->customer_id1;
                        if ($water->notes != null) {
                            $water->notes .= ' - '.' تم التنازل عن الاشتراك من '.$ticket->customer_name.'  إلى '.$ticket->customer_name1.' بواقع طلب رقم '.$ticket->app_no;
                        } else {
                            $water->notes = ' تم التنازل عن الاشتراك من '.$ticket->customer_name.'  إلى '.$ticket->customer_name1.' بواقع طلب رقم '.$ticket->app_no;
                        }

                        $water->save();
                    }
                }
            } else if ($ticket->subs != null && $ticket->app_type == 1) {
                $subs = elec::whereIn('id', json_decode($ticket->subs))->get();
                if ($subs != null) {
                    foreach ($subs as $elec) {
                        $elec->user_id = $ticket->customer_id1;
                        if ($elec->notes != null) {
                            $elec->notes .= ' - '.' تم التنازل عن الاشتراك من '.$ticket->customer_name.'  إلى '.$ticket->customer_name1.' بواقع طلب رقم '.$ticket->app_no;
                        } else {
                            $elec->notes = ' تم التنازل عن الاشتراك من '.$ticket->customer_name.'  إلى '.$ticket->customer_name1.' بواقع طلب رقم '.$ticket->app_no;
                        }

                        $elec->save();
                    }
                }
            }
        } else if ($request->related == 35) {
            $ticket = AppTicket35::where('id', $request->ticket_id)->first();

            if ($ticket->licNo != null) {
                $subs = License::where('id', $ticket->licNo)->first();
                if ($subs != null) {
                    $subs->user_id = $ticket->customer_id1;
                    if ($subs->notes != null) {
                        $subs->notes .= ' - '.' تم التنازل عن الرخصة من '.$ticket->customer_name.'  إلى '.$ticket->customer_name1.' بواقع طلب رقم '.$ticket->app_no;
                    } else {
                        $subs->notes = ' تم التنازل عن الرخصة من '.$ticket->customer_name.'  إلى '.$ticket->customer_name1.' بواقع طلب رقم '.$ticket->app_no;
                    }

                    $subs->save();
                }
            }
        }

        if ($subs != null) {
            return response()->json([
                    'subs' => $subs, 'app_id' => $ticket->id, 'app_type' => $request->related,
                    'success' => trans('تم الحفظ')
            ]);
        } else {
            return response()->json(['app_id' => $ticket->id, 'app_type' => $request->related, 'error' => 'حدث خطأ']);
        }
    }

//////////////////////////////////////////////////////for Production//////////////////////////////////////////////////////////////////////

    function sendSMS($mobile, $msg)
    {
        //{"url":"http:\/\/hotsms.ps\/","sendSMS":1,"page":"sendbulksms.php","username":"Zababdeh M","password":"5873071","sender":"Zababdeh M"}
        //  $username=urlencode('Expand.psss');
        //  $password=urlencode('7688278777');
        $username = urlencode('Expand.ps');
        $password = urlencode('9836960');
        $sender = urlencode('Expand.ps');
        $match = array();
        $message1 = urlencode($msg);
        $result = file_get_contents("http://hotsms.ps/sendbulksms.php?user_name=".$username."&user_pass=".$password."&sender=".$sender."&mobile=$mobile&type=2&text=".$message1);
        return $result;
    }

    function addSmsLog($app_ticket, $sender, $txt, $s_mobile, $reciver_name, $app_id, $app_type)
    {
        $setting = Setting::find(13);
        $str1 = $s_mobile;
        $pattern = "/\d{10}/";
        $mob = '';
        if (preg_match($pattern, $str1, $match)) {
            if (strlen($match[0]) == 10) {
                $mob = substr($match[0], 1, 9);
            } else {
                return;
            }
        } else {
            return;
        }
        $mob = '972'.$mob;
        $smslog = new Smslog();
        $smslog->sender = $sender;
        $smslog->txt = $txt;
        $smslog->s_mobile = $mob;
        $smslog->reciver_name = $reciver_name;
        $smslog->app_id = $app_id;
        $smslog->app_type = $app_type;
        $smslog->app_ticket = $app_ticket;
        // $smslog->status=SmsManager::sendSms($mob,$txt."-".$setting->name_ar);
        $smslog->status = $this->sendSMS($mob, $txt."-".$setting->name_ar);
        $smslog->save();
        return ($smslog->status);
    }

    public function directAddSmsLog(Request $request)
    {
        // $config=TicketConfig::where('ticket_no',$request->ticketNo)->where('app_type',$request->app_type)->first('ticket_name');
        // dd($config);
        $txt = $request->smsText;
        $s_mobile = $request->smsNo;
        $reciver_name = $request->subscriber_name;
        $app_id = $request->ticket_id;
        $app_type = $request->app_type;

        // dd($request->all());
        $smsStatus = $this->addSmsLog($request->ticketNo, Auth()->user()->id, $txt, $s_mobile, $reciver_name, $app_id,
                $app_type);
        // $smsStatus = 1001;
        if ($smsStatus == 1001) {
            $ticket = DB::select("select * from app_ticket".$request->ticketNo."s where id=".$request->ticket_id)[0];
            if ($ticket != null) {
                $appResponse = new AppResponse();
                $appResponse->trans_id = $ticket->active_trans;
                $appResponse->ticket_id = $ticket->id;
                $appResponse->app_type = $request->ticketNo;
                $txt1 = 'تم ارسال رسالة نصية إلى الرقم : ';
                $txt1 .= $s_mobile.' <br> '.$txt;
                $appResponse->s_text = $txt1;
                $appResponse->i_status = $ticket->ticket_status;
                $appResponse->trans_note = '';
                $appResponse->created_by = Auth()->user()->id;
                $appResponse->i_source = 2;
                $appResponse->save();
            }
        }

        return response()->json([
                'app_id' => $app_id, 'smsStatus' => $smsStatus, 'app_type' => $app_type,
                'success' => trans('تم الارسال')
        ]);
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function addReplay(Request $request)
    {
//        dd($request->all());
        if ($request->removeTag == true) {
            $appTranses = AppTrans::where('ticket_id', $request->ticket_id)->where('related',
                    $request->app_type)->get();
            $finished_tag = array();
            foreach ($appTranses as $trans) {
                $finished_tag = json_decode($trans->finished_tag);
                array_push($finished_tag, strval(Auth()->user()->id));
                $trans->finished_tag = $finished_tag;
                $trans->save();
            }
        }
        $appTrans = AppTrans::find($request->trans_id);
        if ($appTrans) {

            DB::update("update app_ticket".$appTrans->related."s set ticket_status=".$request->app_status1." where id=".$request->ticket_id);
        }

        if ($request->s_response != null) {
            $str = $request->s_response;
        } else {
            $str = 'تم تحويل الطلب';
        }
        if ($request->note != null) {
            $str .= '<br/><b style="color:#5599FE">ملاحظات: </b>'.trim($request->note);
        }

        $appResponse = new AppResponse();
        $appResponse->trans_id = $request->trans_id;
        $appResponse->ticket_id = $request->ticket_id;
        $appResponse->app_type = $request->app_type;
        $appResponse->s_text = $request->details.$request->details1;//.(strlen(trim($request->details))>0?'<br /><b style="color:#5599FE">ملاحظات: </b>'.$request->details1:$request->details1);
        $appResponse->i_status = $request->app_status1;
        $appResponse->trans_note = '';
        $appResponse->created_by = Auth()->user()->id;
        $appResponse->i_source = 1;

        $attach_ids = $request->attach_ids;
        $attachName = ($request->attachName1 ?? array());
        $attachArr = array();
        if ($attach_ids) {
            for ($i = 0; $i < sizeof($attach_ids); $i++) {
                if ($attach_ids[$i] != null && $attach_ids[$i] != "undefined") {
                    $temp = array();
                    $temp['attachName'] = trim($attachName[$i]);
                    $temp['attach_ids'] = trim($attach_ids[$i]);
                    $attachArr[] = $temp;
                }
            }
        }
        $appResponse->file_ids = json_encode($attachArr);
        $appResponse->save();
        if ($appResponse) {
            try {
                if (($request->notArchived1 != null)) {
                    $link = 'viewTicket/'.$request->ticket_id.'/'.$appTrans->related;
                    $name = $request->tiketName.' '.$request->tiketAppNo;
                    $this->saveReplyScannedFilesArchieve($request, $name, $link);
                }
            } catch (\Exception $e) {
            }
            return response()->json([
                    'receiverid' => $appTrans->reciver_id, 'app_id' => $appTrans->ticket_id,
                    'app_type' => $appTrans->related, 'success' => trans('تم الحفظ')
            ]);
        }
        return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
    }

    public function addTrans(Request $request)
    {

        $ticket = DB::select("select * from app_ticket".$request->related."s where id=".$request->ticket_id);
        $config = TicketConfig::where('ticket_no', $request->related)->where('app_type', $request->app_type)->first();
        if ($ticket[0]->ticket_status == 5003 || $ticket[0]->ticket_status == 6283) {
            DB::update("update app_ticket".$request->related."s set ticket_status= 1"." where id=".$request->ticket_id);
        }

        $flows = json_decode($config->flow);
        if (sizeof($flows) > ($ticket[0]->flow_index)) {
            $nextFlow = $flows[($ticket[0]->flow_index)];
        }
        if (isset($nextFlow) && $request->AssDeptID == $nextFlow->nextDeptId) {
            DB::update("update app_ticket".$request->related."s set flow_index= ".($ticket[0]->flow_index + 1)." where id=".$request->ticket_id);
        }

        $res_id = intval($request->AssignedToID);
        $user_name = Admin::select('nick_name')->where('id', '=', $res_id)->first();
        if ($request->s_response != null) {
            $str = $request->s_response;
            $str .= '<br/><b> تم تحويل الطلب الى  '.$user_name['nick_name'].'</b>';
        } else {
            $str = 'تم تحويل الطلب الى  ';
            $str .= $user_name['nick_name'];
        }
        if ($request->note != null) {
            $str .= '<br/><b style="color:#5599FE">ملاحظات: </b>'.trim($request->note);
        }

        $appTrans = new AppTrans();
        $appTrans->ticket_id = $request->ticket_id;
        $appTrans->ticket_type = $request->app_type;
        $appTrans->sender_id = Auth()->user()->id;
        $appTrans->reciver_id = $request->AssignedToID;
        $appTrans->s_note = $str;
        $appTrans->recive_type = 1;
        $appTrans->is_seen = 0;
        $appTrans->curr_dept = $request->AssDeptID;
        $appTrans->related = $request->related;
        $appTrans->created_by = Auth()->user()->id;
        $tag = $request->tags ? $request->tags : array();
        $appTrans->tagged_users = json_encode($tag);

        $attach_ids = $request->attach_ids;
        $attachName = ($request->attachName1 ?? array());

        $attachArr = array();
        if ($attach_ids) {
            for ($i = 0; $i < sizeof($attach_ids); $i++) {
                if ($attach_ids[$i] != null && $attach_ids[$i] != "undefined") {
                    $temp = array();
                    $temp['attachName'] = trim($attachName[$i]);
                    $temp['attach_ids'] = trim($attach_ids[$i]);
                    $attachArr[] = $temp;
                }
            }
        }
        $appTrans->file_ids = json_encode($attachArr);
        $appTrans->save();
        DB::update("update app_ticket".$request->related."s set active_trans=".$appTrans->id." where id=".$request->ticket_id);
        if ($appTrans) {
            try {
                if (($request->notArchived1 != null)) {
                    $link = 'viewTicket/'.$request->ticket_id.'/'.$request->related;
                    $name = $config->ticket_name.'  ('.$ticket[0]->app_no.')';
                    $request->subscriberName1 = $ticket[0]->customer_name;
                    $request->subscriberId1 = $ticket[0]->customer_id;
                    $this->saveReplyScannedFilesArchieve($request, $name, $link);
                }

            } catch (\Exception $e) {
            }

            return response()->json([
                    'app_id' => $request->ticket_id, 'app_type' => $request->related, 'success' => trans('تم الحفظ')
            ]);
        }
        return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
    }

    public function getTicketHistory($ticket_id = 0, $related = 0)
    {

        return DB::select("SELECT
    a.*,sender_tbl.nick_name sender_name,sender_tbl.image sender_image,receive_tbl.nick_name receive_name,receive_tbl.image receive_image
FROM
    (
    SELECT
        `id`,
        `ticket_id`,
        `related`,
        `sender_id`,
        `created_at`,
        `file_ids`,
        IFNULL(`s_note`, '') s_note,
        '' trans_note,
        `reciver_id`,
        `recive_type`,
        tagged_users
    FROM
        `app_trans`
    UNION
SELECT
    `trans_id`,
    `ticket_id`,
    `app_type`,
    `created_by`,
    `created_at`,
    `file_ids`,
    `s_text`,
    `trans_note`,
    `created_by`,
    0,'[]'tagged_users
FROM
    `app_responses`
) a join admins sender_tbl
on a.sender_id=sender_tbl.id
left join  admins receive_tbl
on a.reciver_id=receive_tbl.id
WHERE `ticket_id`=".$ticket_id."
and `related`=".$related."
order by created_at asc");

    }

    public function addSubscription($ticket_id = 0, $related = 0)
    {
        if ($related == 1) {
            $ticket = AppTicket1::find($ticket_id);
            if ($ticket->app_type == 2) {
                $type = "water_view";

                $subscription_TypeData = Constant::where('parent', 39)->where('status', 1)->get();

                $counter_TypeData = Constant::where('parent', 40)->where('status', 1)->get();

                $payTypeData = Constant::where('parent', 41)->where('status', 1)->get();

                $regions = Region::where('status', 1)->get();

                return view('dashboard.water.waterAdd',
                        compact('ticket', 'type', 'counter_TypeData', 'payTypeData', 'subscription_TypeData',
                                'regions'));
            } else {
                $type = "elec_view";

                $subscription_TypeData = Constant::where('parent', 6032)->where('status', 1)->get();

                $counter_TypeData = Constant::where('parent', 26)->where('status', 1)->get();

                $vasTypeData = Constant::where('parent', 29)->where('status', 1)->get();

                $payTypeData = Constant::where('parent', 32)->where('status', 1)->get();

                $converterNos = Constant::where('parent', 6208)->where('status', 1)->get();

                $regions = Region::where('status', 1)->get();

                return view('dashboard.elec.elecAdd',
                        compact('ticket', 'type', 'counter_TypeData', 'vasTypeData', 'payTypeData',
                                'subscription_TypeData', 'regions', 'converterNos'));
            }

        }
    }

    public function addLicense($ticket_id = 0, $related = 0)
    {
        $ticket = AppTicket18::find($ticket_id);
        if ($ticket != null) {
            $type = "license_view";
            $setting = Setting::first();
            $regions = Region::where('town_id', $setting->town_id)->get();
            // $useList = Constant::where('parent',6278)->where('status',1)->get();
            $use_desc = Constant::where('parent', 6214)->where('status', 1)->get();
            // $officeList = Constant::where('parent',6272)->where('status',1)->get();
            // $buildingTypes = Constant::where('parent',6016)->where('status',1)->get();
            return view('dashboard.license.licenseAdd',
                    compact('type', 'regions', 'use_desc', 'ticket'/*,'useList','officeList','buildingTypes'*/));
        }
    }

    public function getArchive($Id, $type)
    {
        if ($type == 'trade_archive') {
            $archive['info'] = TradeArchive::where('id', $Id)->first();
            $attach = json_decode($archive['info']->json_feild);
            $attachIds = json_decode($archive['info']->attach_ids) ?? array();
            $rawFiles = File::whereIn('id', $attachIds)->get();
            $count = sizeof($attachIds);
            $i = 0;
            foreach ($attach as $key => $value) {
                foreach ((array) $value as $key => $val) {
                    $temp = array();
                    if ($i < $count) {
                        $temp['id'] = $attachIds[$i];
                        $temp['file_links'] = $rawFiles[$i]->file_links;
                        $i++;
                    } else {
                        $temp['id'] = 0;
                        $temp['file_links'] = [];
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
            $files = array();
            foreach ($attach as $id) {
                $temp = (array) $id;
                $file = File::find($id->id);
                $file->real_name = array_search($file->url, $temp);
                $files[] = $file;
            }
            $archive['files'] = $files;
        } else if ($type == 'agenda_archieve') {
            $archive['info'] = AgendaTopic::find($Id);
            $archive['info']->url = "agenda_archieve";
            $archive['files'] = [];
            if (is_array(json_decode($archive['info']->file_ids))) {
                $files = File::whereIn('id', json_decode($archive['info']->file_ids))->get([
                        'id', 'real_name', 'url', 'file_links'
                ]);
            }
            if (isset($files) && $files != null) {
                foreach ($files as $file) {
                    $temp = array();
                    $temp['id'] = $file->id;
                    $temp['real_name'] = $file->real_name;
                    $temp['url'] = $file->url;
                    $temp['file_links'] = $file->file_links;
                }
                $archive['files'][] = $temp;
            }
        } else {
            $archive['info'] = Archive::find($Id);
            $archive['files'] = File::where('archive_id', '=', $Id)->where('model_name', 'App\Models\Archive')->get();
            $archive['CopyTo'] = CopyTo::where('archive_id', '=', $Id)->where('enabled', 1)->get();
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

    public function viewTicket($ticket_id = 0, $related = 0)
    {
        DB::update("update app_trans set is_seen=1 where reciver_id=".Auth()->user()->id." and related=".$related." and ticket_id=".$ticket_id);
        $ticket = array();
        $helpers = array();
        $config = array();
        $helpers['region'] =
        $helpers['department'] = Department::where('enabled', 1)->get();
        $helpers['appStatus'] = Constant::where('parent', 5001)->where('status', 1)->get();
        if ($related == 1) {
            $ticket = AppTicket1::find($ticket_id);
            if ($ticket->app_type) {
                $helpers['subsList'] = Constant::where('parent', 6032)->get();
                $helpers['converterNos'] = Constant::where('parent', 6208)->get();
            } else {
                $helpers['subsList'] = Constant::where('parent', 39)->get();
            }
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 2) {
            $ticket = AppTicket2::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            if ($ticket->subs) {
                $subsId = json_decode($ticket->subs);
            } else {
                $subsId = ["0"];
            }
            if ($ticket->app_type == 2) {
                // $subs=water::whereIn('id',$subsId)->get();
                $subs = water::where('waters.enabled', 1)->whereIn('waters.id', $subsId)->select('waters.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'waters.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'waters.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'waters.payType')
                        ->leftJoin('users', 'users.id', 'waters.user_id')
                        ->get();
            } else {
                $subs = elec::where('elecs.enabled', 1)->whereIn('elecs.id', $subsId)->select('elecs.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'elecs.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'elecs.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'elecs.payType')
                        ->leftJoin('users', 'users.id', 'elecs.user_id')
                        ->get();
            }
            $ticket->setAttribute('subscription', $subs);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 3) {
            $ticket = AppTicket3::find($ticket_id);
            if ($ticket->app_type == 1) {
                $helpers['subsList'] = Constant::where('parent', 6032)->where('status', 1)->get();
                $helpers['converterNos'] = Constant::where('parent', 6208)->where('status', 1)->get();
            }
            if ($ticket->app_type == 2) {
                $helpers['subsList'] = Constant::where('parent', 39)->where('status', 1)->get();
                $helpers['converterNos'] = Constant::where('parent', 6208)->where('status', 1)->get();
            }
            $license = license::where('id', $ticket->LicenceNo)->first();
            if ($license != null) {
                $ticket->setAttribute('licNo', $license->licNo);
            }
            if ($ticket->detail) {
                $detail = json_decode($ticket->detail);
                $ticket->setAttribute('detailData', $detail);
            }
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 4) {
            $ticket = AppTicket4::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 5) {
            $ticket = AppTicket5::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            if ($ticket->subs) {
                $subsId = json_decode($ticket->subs);
            } else {
                $subsId = ["0"];
            }
            if ($ticket->app_type == 2) {
                $subs = water::where('waters.enabled', 1)->whereIn('waters.id', $subsId)->select('waters.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'waters.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'waters.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'waters.payType')
                        ->leftJoin('users', 'users.id', 'waters.user_id')
                        ->get();
            } else {
                $subs = elec::where('elecs.enabled', 1)->whereIn('elecs.id', $subsId)->select('elecs.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'elecs.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'elecs.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'elecs.payType')
                        ->leftJoin('users', 'users.id', 'elecs.user_id')
                        ->get();
            }
            $ticket->setAttribute('subscription', $subs);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 6) {
            $ticket = AppTicket6::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            if ($ticket->subs) {
                $subsId = json_decode($ticket->subs);
            } else {
                $subsId = ["0"];
            }
            if ($ticket->app_type == 2) {
                $subs = water::where('waters.enabled', 1)->whereIn('waters.id', $subsId)->select('waters.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'waters.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'waters.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'waters.payType')
                        ->leftJoin('users', 'users.id', 'waters.user_id')
                        ->get();
            } else {
                $subs = elec::where('elecs.enabled', 1)->whereIn('elecs.id', $subsId)->select('elecs.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'elecs.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'elecs.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'elecs.payType')
                        ->leftJoin('users', 'users.id', 'elecs.user_id')
                        ->get();
            }
            $ticket->setAttribute('subscription', $subs);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 7) {
            $ticket = AppTicket7::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            if ($ticket->subs) {
                $subsId = json_decode($ticket->subs);
            } else {
                $subsId = ["0"];
            }
            if ($ticket->app_type == 2) {
                $subs = water::where('waters.enabled', 1)->whereIn('waters.id', $subsId)->select('waters.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'waters.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'waters.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'waters.payType')
                        ->leftJoin('users', 'users.id', 'waters.user_id')
                        ->get();
            } else {
                $subs = elec::where('elecs.enabled', 1)->whereIn('elecs.id', $subsId)->select('elecs.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'elecs.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'elecs.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'elecs.payType')
                        ->leftJoin('users', 'users.id', 'elecs.user_id')
                        ->get();
            }
            $ticket->setAttribute('subscription', $subs);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 8) {
            $ticket = AppTicket8::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            if ($ticket->subs) {
                $subsId = json_decode($ticket->subs);
            } else {
                $subsId = ["0"];
            }
            if ($ticket->app_type == 2) {
                $subs = water::where('waters.enabled', 1)->whereIn('waters.id', $subsId)->select('waters.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'waters.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'waters.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'waters.payType')
                        ->leftJoin('users', 'users.id', 'waters.user_id')
                        ->get();
            } else {
                $subs = elec::where('elecs.enabled', 1)->whereIn('elecs.id', $subsId)->select('elecs.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'elecs.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'elecs.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'elecs.payType')
                        ->leftJoin('users', 'users.id', 'elecs.user_id')
                        ->get();
            }
            $ticket->setAttribute('subscription', $subs);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 9) {
            $ticket = AppTicket9::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            if ($ticket->subs) {
                $subsId = ($ticket->subs);
            } else {
                $subsId = 0;
            }
            if ($ticket->app_type == 2) {
                $subs = water::where('waters.enabled', 1)->where('waters.id', $subsId)->select('waters.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'waters.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'waters.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'waters.payType')
                        ->leftJoin('users', 'users.id', 'waters.user_id')
                        ->get();
            } else {
                $subs = elec::where('elecs.enabled', 1)->where('elecs.id', $subsId)->select('elecs.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'elecs.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'elecs.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'elecs.payType')
                        ->leftJoin('users', 'users.id', 'elecs.user_id')
                        ->get();
            }
            $ticket->setAttribute('subscription', $subs);
            $lic = License::where('id', '=', $ticket->licNo)->first();
            $ticket->setAttribute('license', $lic);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 10) {
            $ticket = AppTicket10::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            if ($ticket->subs) {
                $subsId = ($ticket->subs);
            } else {
                $subsId = 0;
            }
            if ($ticket->app_type == 2) {
                $subs = water::where('waters.enabled', 1)->where('waters.id', $subsId)->select('waters.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'waters.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'waters.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'waters.payType')
                        ->leftJoin('users', 'users.id', 'waters.user_id')
                        ->get();
            } else {
                $subs = elec::where('elecs.enabled', 1)->where('elecs.id', $subsId)->select('elecs.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'elecs.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'elecs.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'elecs.payType')
                        ->leftJoin('users', 'users.id', 'elecs.user_id')
                        ->get();
            }
            $ticket->setAttribute('subscription', $subs);
            $lic = License::where('id', '=', $ticket->licNo)->first();
            $ticket->setAttribute('license', $lic);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 11) {
            $ticket = AppTicket11::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            if ($ticket->subs) {
                $subsId = ($ticket->subs);
            } else {
                $subsId = 0;
            }
            if ($ticket->app_type == 2) {
                $subs = water::where('waters.enabled', 1)->where('waters.id', $subsId)->select('waters.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'waters.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'waters.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'waters.payType')
                        ->leftJoin('users', 'users.id', 'waters.user_id')
                        ->get();
            } else {
                $subs = elec::where('elecs.enabled', 1)->where('elecs.id', $subsId)->select('elecs.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'elecs.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'elecs.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'elecs.payType')
                        ->leftJoin('users', 'users.id', 'elecs.user_id')
                        ->get();
            }

            if ($ticket->subs1) {
                $subsId1 = ($ticket->subs1);
            } else {
                $subsId1 = 0;
            }
            if ($ticket->app_type == 2) {
                $subs1 = water::where('waters.enabled', 1)->where('waters.id', $subsId1)->select('waters.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'waters.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'waters.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'waters.payType')
                        ->leftJoin('users', 'users.id', 'waters.user_id')
                        ->get();
            } else {
                $subs1 = elec::where('elecs.enabled', 1)->where('elecs.id', $subsId)->select('elecs.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'elecs.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'elecs.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'elecs.payType')
                        ->leftJoin('users', 'users.id', 'elecs.user_id')
                        ->get();
            }

            $ticket->setAttribute('subscription', $subs);
            $ticket->setAttribute('subscription1', $subs1);
            $lic = License::where('id', '=', $ticket->licNo)->first();
            $ticket->setAttribute('license', $lic);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 12) {
            $ticket = AppTicket12::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            $helpers['ticketTypeList'] = Constant::where('parent', 6011)->where('status', 1)->get();
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 13) {
            $ticket = AppTicket13::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            if ($ticket->subs) {
                $subsId = json_decode($ticket->subs);
            } else {
                $subsId = ["0"];
            }
            if ($ticket->app_type == 2) {
                // $subs=water::whereIn('id',$subsId)->get();
                $subs = water::where('waters.enabled', 1)->whereIn('waters.id', $subsId)->select('waters.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'waters.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'waters.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'waters.payType')
                        ->leftJoin('users', 'users.id', 'waters.user_id')
                        ->get();
            } else {
                $subs = elec::where('elecs.enabled', 1)->whereIn('elecs.id', $subsId)->select('elecs.*',
                        'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                        'd.name as payType_name')
                        ->leftJoin('t_constant as a', 'a.id', 'elecs.subscription_Type')
                        ->leftJoin('t_constant as b', 'b.id', 'elecs.counter_Type')
                        ->leftJoin('t_constant as d', 'd.id', 'elecs.payType')
                        ->leftJoin('users', 'users.id', 'elecs.user_id')
                        ->get();
            }
            $appTicket13_1 = AppTicket13::where('CurrVas', 42)->orderBy('id', 'desc')->first();
            if ($appTicket13_1 != null) {
                $ampereCost1Vas = $appTicket13_1->ampere_cost;
            } else {
                $ampereCost1Vas = 1;
            }

            $appTicket13_2 = AppTicket13::where('CurrVas', 43)->orderBy('id', 'desc')->first();
            if ($appTicket13_2 != null) {
                $ampereCost3Vas = $appTicket13_2->ampere_cost;
            } else {
                $ampereCost3Vas = 1;
            }

            $ticket->setAttribute('subscription', $subs);
            $ticket->setAttribute('ampereCost1Vas', $ampereCost1Vas);
            $ticket->setAttribute('ampereCost3Vas', $ampereCost3Vas);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 14) {
            $ticket = AppTicket14::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            $helpers['fixTypeList'] = Constant::where('parent', 6064)->where('status', 1)->get();
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 15) {
            $ticket = AppTicket15::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            if ($ticket->subs) {
                $subsId = json_decode($ticket->subs);
            } else {
                $subsId = ["0"];
            }
            $subs = elec::where('elecs.enabled', 1)->where('elecs.id', $subsId)->select('elecs.*',
                    'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                    'd.name as payType_name')
                    ->leftJoin('t_constant as a', 'a.id', 'elecs.subscription_Type')
                    ->leftJoin('t_constant as b', 'b.id', 'elecs.counter_Type')
                    ->leftJoin('t_constant as d', 'd.id', 'elecs.payType')
                    ->leftJoin('users', 'users.id', 'elecs.user_id')
                    ->get();

            $ticket->setAttribute('subscription', $subs);
            $lic = License::where('id', '=', $ticket->licNo)->first();
            $ticket->setAttribute('license', $lic);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 16) {
            $ticket = AppTicket16::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 17) {
            $ticket = AppTicket17::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            if ($ticket->subs) {
                $subsId = $ticket->subs;
            } else {
                $subsId = 0;
            }
            $subs = elec::where('elecs.enabled', 1)->where('elecs.id', $subsId)->select('elecs.*',
                    'users.name as user_name', 'a.name as subscription_Type_name', 'b.name as counter_Type_name',
                    'd.name as payType_name')
                    ->leftJoin('t_constant as a', 'a.id', 'elecs.subscription_Type')
                    ->leftJoin('t_constant as b', 'b.id', 'elecs.counter_Type')
                    ->leftJoin('t_constant as d', 'd.id', 'elecs.payType')
                    ->leftJoin('users', 'users.id', 'elecs.user_id')
                    ->get();

            $ticket->setAttribute('subscription', $subs);
            $lic = License::where('id', '=', $ticket->licNo)->first();
            $ticket->setAttribute('license', $lic);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 18) {
            $ticket = AppTicket18::find($ticket_id);
            $helpers['buildingStatusList'] = Constant::where('parent', 6014)->where('status', 1)->get();
            $helpers['buildingTypeList'] = Constant::where('parent', 6016)->where('status', 1)->get();
            $helpers['officeAreaList'] = Constant::where('parent', 6084)->where('status', 1)->get();

            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 19) {
            $ticket = AppTicket19::find($ticket_id);
            $helpers['buildingTypeList'] = Constant::where('parent', 6016)->where('status', 1)->get();
            $helpers['officeAreaList'] = Constant::where('parent', 6084)->where('status', 1)->get();

            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 20) {
            $ticket = AppTicket20::find($ticket_id);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 21) {
            $ticket = AppTicket21::find($ticket_id);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 22) {
            $ticket = AppTicket22::find($ticket_id);
            $helpers['buildingTypeList'] = Constant::where('parent', 6016)->where('status', 1)->get();
            $helpers['officeAreaList'] = Constant::where('parent', 6084)->where('status', 1)->get();

            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 23) {
            $ticket = AppTicket23::find($ticket_id);
            $helpers['ticket_name'] = Constant::select('name')->where('id', $ticket->task_type)->where('status',
                    1)->first();
            $helpers['ticketTypeList'] = Constant::where('parent', 6029)->where('status', 1)->get();
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 24) {
            $ticket = AppTicket24::find($ticket_id);
            $helpers['complaintTypes'] = Constant::where('parent', 6113)->where('status', 1)->get();
        }
        if ($related == 25) {
            $ticket = AppTicket25::find($ticket_id);
        }
        if ($related == 26) {
            $ticket = AppTicket26::find($ticket_id);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 27) {
            $ticket = AppTicket27::find($ticket_id);
            $helpers['resonTypeList'] = Constant::where('parent', 6033)->get();
            // $setting = Setting::first();             $helpers['region']=Region::where('town_id',$setting->town_id)->get();
        }
        if ($related == 28) {
            $ticket = AppTicket28::find($ticket_id);
            $helpers['vacTypes'] = Constant::where('parent', 6055)->get();
            // $setting = Setting::first();             $helpers['region']=Region::where('town_id',$setting->town_id)->get();
        }
        if ($related == 29) {
            $ticket = AppTicket29::find($ticket_id);
            //  $helpers['vacTypes']=Constant::where('parent',6055)->get();
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 30) {
            $ticket = AppTicket30::find($ticket_id);
            $helpers['networType'] = Constant::where('parent', 6058)->get();
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 31) {
            $ticket = AppTicket31::find($ticket_id);
            $helpers['orders'] = Order::where('ticket_id', $ticket_id)->where('related_ticket', $related)->get();
        }
        if ($related == 32) {
            $ticket = AppTicket32::find($ticket_id);
            $helpers['vacTypes'] = Constant::where('parent', 6060)->where('status', 1)->get();
            $helpers['allVac'] = $this->getVacForEmployee($ticket->customer_id);
        }
        if ($related == 33) {
            $ticket = AppTicket33::find($ticket_id);
            $helpers['orders'] = Order::where('ticket_id', $ticket_id)->where('related_ticket', $related)->get();
        }
        if ($related == 34) {
            $ticket = AppTicket34::find($ticket_id);
            $helpers['orders'] = Order::where('ticket_id', $ticket_id)->where('related_ticket', $related)->get();
            $helpers['fin_desc_list'] = Constant::where('parent', 6073)->where('status', 1)->get();
        }
        if ($related == 35) {
            $ticket = AppTicket35::find($ticket_id);
            $helpers['licenses'] = license::where('user_id', '=', $ticket->customer_id)->where('licenses.enabled',
                    1)->get();
            //  dd($helpers['licenses']);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 36) {
            $ticket = AppTicket36::find($ticket_id);
            $app_type = $ticket->app_type;
            $ticket->setAttribute('AppTrans',
                    AppTrans::where('ticket_type', $related)->where('ticket_id', $ticket_id)->get());
            $type = 'receive';
            $config = TicketConfig::where('ticket_no', $related)->where('app_type', $ticket->app_type)->first();
            // dd($config);
            $department = Department::where('enabled', 1)->get();
            return view('dashboard.ticketRecive.viewTicket36',
                    compact('type', 'app_type', 'ticket', 'related', 'config', 'department'));
        }
        if ($related == 37) {
            $ticket = AppTicket37::find($ticket_id);
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 38) {
            $ticket = AppTicket38::find($ticket_id);
            $helpers['oilmetrecies'] = Constant::where('parent', 6268)->where('status', 1)->get();
            $helpers['oilTypes'] = Constant::where('parent', 6109)->where('status', 1)->get();
        }
        if ($related == 39) {
            $ticket = AppTicket39::find($ticket_id);
            $helpers['officeAreaList'] = Constant::where('parent', 6272)->where('status', 1)->get();
            $helpers['workTypeList'] = Constant::where('parent', 6268)->where('status', 1)->get();
            $helpers['componyList'] = Constant::where('parent', 6269)->where('status', 1)->get();
            $helpers['buildingTypes'] = Constant::where('parent', 6016)->where('status', 1)->get();
            if ($ticket->date != null && $ticket->date != '') {
                $date = explode('-', ($ticket->date));

                $date = $date[2].'/'.$date[1].'/'.$date[0];
                $ticket->date = $date;
            } else {
                $ticket->date = '';
            }
            if ($ticket->is_lic_defined == 1) {
                $lic = License::where('id', '=', $ticket->licNo)->first();
                $ticket->setAttribute('license', $lic);
            }
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 40) {
            $ticket = AppTicket40::find($ticket_id);
            $helpers['useList'] = Constant::where('parent', 6278)->where('status', 1)->get();
            $helpers['officeAreaList'] = Constant::where('parent', 6084)->where('status', 1)->get();
            $helpers['officeEngList'] = Constant::where('parent', 6272)->where('status', 1)->get();
            $ticket->pieceArr = (($ticket->pieceNo == null || $ticket->pieceNo == '') ? array() : json_decode($ticket->pieceNo));
            if ($ticket->is_lic_defined == 1) {
                $lic = License::where('id', '=', $ticket->licNo)->first();
                $ticket->setAttribute('license', $lic);
            }
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 41) {
            $ticket = AppTicket41::find($ticket_id);
            $helpers['sparePartes'] = Order::where('ticket_id', $ticket->id)->where('related_ticket', $related)->get();
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 42) {
            $ticket = AppTicket42::find($ticket_id);
            $helpers['orders'] = Order::where('ticket_id', $ticket_id)->where('related_ticket', $related)->get();

            $helpers['fin_desc_list'] = Constant::where('parent', 6326)->where('status', 1)->get();
        }
        if ($related == 43) {
            $ticket = AppTicket43::find($ticket_id);
            $helpers['ticket_name'] = Constant::select('name')->where('id', $ticket->task_type)->where('status',
                    1)->first();
            $helpers['ticketTypeList'] = Constant::where('parent', 6405)->where('status', 1)->get();
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
        }
        if ($related == 44) {
            $ticket = AppTicket44::find($ticket_id);
            $admin = Admin::where('id', $ticket->customer_id)->first();
            $admin1 = Admin::where('id', $ticket->customer_id1)->first();
            $ticket->position = $admin->job_title_id;
            $ticket->position1 = $admin1->job_title_id;
            $helpers['positions'] = Constant::where('parent', 65)->where('status', 1)->get();
        }
        if ($related == 45) {
            $ticket = AppTicket45::find($ticket_id);
            $helpers['nurses'] = Constant::where('parent', 6395)->where('status', 1)->get();
            $helpers['transfer_froms'] = Constant::where('parent', 6396)->where('status', 1)->get();
            $helpers['transfer_to'] = Constant::where('parent', 6397)->where('status', 1)->get();
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
            if ($ticket->date) {
                $date = explode('-', ($ticket->date));
                $ticket->date = $date[2].'/'.$date[1].'/'.$date[0];
            } else {
                $ticket->date = date('d/m/Y');
            }
        }
        if ($related == 46) {
            $ticket = AppTicket46::find($ticket_id);
            $helpers['archive'] = $this->getArchive($ticket->archive_id, $ticket->archive_type);
        }
        //dd($ticket);
        if ($ticket == null) {
            return redirect()->route('admin.dashboard');
        }
        //dd($ticket);
        $config = TicketConfig::where('ticket_no', $related)->where('app_type', $ticket->app_type)->get();

        $allFlows = json_decode($config[0]->flow);
        if (sizeof($allFlows) > $ticket->flow_index) {
            $flows[] = $allFlows[$ticket->flow_index];
            $flowsDept[] = $allFlows[$ticket->flow_index]->nextDeptId;
            $flowsEmp[] = $allFlows[$ticket->flow_index]->nextDeptId;
            $flowsIsMandatory[] = $allFlows[$ticket->flow_index]->nextIsMandatory;
            if (($ticket->flow_index - 1) >= 0 && ($ticket->flow_index - 1) < sizeof($allFlows) && $allFlows[$ticket->flow_index]->nextIsMandatory != 1) {
                $flows[] = $allFlows[$ticket->flow_index - 1];
                $flowsDept[] = $allFlows[$ticket->flow_index - 1]->nextDeptId;
                $flowsEmp[] = $allFlows[$ticket->flow_index - 1]->nextEmpId;
                $flowsIsMandatory[] = $allFlows[$ticket->flow_index - 1]->nextIsMandatory;
            }
        } else {
            $flows = null;
            $flowsDept = null;
            $flowsEmp = null;
            $flowsIsMandatory = null;
        }

        // dd($ticket->app_type);
        $res = $this->getTicketHistory($ticket_id, $related);
        foreach ($res as $row) {
            $row->Files = $this->getAttach(json_decode($row->file_ids));
            $arr = json_decode($row->tagged_users);
            $row->taged = array();
            if (sizeof($arr) > 0) {
                $row->taged = Admin::whereIn('id', $arr)->get();
            }
        }
        $ticket->setAttribute('history', $res);
        $ticket->setAttribute('ticket_type', $related);

        if ($ticket->file_ids != null) {
            $ticket->setAttribute('Files', $this->getAttach(json_decode($ticket->file_ids)));
        } else {
            $ticket->setAttribute('Files', array());
        }
        $app_type = $ticket->app_type;
        $ticket->setAttribute('AppTrans',
                AppTrans::where('ticket_type', $related)->where('ticket_id', $ticket_id)->get());
        $type = 'receive';
        return view('dashboard.ticketRecive.index',
                compact('type', 'app_type', 'ticket', 'related', 'config', 'helpers', 'flows', 'flowsDept',
                        'flowsEmp'));
    }

    public function editTicket($ticket_id = 0, $related = 0)
    {
        $ticket = array();
        $helpers = array();
        $config = TicketConfig::where('ticket_no', $related)->get();
        if ($related == 1) {
            $ticket = AppTicket1::find($ticket_id);
            if ($ticket->app_type) {
                $helpers['subsList'] = Constant::where('parent', 6032)->get();
            } else {
                $helpers['subsList'] = Constant::where('parent', 39)->get();
            }
            $setting = Setting::first();
            $helpers['region'] = Region::where('town_id', $setting->town_id)->get();
            $ticket->setAttribute('Files', $this->getAttach(json_decode($ticket->file_ids)));
            $ticket->setAttribute('ticket_type', 1);
            $ticket->setAttribute('AppTrans', AppTrans::where('ticket_type', 1)->where('ticket_id', $ticket_id)->get());
        }

        $type = 'receive';
        return view('dashboard.ticketRecive.index', compact('type', 'ticket', 'related', 'config', 'helpers'));
    }

    public function deleteTicket(Request $request)
    {
        //dd($request);
        $related = $request->related;
        $ticket_id = $request->ticket_id;

        $res = 0;
        $res = DB::update('DELETE FROM app_ticket'.$related.'s WHERE id='.$ticket_id);
        $res = DB::update('DELETE FROM `app_trans` WHERE `ticket_id`='.$ticket_id.' and `related`='.$related);
        if ($res != 0) {
            return response()->json(['success' => 'تم الحذف بنجاح']);
        }

        return response()->json(['error' => 'error!!']);
    }

    public function saveTrans($id, $ticket_type, $AssignedToID, $note, $AssDeptID, $type, $related, Request $request)
    {
        $appTrans = new AppTrans();
        $appTrans->ticket_id = $id;
        $appTrans->ticket_type = $ticket_type;
        $appTrans->sender_id = Auth()->user()->id;
        $appTrans->reciver_id = $AssignedToID;
        $appTrans->s_note = $note;
        $appTrans->recive_type = $type;
        $appTrans->is_seen = 0;
        $appTrans->curr_dept = $AssDeptID;
        $appTrans->related = $related;
        $appTrans->created_by = Auth()->user()->id;
        $tag = $request->tags ? $request->tags : array();
        $appTrans->tagged_users = json_encode($tag);
        $appTrans->save();
        return $appTrans->id;
    }

    function saveCustomerFilesArchieve(Request $request, $taskname = '', $tasklink = '', $model = 'App\\Models\\User')
    {
        $files_ids = $request->attach_ids;
        $attachNameTemp = $request->attachName;
        $attachName = $request->attachName;
//        foreach ($attachNameTemp as $attach) {
//            if ($attach != null || $attach != '') {
//                array_push($attachName, $attach);
//            }
//        }
//        $request->attachName = $attachName;
        if ($files_ids) {
            $i = 0;
            foreach ($files_ids as $id) {
                if ($id != null) {
                    $archive = new Archive();
                    $archive->model_id = $request->subscriber_id;
                    $archive->type_id = '6046';
                    $archive->name = $request->subscriber_name;
                    $archive->model_name = $model;
                    $date = date("Y/m/d");
                    $from = explode('/', ($date));
                    $from = $from[0].'-'.$from[1].'-'.$from[2];
                    $archive->date = $from;
                    $archive->task_name = $taskname;
                    $archive->task_link = $tasklink;
                    $archive->title = $request->attachName[$i];
                    $archive->type = 'taskArchive';
                    $archive->serisal = '';
                    $archive->url = 'cit_archieve';
                    $archive->add_by = Auth()->user()->id;
                    //dd( $request->customername=='0',$request->customername,$archive);
                    $archive->save();
                    $file = File::find($id);
                    $file->archive_id = $archive->id;
                    $file->model_name = "App\Models\Archive";
                    $file->save();
                    $i++;
                }
            }

        }
    }

    function saveScannedFilesArchieve(Request $request, $taskname = '', $tasklink = '', $model = 'App\\Models\\User')
    {
        $files_ids = $request->attach_ids;
        foreach ($request->notArchived ?? [] as $notArchivedId) {
            if ($notArchivedId != null && $notArchivedId != "undefined") {
                $index = array_search($notArchivedId, $files_ids ?? []);
                $archive = new Archive();
                $archive->model_id = $request->subscriber_id;
                $archive->type_id = '6046';
                $archive->name = $request->subscriber_name;
                $archive->model_name = $model;
                $archive->date = date("Y-m-d");
                $archive->task_name = $taskname;
                $archive->task_link = $tasklink;
                $archive->title = $request->attachName[$index];
                $archive->type = 'taskArchive';
                $archive->serisal = '';
                $archive->url = 'cit_archieve';
                $archive->add_by = Auth()->user()->id;
                $archive->save();
                $file = File::find($notArchivedId);
                $file->archive_id = $archive->id;
                $file->model_name = "App\Models\Archive";
                $file->save();
            }
        }
    }

    function saveReplyScannedFilesArchieve(
            Request $request,
            $taskname = '',
            $tasklink = '',
            $model = 'App\\Models\\User'
    ) {
        $files_ids = $request->attach_ids;
        foreach ($request->notArchived1 ?? [] as $notArchivedId) {
            if ($notArchivedId != null && $notArchivedId != "undefined") {
                $index = array_search($notArchivedId, $files_ids ?? []);
                $archive = new Archive();
                $archive->model_id = $request->subscriberId1;
                $archive->type_id = '6046';
                $archive->name = $request->subscriberName1;
                $archive->model_name = $model;
                $archive->date = date("Y-m-d");
                $archive->task_name = $taskname;
                $archive->task_link = $tasklink;
                $archive->title = $request->attachName1[$index];
                $archive->type = 'taskArchive';
                $archive->serisal = '';
                $archive->url = 'cit_archieve';
                $archive->add_by = Auth()->user()->id;
                $archive->save();
                $file = File::find($notArchivedId);
                $file->archive_id = $archive->id;
                $file->model_name = "App\Models\Archive";
                $file->save();
            }
        }
    }

    public function saveTicket1(TicketRequest $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
//         dd($request->all());
        $app_id = $request->app_id;
        $ticket_type = 1;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 1)->where('app_type', $request->app_type)->first();

        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {

            $maxRec = AppTicket1::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket1();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            if ($request->phase != null) {
                $app->phase = $request->phase[0];
            }
            $app->inAmper = $request->inAmper;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->subscription_type = $request->subscriptionType;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->app_type = $request->app_type;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->ownership_type = $request->Ownership[0];
            $app->owner_id = $request->Ownership[0] == 1 ? 0 : $request->SubscriberID1;
            $app->owner_name = $request->Ownership[0] == 1 ? '' : $request->OwnerName;
            $app->LicenceNo = $request->LicenceNo;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();

            /*
    		$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }

                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(1, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket1::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            if ($request->phase != null) {
                $app->phase = $request->phase[0];
            }
            $app->inAmper = $request->inAmper;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->subscription_type = $request->subscriptionType;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->ownership_type = $request->Ownership[0];
            $app->owner_id = $request->Ownership[0] == 1 ? 0 : $request->SubscriberID1;
            $app->owner_name = $request->Ownership[0] == 1 ? '' : $request->OwnerName;
            $app->LicenceNo = $request->LicenceNo;
            $app->app_type = $request->app_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket2(TicketRequest2 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 2;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 2)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket2::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket2();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->subs = json_encode($request->SubscribtionIdList);
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*
    		$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }

                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                if ($request->portal_id == 0) {
                    $txt = "تم استلام "
                            .$config->ticket_name." ".$app->app_no
                            ." بإسم ".$request->subscriber_name;
                    $this->addSmsLog(2, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name,
                            $app->id,
                            $request->app_type);
                }
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket2::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket3(TicketRequest22 $request)
    {
        // dd($request->all());
        $app_id = $request->app_id;
        $ticket_type = 3;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 3)->where('app_type', $request->app_type)->first();

        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {

            $maxRec = AppTicket3::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $detail = new stdClass();
            $detail->appart = $request->appart;
            $detail->typeStore = $request->typeStore;
            $detail->office = $request->office;
            $detail->elev = $request->elev;
            $detail->stairs = $request->stairs;
            $detail->floor = $request->floor;
            $detail->notes1 = $request->notes1;
            $detail->notes2 = $request->notes2;
            $detail->notes3 = $request->notes3;
            // dd($detail);
            $app = new AppTicket3();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            if (isset($request->phase)) {
                $app->phase = $request->phase[0];
            }
            $app->inAmper = $request->inAmper;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->subscription_type = $request->subscriptionType;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->app_type = $request->app_type;
            $app->regionbuild = $request->regionbuild;
            $app->hodNo = $request->hodNo;
            $app->pieceNo = $request->pieceNo;
            $app->typebuild = $request->typebuild;
            $app->typestate = $request->typestate;
            $app->typebuilding = $request->typebuilding;
            $app->typebuildingother = $request->typebuildingother;
            $app->typebuildingnote = $request->typebuildingnote;
            // $app->typebuildingother		=$request->typebuildingother;
            $app->detail = json_encode($detail);
            $app->typeship = $request->typeship;
            $app->address = $request->address;
            $app->ownership_type = $request->Ownership[0];
            $app->owner_id = $request->Ownership[0] == 1 ? 0 : $request->SubscriberID1;
            $app->owner_name = $request->Ownership[0] == 1 ? '' : $request->OwnerName;
            $app->LicenceNo = $request->LicenceNo;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();

            /*
    		$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }

                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(3, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $detail = new stdClass();
            $detail->appart = $request->appart;
            $detail->typeStore = $request->typeStore;
            $detail->office = $request->office;
            $detail->elev = $request->elev;
            $detail->stairs = $request->stairs;
            $detail->floor = $request->floor;
            $detail->notes1 = $request->notes1;
            $detail->notes2 = $request->notes2;
            $detail->notes3 = $request->notes3;

            $app = AppTicket3::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            if (isset($request->phase)) {
                $app->phase = $request->phase[0];
            }
            $app->inAmper = $request->inAmper;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->subscription_type = $request->subscriptionType;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->address) ? $request->address : '';
            $app->regionbuild = $request->regionbuild;
            $app->hodNo = $request->hodNo;
            $app->pieceNo = $request->pieceNo;
            $app->typebuild = $request->typebuild;
            $app->typestate = $request->typestate;
            $app->typebuilding = $request->typebuilding;
            $app->typebuildingother = $request->typebuildingother;
            $app->typebuildingnote = $request->typebuildingnote;
            // $app->typebuildingother		=$request->typebuildingother;
            $app->detail = json_encode($detail);
            $app->typeship = $request->typeship;

            $app->ownership_type = $request->Ownership[0];
            $app->owner_id = $request->Ownership[0] == 1 ? 0 : $request->SubscriberID1;
            $app->owner_name = $request->Ownership[0] == 1 ? '' : $request->OwnerName;
            $app->LicenceNo = $request->LicenceNo;
            $app->app_type = $request->app_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app' => $app, 'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket4(TicketRequest2 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 4;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 4)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket4::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket4();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->app_type = $request->app_type;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->malDesc = $request->malDesc;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                if ($request->portal_id == 0) {
                    $txt = "تم استلام "
                            .$config->ticket_name." ".$app->app_no
                            ." بإسم ".$request->subscriber_name;
                    $this->addSmsLog(4, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name,
                            $app->id,
                            $request->app_type);
                }
                ///////////////////////////////////////////////////////////////////////////////////////////////////////////

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket4::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->app_type = $request->app_type;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket5(TicketRequest2 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 5;

        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 5)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket5::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket5();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->subs = json_encode($request->SubscribtionIdList);
            $app->app_type = $request->app_type;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }

                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(5, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket5::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket6(TicketRequest2 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 6;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 6)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket6::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket6();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->subs = json_encode($request->SubscribtionIdList);
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            if ($request->phase != null) {
                $app->phase = $request->phase[0];
            }
            $app->created_by = Auth()->user()->id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }

                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(6, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket6::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            if ($request->phase != null) {
                $app->phase = $request->phase[0];
            }
            $app->app_type = $request->app_type;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket7(TicketRequest2 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 7;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 7)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket7::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket7();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->subs = json_encode($request->SubscribtionIdList);
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            if ($request->phase != null) {
                $app->phase = $request->phase[0];
            }
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(7, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                ///////////////////////////////////////////////////////////////////////////////////////////////////////////

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket7::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            if ($request->phase != null) {
                $app->phase = $request->phase[0];
            }
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket8(TicketRequest19 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 8;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 8)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket8::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket8();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->subs = json_encode($request->SubscribtionIdList);

            $app->app_type = $request->app_type;

            $app->customer_id1 = $request->subscriber_id1;
            $app->customer_name1 = $request->subscriber_name1;
            $app->customer_mobile1 = $request->MobileNo1;
            $app->customer_id2 = $request->subscriber_id2;
            $app->customer_name2 = $request->subscriber_name2;
            $app->customer_mobile2 = $request->MobileNo2;
            $app->Applicanttype = $request->Applicanttype;
            $app->region1 = $request->AreaID1;
            $app->address1 = isset($request->Address1) ? $request->Address1 : '';

            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(8, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                ////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket8::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;

            $app->customer_id1 = $request->subscriber_id1;
            $app->customer_name1 = $request->subscriber_name1;
            $app->customer_mobile1 = $request->MobileNo1;
            $app->region1 = $request->AreaID1;
            $app->address1 = isset($request->Address1) ? $request->Address1 : '';
            $app->customer_id2 = $request->subscriber_id2;
            $app->customer_name2 = $request->subscriber_name2;
            $app->customer_mobile2 = $request->MobileNo2;
            $app->Applicanttype = $request->Applicanttype;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket9(TicketRequest5 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 9;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 9)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket9::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket9();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->subs = $request->counters;
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(9, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket9::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->subs = $request->counters;
            $app->app_type = $request->app_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket10(TicketRequest4 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 10;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 10)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket10::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket10();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->subs = $request->counters;

            $app->app_type = $request->app_type;

            $app->licNo = $request->licNo;
            $app->pos = $request->pos;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->region1 = $request->AreaID1;
            $app->address1 = isset($request->Address1) ? $request->Address1 : '';

            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            if ($request->phase != null) {
                $app->phase = $request->phase[0];
            }
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(10, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket10::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->subs = $request->counters;
            $app->app_type = $request->app_type;

            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->licNo = $request->licNo;
            $app->pos = $request->pos;

            $app->region1 = $request->AreaID1;
            $app->address1 = isset($request->Address1) ? $request->Address1 : '';
            if ($request->phase != null) {
                $app->phase = $request->phase[0];
            }
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket11(TicketRequest6 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 11;

        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 11)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket11::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket11();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->subs = $request->counters;
            $app->TransferAmount = $request->TransferAmount;
            $app->app_type = $request->app_type;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->subs1 = $request->counters1;
            $app->customer_id1 = $request->subscriber_id1;
            $app->customer_name1 = $request->subscriber_name1;
            $app->customer_mobile1 = $request->MobileNo1;

            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(11, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket11::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;

            $app->TransferAmount = $request->TransferAmount;
            $app->app_type = $request->app_type;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->subs1 = json_encode($request->SubscribtionIdList1);
            $app->customer_id1 = $request->subscriber_id1;
            $app->customer_name1 = $request->subscriber_name1;
            $app->customer_mobile1 = $request->MobileNo1;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket12(TicketRequest7 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 12;

        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 12)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket12::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket12();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->task_type = $request->task_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(12, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket12::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->task_type = $request->task_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket13(TicketRequest5 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 13;

        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 13)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket13::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket13();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->subs = json_encode($request->SubscribtionIdList);
            $app->app_type = $request->app_type;
            $app->CurrVas = $request->CurrVas;
            $app->CurrAmpere = $request->CurrAmpere;
            $app->NewAmpere = $request->NewAmpere;
            $app->ampere_cost = $request->ampereCost;
            $app->total_cost = $request->ampereTotalCost;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(13, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket13::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->CurrVas = $request->CurrVas;
            $app->CurrAmpere = $request->CurrAmpere;
            $app->NewAmpere = $request->NewAmpere;
            $app->NewAmpere = $request->NewAmpere;
            $app->ampere_cost = $request->ampereCost;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket14(TicketRequest7 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 14;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 14)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket14::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket14();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->task_type = $request->task_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(14, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket14::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->task_type = $request->task_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket15(Ticket15Request $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 15;

        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 15)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket15::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket15();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            if ($request->phase != null) {
                $app->phase = $request->phase[0];
            }
            $app->kwatt = $request->kwatt;
            $app->placement = $request->placement;
            $app->licNo = $request->licNo;
            $app->subs = json_encode($request->SubscribtionIdList);
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(15, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket15::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            if ($request->phase != null) {
                $app->phase = $request->phase[0];
            }
            $app->kwatt = $request->kwatt;
            $app->placement = $request->placement;
            $app->licNo = $request->licNo;
            $app->subs = json_encode($request->SubscribtionIdList);
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket16(TicketRequest5 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 16;

        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 16)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket16::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket16();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            if ($request->phase != null) {
                $app->phase = $request->phase[0];
            }
            $app->inAmper = $request->inAmper;
            $app->i_days = $request->i_days;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(16, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket16::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            if ($request->phase != null) {
                $app->phase = $request->phase[0];
            }
            $app->inAmper = $request->inAmper;
            $app->i_days = $request->i_days;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket17(TicketRequest5 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 17;

        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 17)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket17::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket17();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            if ($request->phase != null) {
                $app->phase = $request->phase[0];
            }
            $app->licNo = $request->licNo;
            $app->subs = $request->counters;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(17, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket17::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->licNo = $request->licNo;
            if ($request->phase != null) {
                $app->phase = $request->phase[0];
            }
            $app->subs = $request->counters;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket18(TicketRequest9 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 18;

        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 18)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket18::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket18();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->buildingStatus = $request->buildingStatus;
            $app->fileNo = $request->fileNo;
            $app->hodNo = $request->hodNo;
            $app->pieceNo = $request->pieceNo;
            $app->engOffice = $request->engOffice;
            $app->buildingType = $request->buildingType;
            $app->beforeMun = $request->beforeMun[0];

            $app->docs1 = json_encode($request->docs1);
            $app->attachReceive1 = json_encode($request->attachReceive1);
            $app->docs2 = json_encode($request->docs2);
            $app->attachReceive2 = json_encode($request->attachReceive2);
            $app->docs3 = json_encode($request->docs3);
            $app->attachReceive3 = json_encode($request->attachReceive3);

            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(18, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket18::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->buildingStatus = $request->buildingStatus;
            $app->fileNo = $request->fileNo;
            $app->hodNo = $request->hodNo;
            $app->pieceNo = $request->pieceNo;
            $app->engOffice = $request->engOffice;
            $app->buildingType = $request->buildingType;
            $app->beforeMun = $request->beforeMun[0];

            $app->docs1 = json_encode($request->docs1);
            $app->attachReceive1 = json_encode($request->attachReceive1);
            $app->docs2 = json_encode($request->docs2);
            $app->attachReceive2 = json_encode($request->attachReceive2);
            $app->docs3 = json_encode($request->docs3);
            $app->attachReceive3 = json_encode($request->attachReceive3);
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket19(TicketRequest9 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 19;

        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 19)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket19::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket19();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->fileNo = $request->fileNo;
            $app->hodNo = $request->hodNo;
            $app->pieceNo = $request->pieceNo;
            $app->engOffice = $request->engOffice;
            $app->buildingType = $request->buildingType;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->NameARList = json_encode($request->NameARList);
            $app->NationalIDList = json_encode($request->NationalIDList);
            $app->MobileNo1List = json_encode($request->MobileNo1List);
            $app->s_sideList = json_encode($request->s_sideList);
            $app->attatchName = json_encode($request->attatchName);
            $app->attachReceive = json_encode($request->attachReceive);

            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(19, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket19::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->fileNo = $request->fileNo;
            $app->hodNo = $request->hodNo;
            $app->pieceNo = $request->pieceNo;
            $app->engOffice = $request->engOffice;
            $app->buildingType = $request->buildingType;

            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->NameARList = json_encode($request->NameARList);
            $app->NationalIDList = json_encode($request->NationalIDList);
            $app->MobileNo1List = json_encode($request->MobileNo1List);
            $app->s_sideList = json_encode($request->s_sideList);

            $app->attatchName = json_encode($request->attatchName);
            $app->attachReceive = json_encode($request->attachReceive);

            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket20(TicketRequest8 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 20;

        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 20)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket20::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket20();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->hodNo = $request->hodNo;
            $app->pieceNo = $request->pieceNo;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(20, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket20::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->hodNo = $request->hodNo;
            $app->pieceNo = $request->pieceNo;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket21(TicketRequest $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 21;

        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 21)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket21::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket21();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->app_type = $request->app_type;
            $app->Applicanttype = $request->Applicanttype[0];

            $app->customer_id1 = $request->subscriber_id1;
            $app->customer_name1 = $request->subscriber_name1;
            $app->customer_mobile1 = $request->MobileNo1;

            $app->NameARList = json_encode($request->NameARList);
            $app->NationalIDList = json_encode($request->NationalIDList);
            $app->MobileNo1List = json_encode($request->MobileNo1List);
            $app->s_sideList = json_encode($request->s_sideList);
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->attatchName = json_encode($request->attatchName);
            $app->attachReceive = json_encode($request->attachReceive);

            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(21, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket21::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;

            $app->app_type = $request->app_type;
            $app->Applicanttype = $request->Applicanttype[0];
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->customer_id1 = $request->subscriber_id1;
            $app->customer_name1 = $request->subscriber_name1;
            $app->customer_mobile1 = $request->MobileNo1;

            $app->NameARList = json_encode($request->NameARList);
            $app->NationalIDList = json_encode($request->NationalIDList);
            $app->MobileNo1List = json_encode($request->MobileNo1List);
            $app->s_sideList = json_encode($request->s_sideList);

            $app->attatchName = json_encode($request->attatchName);
            $app->attachReceive = json_encode($request->attachReceive);
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket22(TicketRequest17 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 22;

        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 22)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket22::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket22();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->hodNo = $request->hodNo;
            $app->pieceNo = $request->pieceNo;
            $app->engOffice = $request->engOffice;
            $app->buildingType = $request->buildingType;
            $app->siteName = $request->siteName;
            $app->fileNo = $request->fileNo;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(22, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket22::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->hodNo = $request->hodNo;
            $app->pieceNo = $request->pieceNo;
            $app->engOffice = $request->engOffice;
            $app->buildingType = $request->buildingType;
            $app->siteName = $request->siteName;
            $app->fileNo = $request->fileNo;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket23(Ticket23Request $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 23;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 23)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket23::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket23();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->task_type = $request->task_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                if ($request->portal_id == 0) {
                    $txt = "تم استلام "
                            .$config->ticket_name." ".$app->app_no
                            ." بإسم ".$request->subscriber_name;
                    $this->addSmsLog(23, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name,
                            $app->id,
                            $request->app_type);
                }
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }

                $taskType = Constant::where('id', $app->task_type)->first();
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $taskType->name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket23::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->task_type = $request->task_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket24(TicketRequest20 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 24;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 24)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket24::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket24();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->complaint_type = $request->type;
            // $app->region		=$request->AreaID;
            // $app->address		=isset($request->Address)?$request->Address:'';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*
    		$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                 if ($request->portal_id == 0) {
                     $txt = "تم استلام "
                             .$config->ticket_name." ".$app->app_no
                             ." بإسم ".$request->subscriber_name;
                     $this->addSmsLog(24, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name,
                             $app->id,
                             $request->app_type);
                 }
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket24::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->complaint_type = $request->type;
            // $app->region		=$request->AreaID;
            // $app->address		=isset($request->Address)?$request->Address:'';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket25(TicketRequest11 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 25;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 25)->where('app_type', $request->app_type)->first();
        // if($config->force_attach==1 && sizeof($this->prepearAttach($request))<1){
        //     return response()->json(['error'=>'no_attatch']);
        // }
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if (!$app_id) {
            $maxRec = AppTicket25::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket25();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            // $app->region		=$request->AreaID;
            // $app->address		=isset($request->Address)?$request->Address:'';
            $app->malDesc = $request->malDesc;
            $app->customer_id1 = $request->subscriber_id1;
            $app->customer_name1 = $request->subscriber_name1;
            $app->customer_mobile1 = $request->MobileNo1;
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*
    		$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(25, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket25::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            // $app->region		=$request->AreaID;
            // $app->address		=isset($request->Address)?$request->Address:'';
            $app->malDesc = $request->malDesc;
            $app->customer_id1 = $request->subscriber_id1;
            $app->customer_name1 = $request->subscriber_name1;
            $app->customer_mobile1 = $request->MobileNo1;
            $app->app_type = $request->app_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket26(TicketRequest18 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 26;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 26)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket26::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket26();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->orginNo = $request->orginNo;
            $app->licNo = $request->licNo;

            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(26, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket26::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->orginNo = $request->orginNo;
            $app->licNo = $request->licNo;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket27(TicketRequest12 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 27;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 27)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket27::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket27();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->app_type = $request->app_type;
            $app->reason = $request->reason;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(27, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket27::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->app_type = $request->app_type;
            $app->reason = $request->reason;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket28(TicketRequest13 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 28;
        // $this->updateCMobile($request->subscriber_id,$request->MobileNo)  ;

        $config = TicketConfig::where('ticket_no', 28)->where('app_type', $request->app_type)->first();
        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket28::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket28();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->leave_type = $request->vac_type;
            $app->leave_date = $request->date;
            $app->start = $request->start;
            $app->end_dior = $request->endDior;
            $app->period = $request->totalPeriod;
            // $app->customer_mobile=$request->MobileNo;
            $app->app_type = $request->app_type;
            $app->malDesc = $request->malDesc;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                // $txt="تم استلام "
                // .$config->ticket_name." ".$app->app_no
                // ." بإسم ".$request->subscriber_name;
                // $this->addSmsLog(28,Auth()->user()->id,$txt,$request->MobileNo,$request->subscriber_name,$app->id,$request->app_type);
                // //////////////////////////////////////////////////////////////////////////////////////////////////////////
                // $model='App\\Models\\Admin';
                // $link='viewTicket/'.$app->id.'/'.$config->ticket_no;
                // $name=$config->ticket_name.'  ('.$app->app_no.')';
                // $this->saveCustomerFilesArchieve($request,$name,$link,$model);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket28::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            // $app->customer_mobile=$request->MobileNo;
            $app->leave_type = $request->vac_type;
            $app->leave_date = $request->date;
            $app->start = $request->start;
            $app->end_dior = $request->endDior;
            $app->period = $request->totalPeriod;
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->save();
            if ($app) {
                // if(($request->notArchived != null)){
                //     $link='viewTicket/'.$app->id.'/'.$config->ticket_no;
                //     $name=$config->ticket_name.'  ('.$app->app_no.')';
                //     $this->saveScannedFilesArchieve($request,$name,$link);
                // }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket29(TicketRequest14 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 29;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 29)->where('app_type', $request->app_type)->first();

        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket29::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket29();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->currency1 = $request->CurrencyID1;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;

            $app->money = $request->money;
            $app->money_text = $request->moneyText;
            $app->payfor = $request->payfor;

            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(29, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket29::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->currency1 = $request->CurrencyID1;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->money = $request->money;
            $app->money_text = $request->moneyText;
            $app->payfor = $request->payfor;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket30(TicketRequest15 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 30;

        $config = TicketConfig::where('ticket_no', 30)->where('app_type', $request->app_type)->first();

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket30::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket30();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;

            $app->network_type = $request->networkType;
            $app->malDesc = $request->malDesc;

            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket30::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->network_type = $request->networkType;
            $app->malDesc = $request->malDesc;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function savePurchase(Request $request, $id, $related)
    {
        $ItemNameList = $request->itemname;
        $inside_count = is_array($ItemNameList) ? sizeof($ItemNameList) : 0;
        $PriceList = ($request->price ?? array());
        $orderList = ($request->order_id ?? array());
        $QuantityList = ($request->quantity ?? array());
        $TypesList = ($request->types ?? array());
        $TotalList = ($request->total ?? array());
        Order::where('related_ticket', $related)->where('ticket_id', $id)->delete();
        for ($i = 0; $i < $inside_count; $i++) {
            if ($ItemNameList[$i] != null) {
                $order = new Order();
                $order->ticket_id = $id;
                $order->itemname = $ItemNameList[$i];
                $order->quantity = $QuantityList[$i];
                $order->types = $TypesList[$i];
                if (sizeof($PriceList) > $i) {
                    $order->price = $PriceList[$i];
                }
                if (sizeof($TotalList) > $i) {
                    $order->total = $TotalList[$i];
                }
                $order->related_ticket = $related;
                $order->save();

            }

        }
    }

    public function saveSparPart(Request $request)
    {
        // dd($request->all());
        $ItemNameList = $request->spare_itemname;
        $inside_count = is_array($ItemNameList) ? sizeof($ItemNameList) : 0;
        $PriceList = $request->spare_price;
        $orderList = $request->spare_order_id;
        $QuantityList = $request->spare_quantity;
        $TotalList = $request->spare_total;
        $orders = array();
        Order::where('related_ticket', $request->related)->where('ticket_id', $request->ticketID)->delete();
        for ($i = 0; $i < $inside_count; $i++) {
            $order = new Order();
            if ($ItemNameList[$i] != null) {
                $order->ticket_id = $request->ticketID;
                $order->itemname = $ItemNameList[$i];
                $order->quantity = $QuantityList[$i];
                $order->price = $PriceList[$i];
                $order->total = $TotalList[$i];
                $order->related_ticket = $request->related;
                $order->save();
                array_push($orders, $order);
            }
        }
        if (sizeof($orders) > 0) {
            return response()->json(['orders' => $orders, 'success' => trans('تم الحفظ')]);
        } else {
            return response()->json(['orders' => array(), 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket31(Request $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 31;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);

        $config = TicketConfig::where('ticket_no', 31)->where('app_type', $request->app_type)->first();

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket31::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket31();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_model = $request->subscriber_model;
            $app->customer_mobile = $request->MobileNo;
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->date_buy = $request->date_buy;
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                $this->savePurchase($request, $app->id, 31);
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(31, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $model = $app->customer_model;
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link, $model);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket31::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_model = $request->subscriber_model;
            $app->customer_mobile = $request->MobileNo;
            $app->app_type = $request->app_type;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->date_buy = $request->date_buy;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->save();
            if ($app) {
                $this->savePurchase($request, $app->id, 31);
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket32(TicketRequest16 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 32;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);

        $config = TicketConfig::where('ticket_no', 32)->where('app_type', $request->app_type)->first();
        if (!$app_id) {
            $maxRec = AppTicket32::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket32();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->vac_type = $request->vac_type;
            $app->start_date = $request->start_date;
            $app->end_date = $request->end_date;
            $app->vac_day = $request->vac_day;
            $app->vac_day_no = $request->vac_day_no;
            $app->malDesc = $request->malDesc;
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(32, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $model = 'App\\Models\\Admin';
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link, $model);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket32::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->app_type = $request->app_type;
            $app->vac_type = $request->vac_type;
            $app->vac_day_no = $request->vac_day_no;

            $app->start_date = $request->start_date;
            $app->end_date = $request->end_date;
            $app->vac_day = $request->vac_day;
            $app->malDesc = $request->malDesc;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $model = 'App\\Models\\Admin';
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket33(Request $request)
    {

        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 33;
        // $this->updateCMobile($request->subscriber_id,$request->MobileNo)  ;

        $config = TicketConfig::where('ticket_no', 33)->where('app_type', $request->app_type)->first();
        if (!$app_id) {
            $maxRec = AppTicket33::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket33();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            // $app->date_buy		=$request->date_buy;
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                $this->savePurchase($request, $app->id, 33);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket33::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->app_type = $request->app_type;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            // $app->date_buy		=$request->date_buy;

            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->save();
            if ($app) {
                $this->savePurchase($request, $app->id, 33);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket34(Request $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 34;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);

        $config = TicketConfig::where('ticket_no', 34)->where('app_type', $request->app_type)->first();
        if (!$app_id) {
            $maxRec = AppTicket34::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket34();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_model = $request->subscriber_model;
            $app->customer_mobile = $request->MobileNo;
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->AmountInNIS1 = $request->AmountInNIS1;
            $app->CurrencyID1 = $request->CurrencyID1;
            $app->fin_desc = $request->fin_desc;
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                $this->savePurchase($request, $app->id, 34);
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(34, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $model = $app->customer_model;
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link, $model);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket34::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_model = $request->subscriber_model;
            $app->customer_mobile = $request->MobileNo;
            $app->app_type = $request->app_type;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->AmountInNIS1 = $request->AmountInNIS1;
            $app->CurrencyID1 = $request->CurrencyID1;
            $app->fin_desc = $request->fin_desc;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->save();
            if ($app) {
                $this->savePurchase($request, $app->id, 34);
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket35(TicketRequest3 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 35;
        $this->updateCNationalID($request->subscriber_id, $request->national_id);
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);

        $config = TicketConfig::where('ticket_no', 35)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket35::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket35();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->subs = json_encode($request->SubscribtionIdList);

            $app->app_type = $request->app_type;

            $app->customer_id1 = $request->subscriber_id1;
            $app->customer_name1 = $request->subscriber_name1;
            $app->customer_mobile1 = $request->MobileNo1;
            $app->region1 = $request->AreaID1;
            $app->address1 = isset($request->Address1) ? $request->Address1 : '';

            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->licNo = $request->licNo;
            $app->pieceNo = $request->pieceNo;
            $app->hodNo = $request->hodNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(35, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket35::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;

            $app->customer_id1 = $request->subscriber_id1;
            $app->customer_name1 = $request->subscriber_name1;
            $app->customer_mobile1 = $request->MobileNo1;
            $app->region1 = $request->AreaID1;
            $app->address1 = isset($request->Address1) ? $request->Address1 : '';

            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket36(Request $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 36;

        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 36)->where('app_type', $request->app_type)->first();
        if ($config->required_nationalID == 1 && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket36::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket36();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            // $app->customer_mobile=$request->MobileNo;
            $app->national_id = $request->national_id;
            $app->app_type = $request->app_type;
            $app->input1 = $request->input1;
            $app->input2 = $request->input2;
            $app->input3 = $request->input3;
            $app->input4 = $request->input4;
            $app->input5 = $request->input5;
            $app->input6 = $request->input6;
            $app->input7 = $request->input7;
            $app->input8 = $request->input8;
            $app->input9 = $request->input9;
            $app->input10 = $request->input10;
            $app->input11 = $request->input11;
            $app->input12 = $request->input12;
            $app->input13 = $request->input13;
            $app->input14 = $request->input14;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            // $app->hrs		=$request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket36::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            // $app->customer_mobile=$request->MobileNo;
            $app->national_id = $request->national_id;
            $app->app_type = $request->app_type;
            $app->input1 = $request->input1;
            $app->input2 = $request->input2;
            $app->input3 = $request->input3;
            $app->input4 = $request->input4;
            $app->input5 = $request->input5;
            $app->input6 = $request->input6;
            $app->input7 = $request->input7;
            $app->input8 = $request->input8;
            $app->input9 = $request->input9;
            $app->input10 = $request->input10;
            $app->input11 = $request->input11;
            $app->input12 = $request->input12;
            $app->input13 = $request->input13;
            $app->input14 = $request->input14;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket37(TicketRequest21 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 37;

        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 37)->where('app_type', $request->app_type)->first();

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket37::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket37();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_name = $request->vehicle_name;
            $app->customer_id = $request->vehicle_id;
            $app->vehicle_no = $request->vehicle_no;
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket37::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_name = $request->vehicle_name;
            $app->customer_id = $request->vehicle_id;
            $app->vehicle_no = $request->vehicle_no;
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket38(TicketRequest21 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 38;

        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 38)->where('app_type', $request->app_type)->first();

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket38::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket38();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_name = $request->vehicle_name;
            $app->customer_id = $request->vehicle_id;
            $app->vehicle_no = $request->vehicle_no;
            $app->driver_name = $request->driver_name;
            $app->driver_id = $request->driver_id;
            $app->oil_type = $request->oilType;
            $app->oil_station = $request->oilStation;
            $app->oil_station_id = $request->oilStationID;
            $app->quantity = $request->quantity;
            $app->quantity_metric = $request->quantity_metric;
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket38::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_name = $request->vehicle_name;
            $app->customer_id = $request->vehicle_id;
            $app->vehicle_no = $request->vehicle_no;
            $app->driver_name = $request->driver_name;
            $app->driver_id = $request->driver_id;
            $app->oil_type = $request->oilType;
            $app->oil_station = $request->oilStation;
            $app->oil_station_id = $request->oilStationID;
            $app->quantity = $request->quantity;
            $app->quantity_metric = $request->quantity_metric;
            $app->app_type = $request->app_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket39(Ticket39Request $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 39;

        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 39)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if ($request->date != null && $request->date != '') {
            $date = explode('/', ($request->date));

            $date = $date[2].'-'.$date[1].'-'.$date[0];
            $request->date = $date;
        } else {
            $request->date = '';
        }

        if (!$app_id) {
            $maxRec = AppTicket39::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket39();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->workType = $request->workType;
            $app->licNo = $request->licNo;
            $app->is_lic_defined = $request->is_lic_defined;
            $app->licDecisionNo = $request->licDecisionNo;
            $app->hodNo = $request->hodNo;
            $app->pieceNo = $request->pieceNo;
            $app->engOffice = $request->engOffice;
            $app->buildingType = $request->buildingType;
            $app->day = $request->day;
            $app->date = $request->date;
            $app->time = $request->time;
            $app->duration = $request->duration;
            $app->implementedCompany = $request->implementedCompany;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            // $app->notes2		    =$request->note2;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(39, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket39::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->workType = $request->workType;
            $app->licNo = $request->licNo;
            $app->is_lic_defined = $request->is_lic_defined;
            $app->licDecisionNo = $request->licDecisionNo;
            $app->hodNo = $request->hodNo;
            $app->pieceNo = $request->pieceNo;
            $app->engOffice = $request->engOffice;
            $app->buildingType = $request->buildingType;
            $app->day = $request->day;
            $app->date = $request->date;
            $app->time = $request->time;
            $app->duration = $request->duration;
            $app->implementedCompany = $request->implementedCompany;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            // $app->notes2		    =$request->note2;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket40(Ticket40Request $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 40;

        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 40)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }
        $pieceArr = array();
        foreach ($request->pieceNo as $piece) {
            if ($piece != null && $piece != '') {
                array_push($pieceArr, $piece);
            }
        }
        if (!$app_id) {
            $maxRec = AppTicket40::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket40();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->buildingUse = $request->buildingUse;
            $app->licNo = $request->licNo;
            $app->is_lic_defined = $request->is_lic_defined;
            $app->systemUse = $request->systemUse;
            $app->hodNo = $request->hodNo;
            $app->engOffice = $request->engOffice;
            $app->areaOffice = $request->areaOffice;
            $app->pieceNo = json_encode($pieceArr);
            $app->attatchName = json_encode($request->attatchName);
            $app->attachReceive = json_encode($request->attachReceive);
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            // $app->notes2		    =$request->note2;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(40, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket40::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->app_type = $request->app_type;
            $app->buildingUse = $request->buildingUse;
            $app->licNo = $request->licNo;
            $app->is_lic_defined = $request->is_lic_defined;
            $app->systemUse = $request->systemUse;
            $app->hodNo = $request->hodNo;
            $app->engOffice = $request->engOffice;
            $app->areaOffice = $request->areaOffice;
            $app->pieceNo = json_encode($pieceArr);
            $app->attatchName = json_encode($request->attatchName);
            $app->attachReceive = json_encode($request->attachReceive);
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            // $app->notes2		    =$request->note2;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket41(TicketRequest $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        // dd($this->prepeardebt($request));
        $app_id = $request->app_id;
        $ticket_type = 41;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 41)->where('app_type', $request->app_type)->first();

        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {

            $maxRec = AppTicket41::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket41();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->ticketDate = $this->createDate($request->ticketDate);
            if ($request->phase != null) {
                $app->amount = $request->AmountInNIS;
            }
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->app_type = $request->app_type;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->ownership_type = $request->Ownership[0];
            $app->owner_id = $request->Ownership[0] == 1 ? 0 : $request->SubscriberID1;
            $app->owner_name = $request->Ownership[0] == 1 ? '' : $request->OwnerName;
            $app->LicenceNo = $request->LicenceNo;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->notes2 = $request->note2;
            $app->notes3 = $request->note3;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();

            /*
    		$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = 1;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }

                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->id
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(41, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket41::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->ticketDate = $this->createDate($request->ticketDate);
            if ($request->phase != null) {
                $app->amount = $request->AmountInNIS;
            }
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->ownership_type = $request->Ownership[0];
            $app->owner_id = $request->Ownership[0] == 1 ? 0 : $request->SubscriberID1;
            $app->owner_name = $request->Ownership[0] == 1 ? '' : $request->OwnerName;
            $app->LicenceNo = $request->LicenceNo;
            $app->app_type = $request->app_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->notes2 = $request->note2;
            $app->notes3 = $request->note3;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket42(Request $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 42;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);

        $config = TicketConfig::where('ticket_no', 42)->where('app_type', $request->app_type)->first();
        if (!$app_id) {
            $maxRec = AppTicket42::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket42();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_model = $request->subscriber_model;
            $app->customer_mobile = $request->MobileNo;
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->AmountInNIS1 = $request->AmountInNIS1;
            $app->CurrencyID1 = $request->CurrencyID1;
            $app->fin_desc = $request->fin_desc;
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                $this->savePurchase($request, $app->id, 42);
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->id
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(42, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                $model = $app->customer_model;
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link, $model);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket42::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_model = $request->subscriber_model;
            $app->customer_mobile = $request->MobileNo;
            $app->app_type = $request->app_type;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->AmountInNIS1 = $request->AmountInNIS1;
            $app->CurrencyID1 = $request->CurrencyID1;
            $app->fin_desc = $request->fin_desc;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->save();
            if ($app) {
                $this->savePurchase($request, $app->id, 42);
                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket43(TicketRequest7 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 43;
        $this->updateCMobile($request->subscriber_id, $request->MobileNo);
        $this->updateCNationalID($request->subscriber_id, $request->national_id);

        $config = TicketConfig::where('ticket_no', 43)->where('app_type', $request->app_type)->first();
        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if (!$app_id) {
            $maxRec = AppTicket43::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket43();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->task_type = $request->task_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($request, $app->id, $request->app_type, $request->AssignedToID,
                    $request->note, $request->AssDeptID, 1, $ticket_type);
            $app->save();
            /*
    		$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($request,$app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->id
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(43, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////

                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = 1;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }

                $taskType = Constant::where('id', $app->task_type)->first();
                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $taskType->name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket43::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->malDesc = $request->malDesc;
            $app->app_type = $request->app_type;
            $app->task_type = $request->task_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->debt_total = $request->debtTotal;
            $app->payment = $request->payment;
            $app->rest = $request->rest;
            $app->waslNo = $request->waslNo;
            $app->debt_json = json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket44(Ticket44Request $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 44;

        $config = TicketConfig::where('ticket_no', 44)->where('app_type', $request->app_type)->first();
        if (!$app_id) {
            // $maxRec=AppTicket44::select('app_no')->where('app_type',$request->app_type)->orderBy('id','desc')->limit(1)->get();
            // $max=1;

            // if(sizeof($maxRec)>0)
            //     $max=$maxRec[0]->app_no+1;
            $app = new AppTicket44();
            $app->app_no = $request->app_no;
            $app->year = $request->year;
            $app->topic = $request->topic;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_id1 = $request->subscriber_id1;
            $app->customer_name1 = $request->subscriber_name1;
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->malDesc = $request->malDesc;
            $app->hrs = $request->restHrs;
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            /*$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($request,$app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {
                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                // $txt="تم استلام "
                // .$config->ticket_name." ".$app->id
                // ." بإسم ".$request->subscriber_name;
                // $this->addSmsLog(44,Auth()->user()->id,$txt,$request->MobileNo,$request->subscriber_name,$app->id,$request->app_type);
                //////////////////////////////////////////////////////////////////////////////////////////////////////////
                // $model='App\\Models\\Admin';
                // $link='viewTicket/'.$app->id.'/'.$config->ticket_no;
                // $name=$config->ticket_name.'  ('.$app->app_no.')';
                // $this->saveCustomerFilesArchieve($request,$name,$link,$model);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket44::find($app_id);
            $app->app_no = $request->app_no;
            $app->year = $request->year;
            $app->topic = $request->topic;
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_id1 = $request->subscriber_id1;
            $app->customer_name1 = $request->subscriber_name1;
            $app->app_type = $request->app_type;
            $app->malDesc = $request->malDesc;
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->save();
            if ($app) {

                // if(($request->notArchived != null)){
                //     $link='viewTicket/'.$app->id.'/'.$config->ticket_no;
                //     $name=$config->ticket_name.'  ('.$app->app_no.')';
                //     $this->saveScannedFilesArchieve($request,$name,$link);
                // }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function addCustomer($request)
    {
        $user = new User();
        $user->name = $request->subscriber_name;
        $user->national_id = $request->national_id;
        $user->phone_one = $request->MobileNo;
        $user->save();
        return $user->id;
    }

    public function saveTicket45(TicketRequest45 $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        // dd($this->prepeardebt($request));
        $app_id = $request->app_id;
        $ticket_type = 45;
        if ($request->subscriber_id == 0 || $request->subscriber_id == null) {
            $request->subscriber_id = $this->addCustomer($request);
        } else {
            $this->updateCMobile($request->subscriber_id, $request->MobileNo);
            $this->updateCNationalID($request->subscriber_id, $request->national_id);
        }

        $config = TicketConfig::where('ticket_no', 45)->where('app_type', $request->app_type)->first();

        if (($config->required_nationalID == 1 && $config->show_nationalID == 1) && (empty($request->national_id) || !is_numeric($request->national_id))) {
            return response()->json(['error' => 'no_nationalID']);
        }

        if ($config->force_attach == 1 && sizeof($this->prepearAttach($request)) < 1) {
            return response()->json(['error' => 'no_attatch']);
        }

        if ($request->date) {
            $date = explode('/', ($request->date));
            $date = $date[2].'-'.$date[1].'-'.$date[0];
        } else {
            $date = "0000-00-00";
        }

        if (!$app_id) {

            $maxRec = AppTicket45::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket45();
            $app->app_no = $max;
            $app->receipt_no = $request->ReciptNo;
            if ($request->phase != null) {
                $app->amount = $request->AmountInNIS;
            }
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->day_name = $request->day;
            $app->date = $date;
            $app->app_type = $request->app_type;
            $app->emp_id = $request->emp_id;
            $app->emp_name = $request->emp_name;
            $app->nurse_id = $request->nurse;
            $app->transfer_from = $request->transfer_from;
            $app->transfer_to = $request->transfer_to;
            $app->time = $request->time;
            $app->arrival_time = $request->arrival_time;
            $app->Departure_time = $request->Departure_time;
            $app->status_type = $request->status_type;
            $app->financial_no = $request->financial_no;
            $app->required_amount = $request->required_amount;
            $app->paid_amount = $request->paid_amount;
            $app->voucher_no = $request->voucher_no;
            $app->voucher_date = $request->voucher_date;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            // $app->debt_total		=$request->debtTotal;
            // $app->payment		=$request->payment;
            // $app->rest		=$request->rest;
            // $app->waslNo		=$request->waslNo;
            // $app->debt_json	=json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();

            /*
    		$tag=$request->tags?$request->tags:array();
    		foreach($tag as $row)
    			$this->saveTrans($app->id,$ticket_type,$row,$request->note,$request->AssDeptID,2);*/
            if ($app) {

                if ($request->portal_id != 0) {
                    $portal = PortalTicket::where('id', $request->portal_id)->first();
                    $portal->is_seen = $portal->rec_id;
                    $portal->app_id = $app->id;
                    $portal->forwerd_by = Auth()->user()->id;
                    $portal->save();
                }

                ///////////////////////////////////////////////////////for Production///////////////////////////////////////
                $txt = "تم استلام "
                        .$config->ticket_name." ".$app->app_no
                        ." بإسم ".$request->subscriber_name;
                $this->addSmsLog(45, Auth()->user()->id, $txt, $request->MobileNo, $request->subscriber_name, $app->id,
                        $request->app_type);
                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                $name = $config->ticket_name.'  ('.$app->app_no.')';
                $this->saveCustomerFilesArchieve($request, $name, $link);

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket45::find($app_id);
            $app->receipt_no = $request->ReciptNo;
            $app->amount = $request->AmountInNIS;
            $app->currency = $request->CurrencyID;
            $app->customer_id = $request->subscriber_id;
            $app->customer_name = $request->subscriber_name;
            $app->customer_mobile = $request->MobileNo;
            $app->national_id = $request->national_id;
            $app->region = $request->AreaID;
            $app->address = isset($request->Address) ? $request->Address : '';
            $app->day_name = $request->day;
            $app->date = $date;
            $app->app_type = $request->app_type;
            $app->emp_id = $request->emp_id;
            $app->emp_name = $request->emp_name;
            $app->nurse_id = $request->nurse;
            $app->transfer_from = $request->transfer_from;
            $app->transfer_to = $request->transfer_to;
            $app->time = $request->time;
            $app->arrival_time = $request->arrival_time;
            $app->Departure_time = $request->Departure_time;
            $app->status_type = $request->status_type;
            $app->financial_no = $request->financial_no;
            $app->required_amount = $request->required_amount;
            $app->paid_amount = $request->paid_amount;
            $app->voucher_no = $request->voucher_no;
            $app->voucher_date = $request->voucher_date;
            $app->app_type = $request->app_type;
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            // $app->debt_total		=$request->debtTotal;
            // $app->payment		=$request->payment;
            // $app->rest		=$request->rest;
            // $app->waslNo		=$request->waslNo;
            // $app->debt_json	=json_encode($this->prepeardebt($request));
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->save();
            if ($app) {

                if (($request->notArchived != null)) {
                    $link = 'viewTicket/'.$app->id.'/'.$config->ticket_no;
                    $name = $config->ticket_name.'  ('.$app->app_no.')';
                    $this->saveScannedFilesArchieve($request, $name, $link);
                }

                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function saveTicket46(Request $request)
    {
        if (($request->AssignedToID == null || $request->AssDeptID == null) && $request->app_id == null) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
        $app_id = $request->app_id;
        $ticket_type = 46;
        $config = TicketConfig::where('ticket_no', 46)->where('app_type', $request->app_type)->first();
        if (!$app_id) {
            $maxRec = AppTicket46::select('app_no')->where('app_type', $request->app_type)->orderBy('id',
                    'desc')->limit(1)->get();
            $max = 1;

            if (sizeof($maxRec) > 0) {
                $max = $maxRec[0]->app_no + 1;
            }
            $app = new AppTicket46();
            $app->app_no = $max;
            $app->archive_id = $request->ArchiveID;
            $app->archive_type = $request->archive_type;
            $app->archive_title = $request->msgTitle;
            $app->customer_id = $request->customer_id;
            $app->customer_model = $request->customer_model;
            $app->customer_name = $request->customerName;
            $app->app_type = $request->app_type;
            $app->b_enabled = 1;
            $app->created_by = Auth()->user()->id;
            $app->dept_id = $request->dept_id;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->hrs = $request->restHrs;
            $app->priority = 0;//$request->;
            $app->ticket_status = 1;
            $app->active_trans = 1;
            $app->save();
//            $app->active_trans=$this->saveTrans($app->id,$request->app_type,$request->AssignedToID,$request->note,$request->AssDeptID,1,$ticket_type,$request);
            $app->active_trans = $this->saveTrans($app->id, $request->app_type, $request->AssignedToID, $request->note,
                    $request->AssDeptID, 1, $ticket_type, $request);
            $app->save();
            if ($app) {
                $archive = null;
                if ($request->archive_type != 'agenda_archieve' && $request->archive_type != 'trade_archive') {
                    $archive = Archive::find(intval($request->ArchiveID));
                } else if ($request->archive_type == 'agenda_archieve') {
                    $archive = AgendaTopic::find($request->ArchiveID);
                } else if ($request->archive_type == 'trade_archive') {
                    $archive = TradeArchive::find($request->ArchiveID);
                }
                if ($archive) {
                    $archive->trackLink = "/viewTicket/".$app->id."/46";
                    $admin = Admin::find($request->AssignedToID);
                    $dept = Department::find($request->AssDeptID);
                    $archive->emp_receive = $admin->nick_name;
                    $archive->dept_receive = $dept->name;
                    $archive->save();
                }
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket46::find($app_id);
            $app->archive_id = $request->ArchiveID;
            $app->archive_type = $request->archive_type;
            $app->archive_title = $request->msgTitle;
            $app->customer_id = $request->customer_id;
            $app->customer_model = $request->customer_model;
            $app->customer_name = $request->customerName;
            $app->app_type = $request->app_type;
            $app->fees_json = json_encode($this->prepearFees($request));
            $app->file_ids = json_encode($this->prepearAttach($request));
            $app->updated_at = date('Y-m-d H:i:s');
            $app->dept_id = $request->dept_id;
            $app->save();
            if ($app) {
                return response()->json([
                        'app_id' => $app->id, 'app_type' => $ticket_type, 'success' => trans('تم الحفظ')
                ]);
            }
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        }
    }

    public function updateVac(Request $request)
    {
        $ticket_id = $request->ticket_id;//related is sent
        if (!$ticket_id || $ticket_id == 0) {
            return response()->json(['app_id' => 0, 'app_type' => 0, 'error' => 'حدث خطأ']);
        } else {
            $app = AppTicket32::find($ticket_id);
            $app->accepted = 1;
            $app->save();
            if ($app) {
                return response()->json(['app_id' => $app->id, 'success' => trans('تم الحفظ')]);
            }
        }
    }

    public function getVacForEmployee($id)
    {
        $emp_id = intval($id);
        $emp = Admin::where('id', '=', $emp_id)->first();
        if ($emp) {
            $infoVac['year'] = $emp->year;
            $infoVac['balance'] = $emp->balance;
            $infoVac['emergency'] = $emp->emergency;
            $vac_balance = 6061;
            $vac_emergency = 6063;
            $allBalance_arr = AppTicket32::where('customer_id', '=', $emp_id)->where('accepted', '=',
                    1)->where('vac_type', '=', $vac_balance)->get();
            $sum = 0;
            for ($i = 0; $i < count($allBalance_arr); $i++) {
                $sum += $allBalance_arr[$i]->vac_day_no;
            }
            $allBalance = $sum;
            $allEmergency_arr = AppTicket32::where('customer_id', '=', $emp_id)->where('accepted', '=',
                    1)->where('vac_type', '=', $vac_emergency)->get();
            $sum1 = 0;
            for ($i = 0; $i < count($allEmergency_arr); $i++) {
                $sum1 += $allEmergency_arr[$i]->vac_day_no;
            }
            $allEmergency = $sum1;
            $infoVac['restB'] = $infoVac['balance'] - $allBalance;
            $infoVac['restE'] = $infoVac['emergency'] - $allEmergency;
            $infoVac['balance_done'] = $allBalance;
            $infoVac['emergency_done'] = $allEmergency;
            return response()->json(['infoVac' => $infoVac, 'success' => 'getData']);
        } else {
            return response()->json(['error' => 'حدث خطأ']);
        }
    }

}
