<?php

namespace Cronos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function existsInCompanie($table)
    {
        return Rule::exists($table, 'id')->where(function ($query) {
            $query->where('companieId', Auth::user()->companieId);
        });
    }

    public function uniqueInCompanie($table)
    {
        return Rule::unique($table, 'email')->where(function ($query) {
            $query->where('companieId', Auth::user()->companieId);
        });
    }
}
