<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Earh_lic extends Model
{
    //
    public function Admin(){

        return $this->belongsTo(Admin::class,'added_by');

    }

    public function deleted_by(){

        return $this->belongsTo(Admin::class,'deleted_by');

    }
}
