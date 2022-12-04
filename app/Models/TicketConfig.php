<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class TicketConfig extends Model
{
    use Compoships;
    //
    public function debtSettings(): Attribute
    {
        return new Attribute(
                get: fn($value) => json_decode($value),
                set: fn($value) => json_encode($value),
        );
    }
    public function Admin(){
        return $this->belongsTo(Admin::class,'emp_to_receive');
    }
}
