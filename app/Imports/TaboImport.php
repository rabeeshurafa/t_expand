<?php

namespace App\Imports;

use App\Models\TaboData;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TaboImport implements ToCollection, WithValidation, WithHeadingRow
{
    protected $excel_id;
    public function __construct($id)
    {
        $this->excel_id = $id;
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $item) {
            $itemArray=array();
            foreach ($item as $bitItem) {
                array_push($itemArray,$bitItem);
            }
            $taboData=new TaboData();
            $taboData->excel_id =$this->excel_id;
            $taboData->temp_no =$itemArray[0];
            $taboData->owner_name =$itemArray[1];
            $taboData->area =$itemArray[2];
            $taboData->save();
            
        }
    }

    public function rules(): array
    {
        return [
//            'name' => ['required', 'string'],
//            'followers_count' => ['required'],
//            'mobile' => ['required'],
//            'link' => ['required'],
//            'general' => ['required'],
//            'free' => ['required'],
//            'store' => ['required'],
//            'visitors' => ['required'],
//            'category' => ['required'],
//            'social_media' => ['required'],
        ];
    }
}
