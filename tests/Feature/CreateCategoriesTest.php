<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CreateCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_see_create_form()
    {
        $response = $this->get(route('CategoriesCreate'));

        $response
            ->assertStatus(200)
            ->assertSee('<label for="name">Nom</label>')
        ;
    }

    /** @test */
    public function admin_can_create_a_new_category()
    {
        $category = make('App\Category');

        $response = $this->post(route('CategoriesStore', ['name' => $category->name, 'type' => $category->type]));

        $this->assertDatabaseHas('categories', ['name' => $category->name]);

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Cette catégorie a bien été ajouté')
        ;
    }

    /** @test */
    public function category_name_is_unique()
    {
        $category = make('App\Category', ['name' => "Unique"]);

        $response = $this->post(route('CategoriesStore', ['name' => $category->name, 'type' => $category->type]));

        $this->assertDatabaseHas('categories', ['name' => $category->name]);


        $this->expectException("Illuminate\Validation\ValidationException");
        $response = $this->post(route('CategoriesStore', ['name' => $category->name, 'type' => $category->type]));

    }

    /** @test */
    public function category_name_is_required()
    {
        $category = make('App\Category', ['name' => ""]);
        $this->validatesCategory($category);
    }

    /** @test */
    public function category_name_is_lower_than_50_char()
    {
        $category = make('App\Category', ['name' => str_random(51)]);
        $this->validatesCategory($category);
    }

    private function validatesCategory($category)
    {
        $this->expectException("Illuminate\Validation\ValidationException");
        $response = $this->post(route('CategoriesStore', ['name' => $category->name, 'type' => $category->type]));
    }
}
