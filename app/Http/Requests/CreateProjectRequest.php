<?php

namespace Cronos\Http\Requests;

class CreateProjectRequest extends Request
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
            'client' => ['required', $this->existsInCompanie('clients')],
            'status' => 'required',
            'description' => 'required',
            'salary' => 'numeric',
            'salaryBonus' => 'numeric',
            'expenses' => 'numeric',
            'utility' => 'numeric',
            'unexpected' => 'numeric',
            'fcas' => 'numeric',
            //bonus
        ];
    }
}
