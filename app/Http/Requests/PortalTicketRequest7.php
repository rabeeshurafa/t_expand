<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortalTicketRequest7 extends FormRequest
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
                'customer_name' => 'required|string',
            // 'subscriber_id' => 'required|numeric|exists:users,id',
            'MobileNo' => ['required','numeric','string','digits:10'], 
            'national_id'=>['required','string','digits:9'],
            'AreaID' => 'required|numeric',
            'malDesc' => 'required',
            'task_type' => 'required|numeric',
        ];
    }
}
