<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use SoftDeletes;

    public function deleted_by(){
        return $this->belongsTo(Admin::class,'deleted_by');
    }
}