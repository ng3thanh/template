<?php

namespace App\Providers;

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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = ['Base', 'Feedbacks', 'Introduces', 'MenuNews', 'MenuProducts', 'News', 'Products', 'Slides'];

        foreach ($repositories as $value) {
            $this->app->singleton(
                'App/Repositories/' . $value . '/' . $value . 'RepositoryInterface::class',
                'App/Repositories/' . $value . '/' . $value . 'EloquentRepository::class'
            );
        }
    }
}
