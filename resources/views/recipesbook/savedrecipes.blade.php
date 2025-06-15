<x-layout title="Recipes List">
    <h2 class="recipelists-heading">Saved Recipes</h2>
    <div class="recplistmain-content">
        <div class='RListheader'>
            <div id="search-container-saved">
                <form id="searchFormSaved">
                    <div class="search-item">
                        <input type="text" id="searchBarSaved" class="searchBar" placeholder="Search for recipes">
                        <button id="searchButtonSaved" type="submit" class="searchButton"></button>
                    </div>    
                </form>
            </div>
        <div id="searchMessageSaved"></div>    
        <h3>- Filters -</h3>
            <div class="filters">
                <div class='filter-item'>
                    <p><b>Sorting</b></p>
                    <select id="dropdownSortSaved">
                        <option value="none">None</option>
                        <option value="name">Name (A-Z)</option>
                        <option value="preparation_time">Prep Time (Min-Max)</option>
                    </select>                    
                </div>
                <div class='filter-item'>
                    <p><b>Category</b></p>
                    <select id="dropdownCategorySaved">
                        <option value="none" selected>None</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }} ({{ $categoryCounts[$category->name] }})</option>
                        @endforeach
                    </select>                
                </div>
                <div class="filter-item">
                    <p><b>Cuisines</b></p>
                    <select id="dropdownCuisineSaved">
                        <option value="none" selected>None</option>
                        @foreach ($cuisines as $cuisine)
                            <option value="{{ $cuisine->name }}">{{ $cuisine->name }} ({{ $cuisineCounts[$cuisine->name] }})</option>
                        @endforeach
                    </select>
                </div>    
            </div>
        </div>       
        <div class="recipelists-container">      
            <div id="recipes-container-saved" class="recipelists-item">   
                <div class="listmain">
                    @if ($recipes->isEmpty())
                        <p class="no-recipes-message">You have no saved recipes.</p>
                    @else
                        @foreach($recipes as $recipe)
                        <div class="recipelist-item">
                            <a href="/recipesbook/{{ $recipe->id }}">
                                <img class="list-poster" src="{{ $recipe->image }}" alt="{{ $recipe->name }}">
                            </a>
                            <p class="recipe-name"><b>{{ $recipe->name }}</b></p>
                        </div>
                        @endforeach
                    @endif
                </div>                      
            </div>
        </div>      
        <div id="pagination-container-saved" class="pag-link"></div>
    </div>    
</x-layout>
