<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    //
    public function deleted_by(){

        return $this->belongsTo(Admin::class,'deleted_by');

    }
    
    public function addBy(){

        return $this->belongsTo(Admin::class,'add_by');

    }
    
    public function type(){

        return $this->belongsTo(Constant::class,'warning_type');

    }
}
