<?php

namespace App\Models\Email;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    public function User()
    {
        return $this->belongsTo(Admin::class, 'created_by')->select('id', 'nick_name', 'name', 'email');
    }
    public function setDataEmailAttribute($value)
    {
        if ($value) {
            $after = json_encode($value);
        } else {
            $after = null;
        }
        $this->attributes['data_email'] = $after;
    }
    public function getDataEmailAttribute($value)
    {
        if ($value) {
            $copyToNames = [];
            $data =  json_decode($value);
            foreach ($data->cc as $copyTo) {
                array_push($copyToNames, $copyTo);
            }
            $data->copyToNames = implode(', ', $copyToNames);
            return $data;
        } else {
            return (null);
        }
    }
}
