<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = "admins";
    protected $guarded = [];
    public $timestamps = true;
    protected $hidden = [
            'password',
            'curr_pass',
            'username',
    ];

    public function toArray()
    {
        if ($this->id != 74) {
            if (auth()->check() && (in_array('account',
                                    Auth()->user()->role->permissions) || auth()->user()->id == 74 || auth()->user()->id == $this->id)) {
                $this->setAttributeVisibility();
            }
        } else if (auth()->user()->id == 74) {
            $this->setAttributeVisibility();
        }
        return parent::toArray();
    }

    public function setAttributeVisibility()
    {
        $this->makeVisible(array_merge($this->hidden));
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'admin_id');
    }

    public function jobTitle()
    {
        return $this->belongsTo(Constant::class, 'job_title_id');
    }

    public function hasAbility($permissions)
    {
        $role = $this->role;

        if (!$role) {
            return false;
        }

        foreach ($role->permissions as $permission) {
            if (is_array($permissions) && in_array($permission, $permissions)) {
                return true;
            } else if (is_string($permissions) && strcmp($permissions, $permission) == 0) {
                return true;
            }
        }
        return false;
    }

    public function adminDetails()
    {
        return $this->hasOne(AdminDetail::class);
    }

    public function deleted_by()
    {

        return $this->belongsTo(Admin::class, 'deleted_by');

    }

}
