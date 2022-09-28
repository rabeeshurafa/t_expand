<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password','mobile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function deleted_by(){

        return $this->belongsTo(Admin::class,'deleted_by');

    }
    
    
    public function jobLicArchieve() {

        return $this->hasMany(jobLicArchieve::class,'model_id');    

    }
    
    public function jobLic() {

        return $this->hasMany(jobLic::class,'user_id');    

    }
    
    
    public function License() {

        return $this->hasMany(License::class,'user_id')->where('enabled',1);    

    }
    
    public function scopeSearch($q, Request $request)
    {
        // dd($request->all());
        if ($request->has('columns') && is_array($request['columns']))
            foreach ($request['columns'] as $column) {
//                if (in_array($column['data'], self::DataTableSearchableFields)){
                if ($column['data'] == 'type_id') {
                    if (!empty(trim($column['search']['value']))) {
                        $q->where('type_id', $column['search']['value']);
                    }
                }
//                    else{
//                        if (!empty(trim($column['search']['value'])) && $column['search']['value'] != "0") {
//                            $q->where($column['data'], 'like', "%{$column['search']['value']}%");
//                        }
//                    }
//                }
            }

        if ($request->has('order') && isset($request['order'][0])) {
          $orderBy = 'name';
          if (isset($request['order'][0]['column'])) {
            if (isset($request['columns'][intval($request['order'][0]['column'])]['data'])) {
              $orderBy = $request['columns'][intval($request['order'][0]['column'])]['data'];
            } else {
              $orderBy =/* isset(self::DataTableFields[$request['order'][0]['column']]) ? self::DataTableFields[$request['order'][0]['column']] :*/ 'id';
            }
          }
          $orderType = 'asc';
          if (isset($request['order'][0]['dir'])) $orderType = $request['order'][0]['dir'];
                     $q->orderBy($orderBy, $orderType);

        }
    }

}
