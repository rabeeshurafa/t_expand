<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Ticket39Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subscriber_name'       => 'required|string',
            'subscriber_id'         => 'required|numeric|exists:users,id',
            'MobileNo'              => 'required|numeric', 
            'workType'              => 'required|numeric|exists:t_constant,id',
            'implementedCompany'    => 'required|numeric|exists:t_constant,id',
            'engOffice'             => 'required|numeric|exists:t_constant,id',
            'buildingType'          => 'required|numeric|exists:t_constant,id',
            // 'licNo'                 => 'required|string',
            // 'licDecisionNo'         => 'required|string',
            'hodNo'                 => 'required|string',
            'pieceNo'               => 'required|string',
            'day'                   => 'required|string',
            'date'                  => 'required|string',
            'time'                  => 'required|string',
            'duration'              => 'required|string',
            'AreaID'                => 'required|numeric',
        ];
    }
}
