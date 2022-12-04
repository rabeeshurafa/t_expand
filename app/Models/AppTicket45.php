<?php
namespace App\Models;
use App\Casts\Json;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
class AppTicket45 extends Model
{
    use Compoships;

    public function Admin(){

        return $this->belongsTo(Admin::class,'created_by');

    }
    
    public function ticketStatus(){

        return $this->belongsTo(Constant::class,'ticket_status');

    }
    
    public function activeTrans(){

        return $this->belongsTo(AppTrans::class,'active_trans');

    }

    public function ticketConfig()
    {
        return $this->belongsTo(TicketConfig::class, ['app_type'],
                ['app_type'])->select(['ticket_name', 'app_type', 'ticket_no'])->where('ticket_no', 45);
    }
}

