<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Trade_Archive extends Model

{
    use LogsActivity;
    public function Admin()
    {

        return $this->belongsTo(Admin::class, 'add_by');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('archive')->logOnly(['*'])->dontLogIfAttributesChangedOnly(['updated_at', 'enabled', 'deleted_by']);
    }
    public function deleted_by()
    {

        return $this->belongsTo(Admin::class, 'deleted_by');
    }


    public function Type()
    {

        return $this->belongsTo(Constant::class, 'trade_type');
    }
}
