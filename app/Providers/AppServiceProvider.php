<?php

namespace App\Providers;

use App\Models\Logo;
use App\Models\Settings;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            'Base',
            'Blogs', 'BlogsTranslate',
            'Slides',
            'Footers',
            'Services', 'ServicesTranslate',
            'Introduces', 'IntroducesTranslate',
            'Clients',
            'Feedbacks',
            'Logo',
            'Users',
            'Auth',
            'Products', 'ProductsTranslate', 'ProductsImage'
        ];

        foreach ($repositories as $model) {
            $this->app->bind(
                "App\Repositories\\{$model}\\{$model}RepositoryInterface",
                "App\Repositories\\{$model}\\{$model}EloquentRepository"
            );
        }
    }
}
