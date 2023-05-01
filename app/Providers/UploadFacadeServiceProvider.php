<?php

namespace App\Providers;

use App\KuHelpers\UploadFacades\Upload;
use Illuminate\Support\ServiceProvider;

class UploadFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        return app()->bind('upload', function() {
            return new Upload();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
