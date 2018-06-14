<?php

namespace Tests\Feature\Realisations;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowRealisationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_fetch_all_realisations()
    {
        $realisations = create('App\Realisation', [], 2);

        $response = $this->get(route('Realisations'));

        $response
            ->assertStatus(200)
            ->assertSee($realisations[0]->name)
            ->assertSee($realisations[1]->name)
        ;
    }
}
