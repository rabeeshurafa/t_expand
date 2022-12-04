<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class AppTrans extends Model
{
    use Compoships;

    public function Admin()
    {
        return $this->belongsTo(Admin::class, 'reciver_id')->select(['nick_name', 'id']);
    }

    public function ticket()
    {
        $ticketNo = $this->related;
        $ticketId = $this->ticket_id;
        $model = 'App\Models\AppTicket'.$ticketNo;
        return $model::where('id', $ticketId)->with(['ticketStatus','ticketConfig'])->first();
    }

    public function ticketConfig()
    {
        return $this->belongsTo(TicketConfig::class, ['ticket_type', 'related'],
                ['app_type', 'ticket_no'])->select(['ticket_name', 'app_type', 'ticket_no']);
    }
}
