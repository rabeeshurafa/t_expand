<?php



namespace App\Models;



use App\Casts\Json;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;



class TradeArchive extends Model

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

    public function Vehicle(){

        return $this->belongsTo(Vehicle::class,'vehicle_id');

    }
    public function connectTo(): Attribute
    {
        return new Attribute(
                get: fn($value) => json_decode($value),
                set: fn($value) => json_encode($value),
        );
    }

}

