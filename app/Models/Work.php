<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function day(){
        return $this->belongsTo(DailyWork::class,'day_work_id');
    }
    public function stateName(){
        return $this->belongsTo(Constant::class,'state');
    }
}
