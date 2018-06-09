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
          'name' => ['required','max:255',$this->uniqueRule('schools', $this->id)],
          'city'  => 'max:50',
          'url' => 'url'
        ];
    }
}
