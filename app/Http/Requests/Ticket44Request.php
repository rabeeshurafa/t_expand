<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Ticket44Request extends FormRequest
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
            'subscriber_name' => 'required|string',
            'subscriber_id' => 'required|numeric|exists:admins,id',
            'subscriber_name1' => 'required|string',
            'subscriber_id1' => 'required|numeric|exists:admins,id',
            'malDesc' => 'required',
            'year' => 'required',
            'app_no' => 'required',
            'topic' => 'required|string',
        ];
    }
}
