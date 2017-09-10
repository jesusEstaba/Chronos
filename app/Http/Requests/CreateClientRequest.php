<?php

namespace Cronos\Http\Requests;

class CreateClientRequest extends Request
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
            'rif' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];
    }
}
