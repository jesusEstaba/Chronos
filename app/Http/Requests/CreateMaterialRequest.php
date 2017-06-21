<?php

namespace Cronos\Http\Requests;

class CreateMaterialRequest extends Request
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
            'unit' => $this->existsInCompanie('units'),
            'category' => $this->existsInCompanie('categories')
        ];
    }
}
