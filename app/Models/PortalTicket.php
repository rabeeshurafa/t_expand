<?php
namespace App\Models;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;
class PortalTicket extends Model
{
    use Compoships;
    public function config()
    {
        return $this->belongsTo(TicketConfig::class, ['app_no', 'app_type'],
                ['ticket_no', 'app_type'])->select(['ticket_name', 'ticket_no', 'app_type']);
    }

    public function taskType()
    {
        return $this->belongsTo(Constant::class, 'task_type')->select(['name', 'id']);
    }
}

