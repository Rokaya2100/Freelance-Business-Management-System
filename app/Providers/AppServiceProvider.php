<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // تحديد الـ morphMap هنا
        Relation::morphMap([
            'Freelancer' => User::class,
            'Project' => Project::class,
        ]);

    }
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
    // public function boot(): void
    // {
    //     //
    // }


}
