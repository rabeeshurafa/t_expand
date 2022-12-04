<?php
namespace App\Models;

use App\Casts\Json;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class AppResponse extends Model
{
    use Compoships;

    public function Admin()
    {
        return $this->belongsTo(Admin::class, 'created_by')->select(['nick_name', 'id']);
    }

    public function ticket()
    {
        $ticketNo = $this->app_type;
        $ticketId = $this->ticket_id;
        $model = 'App\Models\AppTicket'.$ticketNo;
        return $model::where('id', $ticketId)->with(['ticketStatus','ticketConfig'])->first();
    }

//    public function ticketConfig()
//    {
//        return $this->belongsTo(TicketConfig::class, ['ticket_type', 'app_type'],
//                ['app_type', 'ticket_no'])->select(['ticket_name', 'app_type', 'ticket_no']);
//    }
}

