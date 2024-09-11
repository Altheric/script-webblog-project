<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\ArticlePolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CommentPolicy;
use App\Policies\UserPolicy;

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
        Gate::define('article-store', [ArticlePolicy::class, 'store']);
        Gate::define('article-update', [ArticlePolicy::class, 'update']);
        
        Gate::define('user-login', [UserPolicy::class, 'login']);

        Gate::define('comment-store', [CommentPolicy::class, 'store']);

        Gate::define('category-store', [CategoryPolicy::class, 'store']);
    }
}
