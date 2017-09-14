<?php

namespace Cronos\Http\Requests;

class EditUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'rol' => 'required',
            'rif' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];
    }
}
