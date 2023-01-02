<?php

namespace App\Managers;

use App\Models\User;

class SubscriberManager
{
    public static function isSubscriberExist($nationalId): bool
    {
        if ($nationalId != 0) {
            $user = User::where('national_id', $nationalId)->first();
            if ($user != null) {
                return true;
            }
        }
        return false;
    }

    public static function updateCMobile($id, $mobile)
    {
        $mystring = $mobile;
        $findme = '056';

        $user = User::find($id);
        $pri = substr($mystring, 0, 3);
        if ($pri == $findme) {
            $user->phone_two = $mystring;
        } else {
            $user->phone_one = $mystring;
        }
        $user->save();
    }

    public static function add_UpdateSubscriber($name, $mobile = 0, $nationalId = 0, $id = 0)
    {
        if ($id == 0) {
            if (!self::isSubscriberExist($nationalId)) {
                $user = new User();
            } else {
                $user = User::where('national_id', $nationalId)->first();
            }
        } else {
            $user = User::find($id);
        }
        if ($nationalId != 0) {
            $user->national_id = $nationalId;
        }
        $user->name = $name;
        $user->save();
        if ($mobile != 0) {
            self::updateCMobile($user->id, $mobile);
        }
        return $user->id;
    }
}