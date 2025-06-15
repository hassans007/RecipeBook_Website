<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Cuisine;
use App\Models\Macro;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test user for authentication
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
        ]);
    }

    /**
     * Testing (recipesList method).
     */
    public function test_recipes_list_returns_data()
    {
        $category = Category::create(['name' => 'Dessert']);
        $cuisine = Cuisine::create([
            'name' => 'Italian',
            'description' => 'Cuisine famous for its pasta and pizza.',
        ]);        
        for ($i = 0; $i < 15; $i++) {
            Recipe::create([
                'name' => 'Recipe ' . $i,
                'ingredients' => 'Ingredients for recipe ' . $i,
                'instructions' => 'Instructions for recipe ' . $i,
                'preparation_time' => 30,
                'category_id' => $category->id,
                'cuisine_id' => $cuisine->id,
                'macro_id' => null,
            ]);
        }

        $response = $this->get('/recipesbook/recipesList');

        $response->assertStatus(200);
        $response->assertViewIs('recipesbook.recipesList');
        $response->assertViewHas('recipes');
    }

    /**
     * Testing (store method).
     */
    public function testing_create_new_recipe()
    {
        $this->actingAs($this->user);

        $category = Category::create(['name' => 'Dessert']);
        $cuisine = Cuisine::create(['name' => 'Italian']);

        $formData = [
            'name' => 'Test Recipe',
            'ingredients' => 'Test ingredients',
            'instructions' => 'Test instructions',
            'preparation_time' => 20,
            'calories' => 300,
            'carbohydrates' => 50,
            'protein' => 20,
            'fat' => 10,
            'category_id' => $category->id,
            'cuisine_id' => $cuisine->id,
            'image' => asset('images/defaultimage.png'),
        ];
        

        $response = $this->post('/recipesbook/store', $formData);

        $response->assertRedirect('/recipesbook');
        $this->assertDatabaseHas('recipes', ['name' => 'Test Recipe']);
    }

    /**
     * Testing (update method).
     */
    public function testing_update_recipe()
    {
        $this->actingAs($this->user);

        $category = Category::create(['name' => 'Dessert']);
        $cuisine = Cuisine::create(['name' => 'Italian']);
        $macro = Macro::create(['name' => 'Test Macro']);
        $recipe = Recipe::create([
            'name' => 'Test Recipe',
            'ingredients' => 'Test Ingredients',
            'instructions' => 'Test Instructions',
            'preparation_time' => 30,
            'category_id' => $category->id,
            'cuisine_id' => $cuisine->id,
            'macro_id' => $macro->id,
            'image' => asset('images/defaultimage.png'),
        ]);
        

        $newData = [
            'name' => 'Updated Recipe',
            'ingredients' => 'Updated ingredients',
            'instructions' => 'Updated instructions',
            'preparation_time' => 30,
            'calories' => 400,
            'carbs' => 60,
            'protein' => 25,
            'fats' => 15,
            'category' => $category->id,
            'cuisine' => $cuisine->id,
        ];

        $response = $this->put("/recipesbook/update/{$recipe->id}", $newData);

        $response->assertRedirect('/recipesbook/recipesList');
        $this->assertDatabaseHas('recipes', ['name' => 'Updated Recipe']);
    }

    /**
     * Testing (destroy method).
     */
    public function testing_delete_recipe()
    {
        $this->actingAs($this->user);

        $category = Category::create(['name' => 'Dessert']);
        $cuisine = Cuisine::create(['name' => 'Italian']);
        $recipe = Recipe::create([
            'name' => 'Recipe to Delete',
            'ingredients' => 'Ingredients to delete',
            'instructions' => 'Instructions to delete',
            'preparation_time' => 20,
            'category_id' => $category->id,
            'cuisine_id' => $cuisine->id,
            'macro_id' => null,
        ]);

        $response = $this->delete("/recipesbook/delete/{$recipe->id}");

        $response->assertRedirect('/recipesbook/recipesList');
        $this->assertDatabaseMissing('recipes', ['id' => $recipe->id]);
    }

    /**
     * Testing (saveUserRecipe method).
     */
    public function testing_save_and_remove_user_recipe()
    {
        $this->actingAs($this->user);

        $category = Category::create(['name' => 'Dessert']);
        $cuisine = Cuisine::create(['name' => 'Italian']);
        $recipe = Recipe::create([
            'name' => 'Recipe to Save',
            'ingredients' => 'Ingredients to save',
            'instructions' => 'Instructions to save',
            'preparation_time' => 20,
            'category_id' => $category->id,
            'cuisine_id' => $cuisine->id,
            'macro_id' => null,
        ]);

        $response = $this->post("/recipesbook/save/{$recipe->id}");
        $response->assertJson(['success' => 'Recipe saved!']);
        $this->assertDatabaseHas('recipe_user', ['recipe_id' => $recipe->id, 'user_id' => $this->user->id]);

        $response = $this->post("/recipesbook/save/{$recipe->id}");
        $response->assertJson(['success' => 'Recipe removed from saved']);
        $this->assertDatabaseMissing('recipe_user', ['recipe_id' => $recipe->id, 'user_id' => $this->user->id]);
    }

    /**
     * Testing (getRecipes method).
     */
    public function testing_filter_and_search_recipes()
    {
        $category = Category::create(['name' => 'Dessert']);
        $cuisine = Cuisine::create(['name' => 'Italian']);
        Recipe::create([
            'name' => 'Tiramisu',
            'ingredients' => 'Ingredients for tiramisu',
            'instructions' => 'Instructions for tiramisu',
            'preparation_time' => 30,
            'category_id' => $category->id,
            'cuisine_id' => $cuisine->id,
            'macro_id' => null,
        ]);

        $response = $this->get('/recipesbook/getRecipes?search=Tiramisu&category=Dessert&cuisine=Italian');

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Tiramisu']);
    }

    /**
     * Testing (show method).
     */
    public function test_unavailable_recipe()
{
    $response = $this->get('/recipesbook/show/99999');
    $response->assertRedirect('/recipesbook');
    $response->assertSessionHas('error', 'Couldnt find the recipe');
}

}
