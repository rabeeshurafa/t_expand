<?php

namespace App\Managers;
use Illuminate\Http\Request;
use App\Models\File;

class AttatchmentManager
{

    public static function prepearAttach (Request $request){
        $attach_ids=$request->attach_ids;
        $attachName=$request->attachName1;
        $attachArr=array();
        if($attach_ids)
        for($i=0;$i<sizeof($attach_ids);$i++){
            $temp=array();
            $temp['attachName']=trim($attachName[$i]);
            $temp['attach_ids']=trim($attach_ids[$i]);
            $attachArr[]=$temp;
        }
        return $attachArr;
    }
    
    public static function getAttach( $file_ids=array()){
        $attachArr=array();
        if(is_array($file_ids))
            foreach($file_ids as $row){
                $row->Files=File::where('id',$row->attach_ids)->get();
            }
        return $file_ids;
    }

}