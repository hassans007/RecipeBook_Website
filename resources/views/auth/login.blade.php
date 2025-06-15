<x-layout title="Sign In">
    <div class="outer-container">
    <div class="credform-container">    
    <h1>Log In</h1>
    <p>New User?<a href="/recipesbook/signup">Create an account</a></p>     
    <form method="POST" action="/recipesbook/loginUser">
        @csrf
        <div class="form-field">
            <label for="email" class="label">Email</label>
            <input type="text" id="email" name="email" />
        </div>
        <div class="form-field">
            <label for="password" class="label">Password</label>
            <input type="password" id="password" name="password" />
        </div>
        <div class="button-container">
            <button type="submit" class="ls">Sign in</button>
        </div>
    </form>
    </div>
    </div>
</x-layout>