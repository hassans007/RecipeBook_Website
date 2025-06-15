<x-layout title="Home">
    <header class="backimg-section">
        <div class="backimg-content">
            <h1>Welcome to the place full of healthy food and ideas to keep you fit</h1>
        </div>
    </header>
    @guest
        <div class='guestmessage'>
            <p><a href='/recipesbook/login'> Login</a> to view the content</p>
        </div>
    @endguest
    @auth  
    <div class="home-content">
        <h2 class="top">Featured Recipes</h2>
        <div class="main-img">
            @foreach($featuredRecipes as $featuredRecipe)
            <div class="recipe-item">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <!-- Front of the card -->
                        <div class="flip-card-front">
                            <img class="poster" src="{{$featuredRecipe->image}}" alt="{{$featuredRecipe->name}}">
                        </div>
                        <!-- Back of the card -->
                        <div class="flip-card-back">
                            <h3>{{$featuredRecipe->name}}</h3>
                            <a href="/recipesbook/{{ $featuredRecipe->id }}">Click for more Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>                
        <div class="bottom-content">
            <div class="content-list-holder">
                <h2 class="content-heading">Popular</h2>
                <ul class="content-list">
                @foreach($popularRecipes as $popularRecipe)
                    <li class="content-opt"><a class="content-link" href='/recipesbook/{{ $popularRecipe->id }}'>{{$popularRecipe->name}}</a></li>
                @endforeach
                </ul>
            </div>
            <div class="content-list-holder">
                <h2 class="content-heading">Recently Added</h2>
                <ul class="content-list">
                @foreach($newRecipes as $newRecipe)    
                    <li class="content-opt"><a class="content-link" href='/recipesbook/{{ $newRecipe->id }}'>{{$newRecipe->name}}</a></li>
                @endforeach
                </ul>
            </div>
        </div>    
    </div>
    @endauth    
</x-layout>