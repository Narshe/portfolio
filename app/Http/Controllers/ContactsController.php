<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactsRequest;
use Illuminate\Http\Request;
use App\Contact;

use App\Inspections\Spam;

class ContactsController extends Controller
{
    public function index()
    {

        $contacts = Contact::latest()->get();

        return view('Admin.Contacts.index', compact('contacts'));
    }


    public function show(Contact $contact)
    {
        $contact->markAsRead();

        return view('Admin.Contacts.show', compact('contact'));
    }

    public function store(ContactsRequest $request, Spam $spam)
    {

        if($request->wantsJson())
        {

            if ($spam->detect($request->ip())) {

                throw new \Exception("Vous devez attendre {$spam->remaining()} secondes avant de pouvoir réenvoyer un message.", 422);
            }

            $contact = Contact::create([
                'email' => $request->email,
                'lastname' => $request->lastname,
                'firstname' => $request->firstname,
                'content' => $request->content,
                'client_ip' => $request->ip()
            ]);

            return $contact
                ? response()->json(['message' => 'Votre message a bien été envoyé'])
                : '';

        }
    }

    public function destroy(Contact $contact)
    {

        $contact->delete();

        return redirect()->route('Contacts')->with('success', 'Ce message a bien été supprimé');
    }
}
