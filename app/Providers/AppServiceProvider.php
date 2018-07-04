<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Media;
use App\Skill;
use App\Realisation;
use App\Hobby;

use App\Observers\MediaObserver;
use App\Observers\SkillObserver;
use App\Observers\RealisationObserver;
use App\Observers\HobbyObserver;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
          Media::observe(MediaObserver::class);
          Skill::observe(SkillObserver::class);
          Realisation::observe(RealisationObserver::class);
          Hobby::observe(HobbyObserver::class);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
