<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\View\Components\Header;
use App\View\Components\HeaderLogin;
use App\View\Components\Footer;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('header', Header::class);
        Blade::component('headerLogin', HeaderLogin::class);
        Blade::component('footer',Footer::class);
    }
}
