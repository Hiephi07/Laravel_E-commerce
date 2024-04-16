<?php

namespace App\Providers;

use App\Policies\CategoriesPolicy;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('category-list', [CategoriesPolicy::class, 'view']);

        // Gate::define('category-list', function ($cate) {
        //     return $cate->checkPermissionAsscess("list_categoryy");
        // });
    }
}
