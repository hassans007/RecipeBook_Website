<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [RecipeController::class, 'index']);
Route::get('/recipesbook/getRecipes', [RecipeController::class, 'getRecipes']);
Route::get('/recipesbook/getSavedRecipes', [RecipeController::class, 'getUserSavedRecipes']);
Route::get('/recipesbook/about', [RecipeController::class, 'about']);
Route::get('/recipesbook/login', [AuthController::class, 'loginPage'])->name('login'); 
Route::post('/recipesbook/loginUser', [AuthController::class, 'login']);
Route::get('/recipesbook/signup', [AuthController::class, 'signupPage']);
Route::post('/recipesbook/signupUser', [AuthController::class, 'signup']);
Route::get('/recipesbook/create', [RecipeController::class, 'create']);

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/recipesbook/recipesList', [RecipeController::class, 'recipesList']);
    Route::get('/recipesbook/savedRecipes', [RecipeController::class, 'savedRecipesPage']);
    Route::post('/recipesbook/{id}/saveUserRecipe', [RecipeController::class, 'saveUserRecipe']);
    Route::get('/recipesbook/{id}', [RecipeController::class, 'show']);
    Route::post('/recipesbook/logout', [AuthController::class, 'logout']);
});

// Authenticated routes with edit permissions
Route::middleware(['auth', 'can:edit'])->group(function () {
    Route::post('/recipesbook', [RecipeController::class, 'store']);
    Route::put('/recipesbook/{id}/update', [RecipeController::class, 'update']);
    Route::get('/recipesbook/{id}/edit', [RecipeController::class, 'edit']);
    Route::delete('/recipesbook/{id}/destroy', [RecipeController::class, 'destroy']);
});

