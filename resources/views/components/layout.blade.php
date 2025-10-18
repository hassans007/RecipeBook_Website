<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @isset($title)
        {{ $title }} | The RecipeBook
        @else The RecipeBook
        @endisset
    </title>
    <link rel="icon" href="{{ asset('images/icon/main.ico') }}" type="image/x-icon"/>
    {{-- <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css"/> --}}
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a href="/">The<span>RecipeBook</span></a>
        </div>
        <div class="nav-center">
            <div class="nav-box"><a href="/" class="nav-link">Home</a></div>
            @auth
                <div class="nav-box"><a href="/recipesbook/recipesList" class="nav-link">Recipes List</a></div>
                <div class="nav-box"><a href="/recipesbook/savedRecipes" class="nav-link">Saved Recipes</a></div>
                @can('edit')
                <div class="nav-box"><a href="/recipesbook/create" class="nav-link">Add New Recipe</a></div>
                @endcan
            @endauth
            <div class="nav-box"><a href="/recipesbook/about" class="nav-link">About</a></div>
        </div>
        @auth
        <div class="current-user dropdown">
            <p id="dropdown-toggle"><b>{{ Auth::user()->name }}</b> <i class="fas fa-caret-down"></i></p>
            <div class="user-menu" id="user-menu" style="display: none;">
                <form method="POST" action="/recipesbook/logout" style="margin: 0;">
                    @csrf
                    <button type="submit" style="border: none; background: none; padding: 10px 20px; text-align: left; cursor: pointer;">Logout</button>
                </form>
            </div>
        </div>
        @endauth
        @guest
        <form method="GET" action="/recipesbook/login" class="nav-right">
            @csrf
            <button type="submit" class="log">Log In</button>
        </form>
        @endguest
    </nav>
    <div class="header-mobile">
        <div class="desktop-header-wrapper-mobile">
            <div class="header-wrapper-mobile">
                <div class="logo-mobile"><a href="/">The<span>RecipeBook</span></a></div>
                <div class="icon">
                   <div id="closeIcon-mobile" class="menu-icon-mobile hide-mobile">
                        <svg width="15" viewBox="0 0 10 10" fill="none">
                            <path d="M1 1 L9 9" stroke="#fff" stroke-width="2" />
                            <path d="M9 1 L1 9" stroke="#fff" stroke-width="2" />
                        </svg>
                    </div>
                    <div id="openIcon-mobile" class="menu-icon-mobile">
                        <svg width="30px" viewBox="0 0 10 10" fill="none">
                            <path d="M1 1h8 M1 4h8 M1 7h8" stroke="#fff" stroke-width="1" />
                        </svg>
                    </div>
                </div>
            </div>
            <nav>
                <ul id="navList-mobile" class="hide-mobile">
                    <div class="navhidden">
                        <div class="nav-box"><a href="/" class="nav-link">Home</a></div>
                        @auth
                        <div class="nav-box"><a href="/recipesbook/recipesList" class="nav-link">Recipes List</a></div>
                            <div class="nav-box"><a href="/recipesbook/savedRecipes" class="nav-link">Saved Recipes</a></div>
                            @can('edit')
                            <div class="nav-box"><a href="/recipesbook/create" class="nav-link">Add New Recipe</a></div>
                            @endcan
                        @endauth
                        <div class="nav-box"><a href="/recipesbook/about" class="nav-link">About</a></div>
                        @auth
                            <div class="nav-box"><a href="/recipesbook/about" class="nav-link">Logout</a></div>
                        @endauth
                        @guest
                            <form method="GET" action="/recipesbook/login" class="nav-right">
                                @csrf
                                <button type="submit" class="log">Log In</button>
                            </form>
                        @endguest
                    </div>
                </ul>
            </nav>
        </div>
    </div>
    <div class="content">

        @if(session('success'))
        <div id="message" class="success-message">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div id="message" class="success-message">
            {{ session('error') }}
        </div>
        @endif

        {{$slot}}
    </div>
    <script src="{{ asset('js/mobileNav.js') }}" defer></script>
    <script src="{{ asset('js/popUpMessage.js') }}"></script>
    <script src="{{ asset('js/getRecipes.js') }}"></script>
    <script src="{{ asset('js/getUserRecipe.js') }}"></script>
    <script src="{{ asset('js/dropMenu.js') }}"></script>
    <script src="{{ asset('js/activePage.js') }}"></script>
    <script src="{{ asset('js/interactiveButton.js') }}"></script>
    <div class="footer">

        <div class="flogo">
            <a href="/recipesbook">The<span>RecipeBook</span></a>
        </div>

        <div class="footer-nav">
            <div class="fnav-box"><a href="/" class="nav-link">Home</a></div>
            @auth
            <div class="fnav-box"><a href="/recipesbook/recipesList" class="nav-link">Recipes List</a></div>
            @endauth
            <div class="fnav-box"><a href="/recipesbook/about" class="nav-link">About</a></div>
        </div>

    </div>
</body>
</html>
