<?php

namespace Cronos\Http\Requests;

class CreatePartitieRequest extends Request
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
            'reference' => 'required',
            'yield' => 'required|numeric',
        ];
    }
}
