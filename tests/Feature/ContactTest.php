<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function admin_can_see_messages_from_guests()
    {

        $contacts = create('App\Contact', [
            'client_ip' => '127.0.0.1'
        ], 2);


        $response = $this->get(route('Contacts'));

        $response
            ->assertStatus(200)
            ->assertSee($contacts[0]->email)
            ->assertSee($contacts[1]->email)
        ;
    }

    /** @test */
    public function admin_can_open_messages()
    {
        $contacts = create('App\Contact', [
            'client_ip' => '127.0.0.1'
        ],2 );

        $response = $this->get(route('ContactsShow', $contacts[0]->id));

        $response
            ->assertStatus(200)
            ->assertSee($contacts[0]->email)
            ->assertSee($contacts[0]->content)
        ;
    }

    /** @test */
    public function guest_can_send_messages()
    {

        $contact = make('App\Contact');

        $this->postJson("/contact/store", $contact->toArray());

        $this->assertDatabaseHas('contacts', ['email' => $contact->email]);
    }

    /** @test */
    public function guest_must_wait_30_seconds_between_ajax_requests()
    {

        $contact = make('App\Contact');

        $this->postJson("/contact/store", $contact->toArray());

        $this->expectException(\Exception::class);

        $this->postJson("/contact/store", $contact->toArray());
    }

    /** @test */
    public function admin_can_delete_messages_from_guests()
    {

        $contact = create('App\Contact', [
            'client_ip' => '127.0.0.1'
        ]);

        $this->assertDatabasehas('contacts', ['email' => $contact->email]);

        $this->delete(route('ContactsDestroy', $contact->id));

        $this->assertDatabaseMissing('contacts', ['email' => $contact->email]);

    }
    /** @test */
    public function email_is_required()
    {

        $contact = make('App\Contact', [
            'email' => ''
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $this->postJson("/contact/store", $contact->toArray());
    }

    /** @test */
    public function content_is_required()
    {
        $contact = make('App\Contact', [
            'content' => ''
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $this->postJson("/contact/store", $contact->toArray());
    }


}
