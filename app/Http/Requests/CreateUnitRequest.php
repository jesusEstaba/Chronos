<?php

namespace Cronos\Http\Requests;

class CreateUnitRequest extends Request
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
            'abbreviature' => 'required'
        ];
    }
}
