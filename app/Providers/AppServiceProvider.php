<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\ArticlePolicy;
use App\Policies\CategoryPolicy;

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
        Gate::define('article-create', [ArticlePolicy::class, 'create']);
        Gate::define('article-update', [ArticlePolicy::class, 'update']);
        
        Gate::define('category-create', [CategoryPolicy::class, 'create']);
    }
}
