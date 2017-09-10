<?php

namespace Cronos\Http\Requests;

class EditEquipmentRequest extends Request
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
            'depreciation' => 'required|numeric',
            'category' => $this->existsInCompanie('categories')
        ];
    }
}
