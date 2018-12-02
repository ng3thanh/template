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
            'News', 'NewsTranslate', 'NewsMenu', 'NewsMenuTranslate',
            'Slides',
            'Footers',
            'Services', 'ServicesTranslate',
            'Introduces', 'IntroducesTranslate',
            'Clients',
            'Feedbacks',
            'Logo',
            'Users',
            'Auth',
            'Products', 'ProductsTranslate', 'ProductsImage', 'ProductsMenu', 'ProductsMenuTranslate'
        ];

        foreach ($repositories as $model) {
            $this->app->bind(
                "App\Repositories\\{$model}\\{$model}RepositoryInterface",
                "App\Repositories\\{$model}\\{$model}EloquentRepository"
            );
        }
    }
}
