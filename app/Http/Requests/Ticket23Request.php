<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Ticket23Request extends FormRequest
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
            // 'subscriber_name' => 'required|string',
            // 'subscriber_id' => 'required|numeric|exists:users,id',
            // 'MobileNo' => 'required|numeric', 
            // 'AreaID' => 'required|numeric',
            'malDesc' => 'required',
            'task_type' => 'required|numeric',
        ];
    }
}
