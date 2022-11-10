<?php



namespace App\Models;



use App\Casts\Json;

use Illuminate\Database\Eloquent\Model;



class TaboArchive extends Model

{

    public function archiveFiles(){

        return $this->hasMany(File::class,'archive_id');

    }

    public function Admin(){

        return $this->belongsTo(Admin::class,'added_by');

    }

    public function deleted_by(){

        return $this->belongsTo(Admin::class,'deleted_by');

    }

    public function files() {

        return $this->archiveFiles()->where('model_name','App\Models\TaboArchive');

    }

    public function hod(){
        return $this->belongsTo(TaboExcel::class,'hodId');
    }

    public function archiveType(){

        return $this->belongsTo(Constant::class,'archive_type');

    }

}

