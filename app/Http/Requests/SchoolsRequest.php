<?php

namespace App\Http\Requests;

class SchoolsRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name' => ['required','max:255',$this->uniqueRule('schools', $this->school ? $this->school->id : null)],
          'city'  => 'max:50',
          'url' => 'nullable|url'
        ];
    }
}
