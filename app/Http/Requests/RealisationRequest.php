<?php

namespace App\Http\Requests;

class RealisationRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'name' => ['required', 'alpha_num', $this->uniqueRule('realisations', $this->id)],
            'company' => 'required|alpha_num|between:2,50',
            'date_end'  =>  'required|date|before:'.$this->getCurrentDate().'',
            'date_begin' => 'required|date|before:date_end',
            'position'  => 'required|between:2,50',
            'url' =>  'nullable|url',
            'visible' =>  'nullable',
            'skills'  =>  'exists:skills,id',
            'category_id' => $this->existsWhere('categories', 'type', 'Experience'),
        ];

          if(isset($this->file('files')))
          {
            foreach($this->file('files') as $key => $file) {
              $rules['files.'.$key] =  'nullable|image';
            }
          }

        return $rules;
    }
}
