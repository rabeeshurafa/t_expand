<?php
namespace App\Models;
use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;
class TaboData extends Model
{
    public function Admin(){

        return $this->belongsTo(Admin::class,'created_by');

    }
    public function hod(){
        return $this->belongsTo(TaboExcel::class,'excel_id');
    }
    
}

