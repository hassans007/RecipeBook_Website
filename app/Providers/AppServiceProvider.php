<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('recipesbook/pagination');

        Paginator::defaultSimpleView('recipesbook/pagination');

        Gate::define('edit', function (User $user) {
            return $user->role_id === 2;
        });

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

    }
}
