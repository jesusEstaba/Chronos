<?php

namespace Cronos\Http\Requests;

class AddCostRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cost' => 'required|numeric',
        ];
    }
}
