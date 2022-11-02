<?php

namespace App\Providers;

use Livewire\Component;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        // Todo: fix failing jetstream test before enabling
        // Model::shouldBeStrict(! $this->app->isProduction());

        Component::macro('notify', function ($message) {
            $this->dispatchBrowserEvent('notify', $message);
        });
    }
}
