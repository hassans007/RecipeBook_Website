<x-layout title="Recipe Details">

    <div class="show-container">
        <div class="recipe-content">

            <img src="{{$recipe->image}}" alt="{{$recipe->name}} image" class="recipe-image">

            <div class="recipe-details">
                <h2>{{$recipe->name}}</h2>

                <div class="recipe-sub-details">
                    <span>Prep Time: {{$recipe->preparation_time}} mins</span>
                    <span>Cuisine: {{$cuisine->name}}</span>
                </div>

                <div class="ingredients-instructions">

                    <div class="ingredients">
                        <h3>Ingredients</h3>
                        <p>{{$recipe->ingredients}}</p>
                    </div>

                    <div class="instructions">
                        <h3>Instructions</h3>
                        <p>{{$recipe->instructions}}</p>
                    </div>
                </div>

                @if ($macro)
                <div class="macros">
                    <h3>Macros</h3>
                    <div class="macro-details">
                    <p><b>Calories: </b>{{ $macro->calories }}Kcal</p>
                    <p><b>Protein: </b>{{ $macro->protein }}g</p>
                    <p><b>Fat: </b>{{ $macro->fat }}g</p>
                    <p><b>Carbohydrates: </b>{{ $macro->carbohydrates }}g</p>
                    </div>
                </div>
                @else
                <div class="macros">
                    <p>No macro data available for this recipe.</p>
                </div>
                @endif
                    <div class="button-container">
                        <div class="mainButtons">
                            <form action="/recipesbook/{{ $recipe->id }}/saveUserRecipe" method="POST" class="save-form">
                                @csrf
                                @if ($recipe->isSavedByUser(auth()->user()))
                                    <button type="submit" class="main save-button sb">Remove Recipe</button>
                                @else
                                    <button type="submit" class="main save-button rb">Save Recipe</button>
                                @endif
                            </form>
                        </div>
                        @can('edit')
                            <div class="adminButton-container">
                                <a href='/recipesbook/{{$recipe->id}}/edit'><button class="main">Edit</button></a>
                                <form method="POST" action="/recipesbook/{{$recipe->id}}/destroy">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{$recipe->id}}">
                                    <button type="submit" class="main db">Delete</button>
                                </form>
                            </div>
                        @endcan
                    </div>
            </div>
        </div>
    </div>

</x-layout>
