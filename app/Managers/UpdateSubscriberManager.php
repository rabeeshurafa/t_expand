<?php

namespace App\Managers;

use App\Models\User;

class UpdateSubscriberManager
{
    public function updateCMobile($customer, $mobile)
    {
        $mystring = $mobile;
        $findme = '056';

        $user = User::find($customer);
        if (!$user)
            return;
        //dd($user);
        $pri = substr($mystring, 0, 3);
        if ($pri == $findme)
            $user->phone_two = $mystring;
        else
            $user->phone_one = $mystring;
        $user->save();
    }

    public static function updateCNationalID($customer, $nationalID)
    {
        $mystring = $nationalID;

        $user = User::find($customer);
        if (!$user)
            return;
        //dd($user);

        $user->national_id = $nationalID;
        $user->save();
    }
}
