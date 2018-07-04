<?php

namespace App\Http\Requests;

use App\Rules\Spam;

class ContactsRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'email' => 'required|email',
            'firstname' => 'max:50',
            'lastname'  => 'max:50',
            'content'   => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Ce champ est obligatoire',
            'email'   => 'Cette adresse email n\'est pas valide',

        ];
    }


}
