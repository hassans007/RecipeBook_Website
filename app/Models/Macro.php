<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Macro extends Model
{
 
    protected $fillable = ['calories', 'carbohydrates', 'protien', 'fats'];
    public function recipe()
    {
        return $this->hasOne(Recipe::class);
    }

}
