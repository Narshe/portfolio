<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Database\Eloquent\Collection;

use App\Contact;


class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function message_is_mark_as_read_when_open()
    {

        $contact = create('App\Contact', [
            'client_ip' => '127.0.0.1'
        ]);

        $this->assertEquals(0, $contact->is_read);

        $contact->markAsRead();

        $this->assertEquals(1, $contact->is_read);
    }

    /** @test */
    public function it_can_count_unread_messages()
    {
        $contacts = create('App\Contact', [
            'client_ip' => '127.0.0.1'
        ], 5);

        $this->assertEquals(5, $contacts[0]->countUnread());
    }
}
