<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // Using class based composers...
        View::composer('Admin/*', 'App\Http\Composers\ActiveMenuComposer');

    }

}
