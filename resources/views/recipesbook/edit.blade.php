<x-layout title="Edit Recipe">
    <div class="form-container">
        <form action="/recipesbook/{{$recipe->id}}/update" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Recipe Name:</label>
                <input type="text" id="name" name="name" value="{{$recipe->name}}" placeholder="Enter the recipe name">
                <div class="create-message">
                    {{ $errors->first('name') }}
                </div>
            </div>
  
            <div class="form-group">
                <label for="ingredients">Ingredients:</label>
                <textarea id="ingredients" name="ingredients" rows="4" placeholder="List the ingredients">{{$recipe->ingredients}}</textarea>
                <div class="create-message">
                    {{ $errors->first('ingredients') }}
                </div>
            </div>
  
            <div class="form-group">
                <label for="instructions">Instructions:</label>
                <textarea id="instructions" name="instructions" rows="4" placeholder="Write the instructions">{{$recipe->instructions}}</textarea>
                <div class="create-message">
                    {{ $errors->first('instructions') }}
                </div>
            </div>
  
            <div class="form-group">
                <label for="preparation_time">Preparation Time (in min):</label>
                <input type="number" id="preparation_time" name="preparation_time" value="{{$recipe->preparation_time}}" placeholder="e.g., 30">
                <div class="create-message">
                    {{ $errors->first('preparation_time') }}
                </div>
            </div>
  
            <fieldset class="form-group">
                <legend>Select Category for Your Recipe:</legend>
                @foreach ($categories as $category)
                <label class="radio-option">
                    <input type="radio" name="category" value="{{ $category->id }}" 
                        {{ $recipe->category_id == $category->id ? 'checked' : '' }}>
                    {{ $category->name }}
                </label>
                @endforeach
                <div class="create-message">
                    {{ $errors->first('category') }}
                </div>
            </fieldset>
            <fieldset class="form-group">
                <legend>Select Type of Cuisine:</legend>
                @foreach ($cuisines as $cuisine)
                <label class="radio-option">
                    <input type="radio" name="cuisine" value="{{ $cuisine->id }}" 
                        {{ $recipe->cuisine_id == $cuisine->id ? 'checked' : '' }}>
                    {{ $cuisine->name }}
                </label>
                @endforeach
                <div class="create-message">
                    {{ $errors->first('cuisine') }}
                </div>
            </fieldset>
  
            <fieldset class="form-group macros">
                <legend>Enter the Macros:</legend>
                <input type="text" id="macro_id" name="macro_id" value={{$macro->id}} hidden>
                <div class="macro-item">
                    <label for="calories">Calories(Kcal):</label>
                    <input type="number" id="calories" name="calories" value="{{ $macro->calories }}" placeholder="e.g., 200">
                    <div class="create-message">
                        {{ $errors->first('calories') }}
                    </div>
                </div>
  
                <div class="macro-item">
                    <label for="carbs">Carbohydrates(g):</label>
                    <input type="number" id="carbs" name="carbs" value="{{ $macro->carbohydrates }}" placeholder="e.g., 30">
                    <div class="create-message">
                        {{ $errors->first('carbs') }}
                    </div>
                </div>
  
                <div class="macro-item">
                    <label for="protein">Protein(g):</label>
                    <input type="number" id="protein" name="protein" value="{{ $macro->protein }}" placeholder="e.g., 15">
                    <div class="create-message">
                        {{ $errors->first('protein') }}
                    </div>
                </div>
  
                <div class="macro-item">
                    <label for="fats">Fats(g):</label>
                    <input type="number" id="fats" name="fats" value="{{ $macro->fat }}" placeholder="e.g., 5">
                    <div class="create-message">
                        {{ $errors->first('fats') }}
                    </div>
                </div>
            </fieldset>

            <div class="form-group">
                <label for="image">Current Image:</label>
                @if($recipe->image)
                    <div>
                        <img src="{{ asset($recipe->image) }}" alt="Recipe Image" style="width: 400px; height: auto;">
                    </div>
                @endif
                <label for="image">Change Image:</label>
                <input type="file" id="image" name="image" value= "{{$recipe->image}}" accept="image/*">
                    <div class="create-message">
                        {{ $errors->first('image') }}
                    </div>
            </div>
            <div class="button-container">
                <button type="submit" class="btn-submit">Save Changes</button>
            </div>
        </form>
    </div>
  </x-layout>
  