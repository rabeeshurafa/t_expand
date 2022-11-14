<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchiveRole extends Model
{
    //
    protected $table = 'archiverole';

    public function Admin(){

        return $this->belongsTo(Admin::class,'add_by');

    }

}
