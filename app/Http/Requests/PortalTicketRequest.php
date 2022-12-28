<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortalTicketRequest extends FormRequest
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
            // 'Address' => 'required|string',
            'subscriptionType' => 'required|numeric',
            // 'AssignedToID' => 'required|numeric',
            // 'Position' => 'required|numeric|exists:t_constant,id',
            // 'JobType' => 'required|numeric|exists:t_constant,id',
            //'DirectManager' => 'required|numeric',
            // 'email' => 'nullable|email| unique:admins',
        ];
    }
}
