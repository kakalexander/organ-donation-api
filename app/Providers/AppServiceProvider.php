<?php

namespace App\Providers;

use App\Interfaces\HospitalRepositoryInterface;
use App\Interfaces\OrgaoRepositoryInterface;
use App\Interfaces\SolicitationRepositoryInterface;
use App\Repositories\HospitalRepository;
use App\Repositories\OrgaoRepository;
use App\Repositories\SolicitationRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(HospitalRepositoryInterface::class, HospitalRepository::class);
        $this->app->bind(SolicitationRepositoryInterface::class, SolicitationRepository::class);
        $this->app->bind(OrgaoRepositoryInterface::class, OrgaoRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}