<?php

namespace App\Http\Requests;


class HobbiesRequest extends Request
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', $this->uniqueRule('hobbies', $this->id)],
            'url' => 'url',
            'visible' => 'nullable',
            'category_id' => $this->existsWhere('hobbies', 'type', 'Hobby'),
        ];
    }
}
