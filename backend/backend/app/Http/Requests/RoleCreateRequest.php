<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleCreateRequest extends FormRequest
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
        $id = $this->route('role');

        return [
            'name'                              =>  "required|string|max:200|unique:roles,name,{$id},id",
            'office_id'                         =>  'required|exists:offices,id',
            'permissions'                       =>  'required|array|exists:permissions,id'
        ];
    }
}
