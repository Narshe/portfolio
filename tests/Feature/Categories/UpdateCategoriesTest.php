<?php

namespace Tests\Feature\Categories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateCategoriesTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function admin_can_see_edit_form()
    {
        $category = create('App\Category');
        $response = $this->get(route('CategoriesEdit', ['category' => $category->id]));

        $response
            ->assertStatus(200)
            ->assertSee($category->name)
        ;
    }

    /** @test */
    public function admin_can_update_a_category()
    {
        $category = create('App\Category');
        $newCategory = make('App\Category');

        $response = $this->patch(route('CategoriesUpdate', $category->id), $newCategory->toArray());

        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => $newCategory->name]);

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Cette catégorie a bien été édité')
        ;
    }

    /** @test */
    public function admin_can_delete_category()
    {
        $category = createWithEvents('App\Category');
        $skill = create('App\Skill', ['category_id' => $category->id]);

        $this->delete(route('CategoriesDestroy', ['id' => $category->id]));

        $this->assertDatabaseMissing('categories', ['name' => $category->name]);
        $this->assertDatabaseMissing('skills', ['name' => $skill->name]);
    }

    /** @test */
    public function category_name_is_unique()
    {
        $category = create('App\Category');
        $category2 = create('App\Category');

        $this->expectException("Illuminate\Validation\ValidationException");
        $response = $this->patch(route('CategoriesUpdate', [
            'id'   => $category->id,
            'name' => $category2->name,
            'type' => $category2->type
            ]
        ));

    }

    /** @test */
    public function admin_may_only_update_category_type()
    {
        $category = create('App\Category');
        $category2 = create('App\Category', ['type' => 'App\Category']);

        $response = $this->patch(route('CategoriesUpdate', [
            'id'   => $category->id,
            'name' => $category->name,
            'type' => $category2->type]
        ));

        $this->assertDataBaseHas('categories', [
            'id' => $category->id,
            'name' => $category->name,
            'type' => $category2->type,
        ]);

        $response
            ->assertStatus(302)
            ->assertSessionHas('success', 'Cette catégorie a bien été édité')
        ;
    }

}
