<?php

namespace App\Http\Requests;

class SkillsRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name' => ['required','max:15',$this->uniqueRule('skills', $this->id)],
          'category_id' =>  $this->existsWhere('categories', 'type', 'Skill'),
          'url'  => 'url',
          'media' => 'image'
        ];
    }
}
