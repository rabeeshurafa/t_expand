<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
                'Name' => 'required|string',
                'NickName' => 'required|string',
                'DepartmentID' => 'required',
                'Position' => 'required|numeric|exists:t_constant,id',
                'JobType' => 'required|numeric|exists:t_constant,id',
                'HiringDate' => 'required',
                'email' => 'nullable|email| unique:admins',
                'NationalID' => [
                        'required', 'string', 'digits:9',
                        Rule::unique('admins', 'identification')->ignore($this->employee_id)
                ],
                'MobileNo1' => [
                        'required', 'string', 'digits:10',
                        Rule::unique('admins', 'phone_one')->ignore($this->employee_id)
                ],
                'MobileNo2' => [
                        'nullable', 'string', 'digits:10',
                        Rule::unique('admins', 'phone_two')->ignore($this->employee_id)
                ],
        ];
    }
    public function messages()
    {
        return [
                'Name.required'     => trans('error_messages.name_required'),
                'NationalID.required' => 'رقم الهوية اجباري 9 ارقام فقط',
                'NationalID.digits' => 'رقم الهوية 9 ارقام فقط',
                'NationalID.unique' => 'رقم الهوية مكرر',
                'MobileNo1.required' => 'رقم الهاتف الاول اجباري 10 ارقام فقط',
                'MobileNo1.digits' => 'رقم الهاتف 10 ارقام فقط',
                'MobileNo1.unique' => 'رقم الهاتف الاول مكرر',
                'MobileNo2.unique' => 'رقم الهاتف الثاني مكرر',
                'MobileNo2.digits' => 'رقم الهاتف 10 ارقام فقط',
        ];
    }
}
