<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Cuisine;
use App\Models\Macro;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    // Displays the homepage with featured, popular, and new recipes
    function index()
    {
        $featuredRecipes = Recipe::inRandomOrder()->take(4)->get(['id', 'name', 'image']);

        $popularRecipes = Recipe::withCount('users')
            ->orderBy('users_count', 'desc')
            ->take(5)
            ->get(['id', 'name', 'image']);


        $newRecipes = Recipe::latest()->take(5)->get(['id', 'name', 'image']);

        $categories = Category::all(['id', 'name']);

        return view('recipesbook.index', [
            'featuredRecipes' => $featuredRecipes,
            'newRecipes' => $newRecipes,
            'popularRecipes' => $popularRecipes,
            'categories' => $categories,
        ]);
    }


    // Lists all recipes with pagination
    function recipesList()
    {
        $recipes = Recipe::paginate(12);
        $categories = Category::all();
        $cuisines = Cuisine::all();

        $categoryCounts = Category::withCount('recipes')
        ->pluck('recipes_count', 'name')
        ->toArray();

        $cuisineCounts = Cuisine::withCount('recipes')
            ->pluck('recipes_count', 'name')
            ->toArray();

        return view('recipesbook/recipesList',
        ['recipes' => $recipes,
        'categoryCounts' => $categoryCounts,
        'categories' => $categories,
        'cuisines' => $cuisines,
        'cuisineCounts' => $cuisineCounts
        ]);
    }

    // Displays the form for adding a new recipe
    function create()
    {
        $categories = Category::all();
        $cuisines = Cuisine::all();
        $macros = Macro::all();
        return view('recipesbook.create', ['categories' => $categories, 'cuisines'=> $cuisines, 'macros' => $macros]);
    }

    // About page
    function about()
    {
        return view('recipesbook.about');
    }

    // Shows a specific recipe's details
    function show($id)
    {

        $recipe = Recipe::find($id);

        if (!$recipe) {
            return redirect('/')->with('error', 'Couldnt find the recipe');
        }
        else
        {
            $cuisine = $recipe->cuisine;
            $category = $recipe->category;
            $macro = $recipe->macro;

            return view('recipesbook.show', [
                'recipe' => $recipe,
                'cuisine' => $cuisine,
                'category' => $category,
                'macro' => $macro,
            ]);
        }
    }

    // Displays the edit form for a specific recipe
    function edit($id)
    {
        $recipe = Recipe::find($id);
        $categories = Category::all();
        $cuisines = Cuisine::all();
        $macro = $recipe->macro;

        return view('recipesbook.edit', [
            'recipe' => $recipe,
            'categories' => $categories,
            'cuisines'=> $cuisines,
            'macro' => $macro,
        ]);
    }

    // Handles the form submission for creating a new recipe
    function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'preparation_time' => 'required|integer',
            'category' => 'required',
            'cuisine' => 'required'
        ]);

        $macro = new Macro();
        $macro->calories = $request->calories;
        $macro->carbohydrates = $request->carbs;
        $macro->protein = $request->protein;
        $macro->fat = $request->fats;
        $macro->save();

        $recipe = new Recipe();
        $recipe->fill($request->only(['name', 'ingredients', 'instructions', 'preparation_time']));

        $image = $request->image;
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $recipe->image = asset('images/' . $imageName);


        $recipe->category_id = $request->category;
        $recipe->cuisine_id = $request->cuisine;
        $recipe->macro_id = $macro->id;
        $recipe->save();

        return redirect('/recipesbook')->with('success',"New Recipe, $recipe->name has been added!");
    }

    // Updates a recipe's details
    function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'preparation_time' => 'required|integer',
            'category' => 'required',
        ], [
            'name.required' => 'Recipe Name is required'
        ]);

        $macro = Macro::find($request->macro_id);
        $macro->calories = $request->calories;
        $macro->carbohydrates = $request->carbs;
        $macro->protein = $request->protein;
        $macro->fat = $request->fats;
        $macro->save();

        $recipe = Recipe::find($id);
        if (!$recipe) {
            return redirect('/recipesbook')->with('error', 'Recipe not avialable!');
        }

        $recipe->fill($request->only(['name', 'ingredients', 'instructions', 'preparation_time']));

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $recipe->image = asset('images/' . $imageName);
        }

        $recipe->category_id = $request->category;
        $recipe->cuisine_id = $request->cuisine;
        $recipe->macro_id = $macro->id;
        $recipe->save();

        return redirect('/recipesbook/recipesList')->with('success',"$recipe->name recipe has been updated!");
    }

    // Deletes a recipe along with its associated macro
    function destroy($id)
    {
        $recipe = Recipe::find($id);
        $macro = $recipe->macro;
        $recipe->delete();
        $macro->delete();

        return redirect('/recipesbook/recipesList')->with('success', "$recipe->name recipe has been deleted!");
    }

    // Handles search, sorting, and filtering of recipes
    public function getRecipes(Request $request)
    {
        $search = $request->input('search', '');
        $sortBy = $request->input('sort_by', 'id');
        $category = $request->input('category', 'none');
        $cuisine = $request->input('cuisine', 'none');
        $validSortOptions = ['id', 'name', 'preparation_time'];

        // Validate sort option
        if (!in_array($sortBy, $validSortOptions)) {
            $sortBy = 'id'; // Default to 'id' if invalid
        }

        // Query inputted
        $query = Recipe::query()->with('category', 'cuisine'); // Include cuisine relationship if exists

        // Search
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('preparation_time', 'LIKE', '%' . $search . '%');
            });
        }

        // Category filter
        if ($category !== 'none') {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }

        // Cuisine filter
        if ($cuisine !== 'none') {
            $query->whereHas('cuisine', function ($q) use ($cuisine) {
                $q->where('name', $cuisine);
            });
        }

        $recipes = $query->orderBy($sortBy)->paginate(12);

        return response()->json([
            'recipes' => $recipes->map(function ($recipe) {
                return [
                    'id' => $recipe->id,
                    'name' => $recipe->name,
                    'preparation_time' => $recipe->preparation_time,
                    'category' => $recipe->category ? $recipe->category->name : 'Not categorized',
                    'cuisine' => $recipe->cuisine ? $recipe->cuisine->name : 'Not specified',
                    'image' => $recipe->image ?? '/images/background.jpg',
                ];
            }),
            'pagination' => $recipes->appends([
                'search' => $search,
                'sort_by' => $sortBy,
                'category' => $category,
                'cuisine' => $cuisine,
            ])->links()->toHtml(),
        ]);
    }


    public function getUserSavedRecipes(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        if (!$user) {
            return response()->json([
                'error' => 'User not authenticated.',
            ], 401); // Return 401 if the user is not authenticated
        }

        $search = $request->input('search', '');
        $sortBy = $request->input('sort_by', 'id');
        $category = $request->input('category', 'none');
        $cuisine = $request->input('cuisine', 'none');
        $show = $request->input('show', 'all'); // Get the "Show" filter value
        $validSortOptions = ['id', 'name', 'preparation_time'];

        // Validate the sort option
        if (!in_array($sortBy, $validSortOptions)) {
            $sortBy = 'id'; // Default to 'id' if invalid
        }

        // Access the saved recipes relationship
        $query = $user->savedRecipes()->with('category', 'cuisine');

        // Apply search filter
        if (!empty($search)) {
            $query->where(function ($input) use ($search) {
                $input->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('preparation_time', 'LIKE', '%' . $search . '%');
            });
        }

        // Apply category filter
        if ($category !== 'none') {
            $query->whereHas('category', function ($input) use ($category) {
                $input->where('name', $category);
            });
        }

        // Apply cuisine filter
        if ($cuisine !== 'none') {
            $query->whereHas('cuisine', function ($input) use ($cuisine) {
                $input->where('name', $cuisine);
            });
        }

        // Apply "Show" filter
        if ($show === 'favourite') {
            $query->wherePivot('is_favorite', true);
        }

        // Fetch and paginate results
        $recipes = $query->orderBy($sortBy)->paginate(12);

        // Return the recipes in JSON format
        return response()->json([
            'recipes' => $recipes->map(function ($recipe) {
                return [
                    'id' => $recipe->id,
                    'name' => $recipe->name,
                    'preparation_time' => $recipe->preparation_time,
                    'category' => $recipe->category ? $recipe->category->name : 'Not categorized',
                    'cuisine' => $recipe->cuisine ? $recipe->cuisine->name : 'Not specified',
                    'image' => $recipe->image ?? '/images/background.jpg',
                ];
            }),
            'pagination' => $recipes->appends([
                'search' => $search,
                'sort_by' => $sortBy,
                'category' => $category,
                'cuisine' => $cuisine,
                'show' => $show,
            ])->links()->toHtml(),
        ]);
    }


    // Shows the saved recipes for the logged-in user
    function savedRecipesPage()
    {
        $user = Auth::user();
        $saves = $user->savedRecipes;
        $categories = Category::all();
        $cuisines = Cuisine::all();

        if (!$saves || $saves->isEmpty()) {
            return redirect()->back()->with('error', 'No saved recipes found.');
        }

        // Count recipes by category related to saved recipes
        $categoryCounts = Category::withCount(['recipes' => function ($query) use ($saves) {
        $query->whereIn('id', $saves->pluck('id'));
        }])->pluck('recipes_count', 'name')->toArray();

        // Count recipes by cuisine related to saved recipes
        $cuisineCounts = Cuisine::withCount(['recipes' => function ($query) use ($saves) {
        $query->whereIn('id', $saves->pluck('id'));
        }])->pluck('recipes_count', 'name')->toArray();

        return view('recipesbook.savedrecipes', [
            'recipes' => $saves,
            'categoryCounts' => $categoryCounts,
            'categories' => $categories,
            'cuisines' => $cuisines,
            'cuisineCounts' => $cuisineCounts
        ]);
    }
    public function saveUserRecipe($id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        $recipe = Recipe::find($id);
        if (!$recipe) {
            return response()->json(['error' => 'Recipe not found in database.'], 404);
        }

        // Toggle between save/unsave logic
        if ($user->savedRecipes()->where('recipe_id', $id)->exists()) {
            $user->savedRecipes()->detach($id);
            return response()->json(['success' => 'Recipe removed from saved']);
        }

        $user->savedRecipes()->attach($id);
        return response()->json(['success' => 'Recipe saved!']);
    }



}
