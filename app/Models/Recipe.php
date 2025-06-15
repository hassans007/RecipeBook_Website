<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'ingredients',
        'instructions',
        'preparation_time',
        'category_id',
        'cuisine_id',
        'macro_id',
        'image',
    ];

    public function cuisine(): BelongsTo
    {
        return $this->belongsTo(Cuisine::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function macro()
    {
        return $this->belongsTo(Macro::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_recipes');
    }

    public function isSavedByUser($user)
    {
        // Check if the user has saved this recipe
        return $this->users()
                    ->where('user_id', $user->id)
                    ->exists();
    }
    

}
