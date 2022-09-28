<?php
namespace App\Models;
use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;
class MeterRead extends Model
{
    public function Admin(){
        return $this->belongsTo(Admin::class,'added_by');
    }
    
    public function subscriper(){
        return $this->belongsTo(User::class,'user_id');
    }
    
    public function w_subscription(){
        return $this->belongsTo(water::class,'subs_id');
    }
    
    public function last_read(){
        return $this->belongsTo(MeterRead::class,'prev_id');
    }
}

