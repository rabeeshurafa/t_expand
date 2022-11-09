<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class DailyWork extends Model{
    public function work(){
        return $this->hasMany(Work::class,'day_work_id');
    }
    public function files(): Attribute
    {
        return new Attribute(
            get: fn($value) => json_decode($value),
            set: fn($value) => json_encode($value),
        );
    }
}
