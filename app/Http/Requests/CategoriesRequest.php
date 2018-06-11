<?php

namespace App\Http\Requests;

class CategoriesRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => ['required','max:50', $this->uniqueRule('categories', $this->category ? $this->category->id : null)]
        ];

    }


}
