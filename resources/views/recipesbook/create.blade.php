<x-layout title="Add a Recipe">
  <div class="form-container">
      <form action="/recipesbook" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
              <label for="name">Recipe Name:</label>
              <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter the recipe name">
              <div class="create-message">
                  {{ $errors->first('name') }}
              </div>
          </div>

          <div class="form-group">
              <label for="ingredients">Ingredients:</label>
              <textarea id="ingredients" name="ingredients" rows="4" placeholder="List the ingredients">{{ old('ingredients') }}</textarea>
              <div class="create-message">
                  {{ $errors->first('ingredients') }}
              </div>
          </div>

          <div class="form-group">
              <label for="instructions">Instructions:</label>
              <textarea id="instructions" name="instructions" rows="4" placeholder="Write the instructions">{{ old('instructions') }}</textarea>
              <div class="create-message">
                  {{ $errors->first('instructions') }}
              </div>
          </div>

          <div class="form-group">
              <label for="preparation_time">Preparation Time (in min):</label>
              <input type="number" id="preparation_time" name="preparation_time" value="{{ old('preparation_time') }}" placeholder="e.g., 30">
              <div class="create-message">
                  {{ $errors->first('preparation_time') }}
              </div>
          </div>

          <fieldset class="form-group">
              <legend>Select Category for Your Recipe:</legend>
              @foreach ($categories as $category)
              <label class="radio-option">
                  <input type="radio" name="category" value="{{$category->id}}" {{ old('category') == $category->id ? 'checked' : '' }}>
                  {{$category->name}}
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
                  <input type="radio" name="cuisine" value="{{ $cuisine->id }}" {{ old('cuisine') == $cuisine->id ? 'checked' : '' }}>
                  {{ $cuisine->name }}
              </label>
              @endforeach
              <div class="create-message">
                  {{ $errors->first('cuisine') }}
              </div>
          </fieldset>

          <fieldset class="form-group macros">
              <legend>Enter the Macros:</legend>
              <div class="macro-item">
                  <label for="calories">Calories(Kcal):</label>
                  <input type="number" id="calories" name="calories" value="{{ old('calories') }}" placeholder="e.g., 200">
                  <div class="create-message">
                      {{ $errors->first('calories') }}
                  </div>
              </div>

              <div class="macro-item">
                  <label for="carbs">Carbohydrates(g):</label>
                  <input type="number" id="carbs" name="carbs" value="{{ old('carbs') }}" placeholder="e.g., 30">
                  <div class="create-message">
                      {{ $errors->first('carbs') }}
                  </div>
              </div>

              <div class="macro-item">
                  <label for="protein">Protein(g):</label>
                  <input type="number" id="protein" name="protein" value="{{ old('protein') }}" placeholder="e.g., 15">
                  <div class="create-message">
                      {{ $errors->first('protein') }}
                  </div>
              </div>

              <div class="macro-item">
                  <label for="fats">Fats(g):</label>
                  <input type="number" id="fats" name="fats" value="{{ old('fats') }}" placeholder="e.g., 5">
                  <div class="create-message">
                      {{ $errors->first('fats') }}
                  </div>
              </div>
          </fieldset>

          <div class="form-group">
              <label for="image">Add an Image:</label>
              <input type="file" id="image" name="image" accept="image/*">
              <div class="create-message">
                  {{ $errors->first('image') }}
              </div>
          </div>
          <div class="button-container">
              <button type="submit" class="btn-submit">Add Recipe</button>
          </div>
      </form>
  </div>
</x-layout>
