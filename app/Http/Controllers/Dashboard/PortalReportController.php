<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PortalTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class PortalReportController extends Controller
{
    public function index()
    {
        $type = 'portalReport';
        return view('dashboard.portalReport.index', compact('type'));
    }

    public function getReport(Request $request)
    {
        $portals = PortalTicket::select('portal_tickets.*', 'admins.nick_name as admin_name')
                ->leftJoin('admins', 'admins.id', 'portal_tickets.forwerd_by')->with(['config','taskType'])->orderBy('id','DESC');
        if (trim(strlen($request->from)) > 0 && trim(strlen($request->to)) > 0) {
            $from = explode('/', ($request->from));
            $from = $from[2].'-'.$from[1].'-'.$from[0];
            $to = explode('/', ($request->to));
            $to = $to[2].'-'.$to[1].'-'.$to[0];

            $from1 = new Carbon($from);
            $to1 = new Carbon($to);
            $from1->subDay();
            $to1->addDay();
            $portals = $portals->whereBetween('portal_tickets.created_at', [$from1, $to1]);
        }
        if($request->customerid!=0){
            $portals = $portals->where('portal_tickets.customer_id', intval($request->customerid));
        }
        if($request->taskState==1){
            $portals = $portals->where('portal_tickets.forwerd_by','!=',0);
        }
        if($request->taskState==2){
            $portals = $portals->where('portal_tickets.forwerd_by',0);
        }
        return DataTables::of($portals)->addIndexColumn()->make(true);
    }
}