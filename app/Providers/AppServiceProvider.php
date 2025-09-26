<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Console\Commands\BackfillResultSemesters;
use App\Console\Commands\BackfillStudentSemester;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                BackfillResultSemesters::class,
                BackfillStudentSemester::class,
            ]);
        }
    }
}
