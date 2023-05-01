<?php

namespace App\Providers;

use App\Model\Ecommerce\Api\EcoProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\KuHelpers\Helpers;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::statement(DB::raw('set @rownum=0'));
        View::share('greet', Helpers::greeting());
        View::share('g_products', EcoProduct::paginate(16));

    }
}
