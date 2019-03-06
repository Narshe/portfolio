<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Request extends FormRequest
{

    /**
     * authorize
     *
     * @return boolean
     */
    public function authorize()
    {
        return true;
    }

    /**
     * uniqueRule
     *
     * @param  string $table
     * @param  integer|null $id
     *
     * @return void
     */
    protected function uniqueRule(string $table, ?int $id) {
      return Rule::unique($table)->ignore($id);
    }

    /**
     * existsWhere
     *
     * @param  string $table
     * @param  string $field
     * @param  mixed $value
     *
     * @return void
     */
    protected function existsWhere(string $table, string $field, $value) {

        return Rule::exists($table,'id')->where(function ($query) use ($field, $value) {
                  $query->where($field, $value);
         });
    }

    
    /**
     * getCurrentDate
     *
     * @return string $date format YYYY-mm-dd
     */
    protected function getCurrentDate() {
      $date = new \Datetime();

      return $date->format('Y-m-d');
    }

}
