<?php

namespace Cronos\Http\Requests;

class CreateUserRequest extends Request
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
            'email' => ['required', $this->uniqueInCompanie('users')],
            'password' => 'required',
            'rol' => 'required',
            'state' => 'required|boolean',
            'rif' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];
    }
}
