<?php

namespace App\Providers;

use App\Models\Logo;
use App\Models\Settings;
use Illuminate\Support\Facades\View;
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
        $footer = Settings::all()->groupBy('type');
        $logo = Logo::all()->first();
        View::share('footer', $footer);
        View::share('logo', $logo);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            'Base', 'Blogs', 'Slides', 'Footers', 'Services', 'Introduces', 'Clients', 'Feedbacks',
            'BlogsTranslate', 'ServicesTranslate', 'IntroducesTranslate', 'Logo'
        ];

        foreach ($repositories as $model) {
            $this->app->bind(
                "App\Repositories\\{$model}\\{$model}RepositoryInterface",
                "App\Repositories\\{$model}\\{$model}EloquentRepository"
            );
        }
    }
}
