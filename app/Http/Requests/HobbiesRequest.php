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
            'name' => ['required', $this->uniqueRule('hobbies', $this->hobby ? $this->hobby->id : null)],
            'category_id' => $this->existsWhere('categories', 'type', 'App\Hobby'),
            'url' => 'nullable|url',
            'visible' => 'nullable',
            'description' => 'string|nullable',
            'icon' => 'string|nullable'
        ];
    }
}
