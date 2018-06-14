<?php

namespace Tests\Feature\Medias;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowMediasTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function admin_can_fetch_all_medias()
    {

        $skill = create('App\Skill');
        $media = create('App\Media', [
            'mediable_type' => 'App\Skill',
            'mediable_id'   => $skill->id,
            'path'  => 'fakepath'
        ]);

        $response = $this->get(route('Medias'));

        $response
            ->assertStatus(200)
            ->assertSee($media->mediable->name)
        ;
    }
}
