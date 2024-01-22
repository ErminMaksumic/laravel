<?php

namespace App\Providers;

use App\Http\Requests\SearchObjects\BaseSearchObject;
use App\Http\Requests\SearchObjects\RentalCarSearchObject;
use App\Http\Requests\SearchObjects\ReservationSearchObject;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RentalCarSearchObject::class, function ($app, $parameters) {
            return new RentalCarSearchObject($parameters);
        });
        $this->app->bind(ReservationSearchObject::class, function ($app, $parameters) {
            return new ReservationSearchObject($parameters);
        });
        $this->app->bind(BaseSearchObject::class, function ($app, $parameters) {
            return new BaseSearchObject($parameters);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
