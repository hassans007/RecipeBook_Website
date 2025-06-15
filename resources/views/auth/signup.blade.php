<x-layout title="Sign Up">
    <div class="outer-container">
    <div class="credform-container">    
    <h1>Register as New User</h1>
    <p>Already a User?<a href="/recipesbook/login">Log In</a></p>    
    <form method="POST" action="/recipesbook/signupUser">
        @csrf
        <div class="form-field">
            <label for="name" class="label">Name</label>
            <input type="text" id="name" name="name" value='{{old('name')}}'/>
        </div>
        <div class="create-message">
            {{ $errors->first('name') }}
       </div>
        <div class="form-field">
            <label for="email" class="label">Email</label>
            <input type="text" id="email" name="email" value='{{old('email')}}' />
        </div>
        <div class="create-message">
            {{ $errors->first('email') }}
       </div>
        <div class="form-field">
            <label for="password" class="label">Password</label>
            <input type="password" id="password" name="password" value='{{old('password')}}' />
        </div>
        <div class="create-message">
            {{ $errors->first('password') }}
       </div>
        <div class="form-field">
            <input type="Integer" id="role_id" name="role_id"  value=1 hidden/>
        </div>
        <div class="button-container">
            <button type="submit" class="ls">Sign Up</button>
        </div>
    </form>
    </div>
    </div>
</x-layout>