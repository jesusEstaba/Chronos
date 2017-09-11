<?php

namespace Cronos\Http\Requests;

class CreateWorkforceRequest extends Request
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
            'cost' => 'required|numeric',
        ];
    }
}
