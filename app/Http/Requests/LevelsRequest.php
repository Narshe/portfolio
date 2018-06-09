<?php

namespace App\Http\Requests;

class LevelsRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => ['required', $this->uniqueRule('levels', $this->id)],
            'value' => ['required', $this->uniqueRule('levels', $this->id), 'integer', 'between:0,5']
        ];
    }


}
