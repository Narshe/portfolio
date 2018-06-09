<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactsRequest;
use Illuminate\Http\Request;
use App\Contact;

class ContactsController extends Controller
{
    public function store(ContactsRequest $request)
    {

        if($request->ajax())
        {

            $contact = new Contact();
            $params = $request->all();

            if($contact->create($params)) {

                return response()->json(['message' => 'ok']);
            }

            return response()->json('Not ok');

        }
    }
}
