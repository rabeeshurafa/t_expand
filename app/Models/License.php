<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    public function Region()
    {
        return $this->belongsTo(Constant::class,'region');
    }
    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function systemUse()
    {
        return $this->belongsTo(Constant::class,'systemUse');
    }
    public function use_desc()
    {
        return $this->belongsTo(Constant::class,'use_desc');
    }
    public function engOffice()
    {
        return $this->belongsTo(Constant::class,'engOffice');
    }
}
