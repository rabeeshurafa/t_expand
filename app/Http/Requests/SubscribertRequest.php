<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class SubscribertRequest extends FormRequest
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
            'formDataNameAR' => 'required|string',
            'formDataNationalID' => ['required','string','digits:9',Rule::unique('users','national_id')->ignore($this->subscriber_id)],
            'formDataMobileNo1' => ['nullable','string','digits:10',Rule::unique('users','phone_one')->ignore($this->subscriber_id)],
            'formDataMobileNo2' => ['nullable','string','digits:10',Rule::unique('users','phone_two')->ignore($this->subscriber_id)],
        ];
    }
    
    public function messages()
    {
        return [
            'formDataNameAR.required'     => trans('error_messages.name_required'),
            // 'classType.required' => 'اختر درجة العضوية',
            'formDataNationalID.required' => 'رقم الهوية اجباري 9 ارقام فقط',
            'formDataNationalID.digits' => 'رقم الهوية 9 ارقام فقط',
            'formDataNationalID.unique' => 'رقم الهوية مكرر',
            'formDataMobileNo1.digits' => 'رقم الهاتف 10 ارقام فقط',
            'formDataMobileNo1.unique' => 'رقم الهاتف الاول مكرر',
            // 'formDataMobileNo1.required' => 'رقم الهاتف الاول اجباري',
            'formDataMobileNo2.unique' => 'رقم الهاتف الثاني مكرر',
            'formDataMobileNo2.digits' => 'رقم الهاتف 10 ارقام فقط',
        ];
    }
}
