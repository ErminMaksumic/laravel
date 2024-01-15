<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\RentalCarRepositoryInterface;
use App\Repositories\Interfaces\ReservationRepositoryInterface;
use App\Repositories\RentalCarRepository;
use App\Repositories\ReservationRepository;
use App\Services\Interfaces\RentalCarServiceInterface;
use App\Services\Interfaces\ReservationServiceInterface;
use App\Services\RentalCarService;
use App\Services\ReservationService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // repositories
        $this->app->bind(RentalCarRepositoryInterface::class, RentalCarRepository::class);
        $this->app->bind(ReservationRepositoryInterface::class, ReservationRepository::class);
        // services
        $this->app->bind(RentalCarServiceInterface::class, RentalCarService::class);
        $this->app->bind(ReservationServiceInterface::class, ReservationService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
