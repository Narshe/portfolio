<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Request extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    protected function uniqueRule($table, $id) {
      return Rule::unique($table)->ignore($id);
    }

    protected function existsWhere($table, $field, $value) {

        return Rule::exists($table,'id')->where(function ($query) use ($field, $value) {
                  $query->where($field, $value);
         });
    }

    protected function getCurrentDate() {
      $date = new \Datetime();

      return $date->format('Y-m-d');
    }

}
