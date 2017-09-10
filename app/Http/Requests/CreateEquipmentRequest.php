<?php

namespace Cronos\Http\Requests;

class CreateEquipmentRequest extends Request
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
            'depreciation' => 'required|numeric',
            'category' => $this->existsInCompanie('categories')
        ];
    }
}
