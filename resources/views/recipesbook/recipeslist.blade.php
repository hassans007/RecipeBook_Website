<x-layout title="Recipes List">
    <h2 class="recipelists-heading">All Recipes</h2>
    <div class="recplistmain-content">
        <div class='RListheader'>
            <div id="search-container">
                <form id="searchForm">
                    <div class="search-item">
                        <input type="text" id="searchBar" class="searchBar" placeholder="Search for recipes">
                        <button id="searchButton" type="submit" class="searchButton"></button>
                        <div id="searchMessageSaved"></div>
                    </div>    
                </form>        
            </div>
        <div id="searchMessage"></div>    
        <h3>- Filters -</h3>
            <div class="filters">
                <div class='filter-item'>
                    <p><b>Sorting</b></p>
                    <select id="dropdownSort">
                        <option value="none">None</option>
                        <option value="name">Name (A-Z)</option>
                        <option value="preparation_time">Prep Time (Min-Max)</option>
                    </select>                    
                </div>
                <div class='filter-item'>
                    <p><b>Category</b></p>
                    <select id="dropdownCategory">
                        <option value="none" selected>None</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }} ({{ $categoryCounts[$category->name] }})</option>
                        @endforeach
                    </select>                                        
                </div>
                <div class='filter-item'>
                    <p><b>Cuisines</b></p>
                    <select id="dropdownCuisine">
                        <option value="none" selected>None</option>
                        @foreach ($cuisines as $cuisine)
                            <option value="{{ $cuisine->name }}">{{ $cuisine->name }} ({{ $cuisineCounts[$cuisine->name] }})</option>
                        @endforeach
                    </select>
                </div>                    
            </div>
        </div>    
        <div class="recipelists-container">      
            <div id="recipes-container" class="recipelists-item">   
                <div class="listmain">
                    @foreach($recipes as $recipe)
                    <div class="recipelist-item">
                        <a href="/recipesbook/{{ $recipe->id }}">
                            <img class="list-poster" src="{{ $recipe->image }}" alt="{{ $recipe->name }}">
                        </a>
                        <p class="recipe-name"><b>{{ $recipe->name }}</b></p>
                    </div>
                    @endforeach
                </div>                      
            </div>
        </div>      
        <div id="pagination-container" class="pag-link"></div>
    </div>    
</x-layout>
