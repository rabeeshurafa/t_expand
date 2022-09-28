<?php
namespace App\Models;
use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;
class AppTicket46 extends Model
{
    public function Admin(){

        return $this->belongsTo(Admin::class,'created_by');

    }
    
    public function ticketStatus(){

        return $this->belongsTo(Constant::class,'ticket_status');

    }
    
    public function activeTrans(){

        return $this->belongsTo(AppTrans::class,'active_trans');

    }
    // public function ticketConfig(){

    //     return $this->belongsTo(TicketConfig::class, ['ticket_no', 'app_type'], ['app_type', '1']);

    // }
}

