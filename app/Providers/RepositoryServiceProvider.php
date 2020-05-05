<?php

namespace App\Providers;

use App\Repositories\Family\FamilyRepository;
use App\Repositories\Family\IFamilyRepository;
use App\Repositories\Student\IStudentRepository;
use App\Repositories\Student\StudentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
          IFamilyRepository::class,
          FamilyRepository::class
        );

        $this->app->bind(
          IStudentRepository::class,
          StudentRepository::class
        );

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
