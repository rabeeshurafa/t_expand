<?php

namespace App\Managers;

class DateOperations
{
    public static function convertDateForBackend($date)
    {
        $convertedDate = null;
        try {
            if ($date) {
                $rawDate = explode('/', ($date));
                $convertedDate = $rawDate[2] . '-' . $rawDate[1] . '-' . $rawDate[0];
            } else {
                $convertedDate = null;
            }
        } catch (\Exception $e) {
        }

        return $convertedDate;
    }

    public static function convertDateForFrontend($date)
    {
//        dd($date);
        $convertedDate = null;
        try {
            if ($date) {
                $rawDate = explode('-', ($date));
                $convertedDate = $rawDate[2] . '/' . $rawDate[1] . '/' . $rawDate[0];
            } else {
                $convertedDate = null;
            }
        } catch (\Exception $e) {
//            dd($e);
        }

        return $convertedDate;
    }
}
