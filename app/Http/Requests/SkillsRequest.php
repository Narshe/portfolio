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
          'name' => ['required','max:50',$this->uniqueRule('skills', $this->skill ? $this->skill->id : null)],
          'category_id' =>  $this->existsWhere('categories', 'type', 'App\Skill'),
          'url'  => 'url',
          'media' => 'image'
        ];
    }
}
