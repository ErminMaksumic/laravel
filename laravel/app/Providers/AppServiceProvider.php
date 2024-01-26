<?php

namespace App\Providers;

use App\Exceptions\ErrorFilter;
use App\Http\Requests\SearchObjects\BaseSearchObject;
use App\Http\Requests\SearchObjects\PaymentSearchObject;
use App\Http\Requests\SearchObjects\RentalCarSearchObject;
use App\Http\Requests\SearchObjects\ReservationSearchObject;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // search objects

        $this->app->bind(RentalCarSearchObject::class, function ($app, $parameters) {
            return new RentalCarSearchObject($parameters);
        });
        $this->app->bind(ReservationSearchObject::class, function ($app, $parameters) {
            return new ReservationSearchObject($parameters);
        });
        $this->app->bind(PaymentSearchObject::class, function ($app, $parameters) {
            return new PaymentSearchObject($parameters);
        });
        $this->app->bind(BaseSearchObject::class, function ($app, $parameters) {
            return new BaseSearchObject($parameters);
        });

        // exception handler

        $this->app->singleton(
            ExceptionHandler::class,
            ErrorFilter::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
