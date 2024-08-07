<?php

namespace Mwds\Jobscraper;

use Illuminate\Support\ServiceProvider;
use Mwds\Jobscraper\Console\Commands\ScrapeJobs;

class JobScraperServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish configuration
        $this->publishes([
            __DIR__.'/../config/jobscraper.php' => config_path('jobscraper.php'),
        ], 'config');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/jobscraper.php', 'jobscraper'
        );

        // Register the command
        $this->app->singleton('command.scrape.jobs', function ($app) {
            return new ScrapeJobs();
        });

        $this->commands([
            'command.scrape.jobs',
        ]);
    }
}
