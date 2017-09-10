<?php

namespace Cronos\Http\Requests;

class EditMaterialRequest extends Request
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
            'unit' => $this->existsInCompanie('units'),
            'category' => $this->existsInCompanie('categories')
        ];
    }
}
