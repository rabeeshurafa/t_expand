<?php



namespace App\Models;



use App\Casts\Json;

use Illuminate\Database\Eloquent\Model;



class Trade_Archive extends Model

{

    public function Admin(){

        return $this->belongsTo(Admin::class,'add_by');

    }

    public function deleted_by(){

        return $this->belongsTo(Admin::class,'deleted_by');

    }

    
    public function Type(){

        return $this->belongsTo(Constant::class,'trade_type');

    }
    




}

