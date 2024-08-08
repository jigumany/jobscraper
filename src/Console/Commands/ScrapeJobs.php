<?php

namespace Mwds\Jobscraper\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ScrapeJobs extends Command
{
    // The name and signature of the console command
    protected $signature = 'scrape:jobs';

    // The console command description
    protected $description = 'Scrape teaching jobs and save them to the Vacancy table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get configuration values
        $tesUrl = config('jobscraper.tes_url');
        $indeedUrl = config('jobscraper.indeed_url');
        $apiUrl = config('jobscraper.laravel_api_url');

        // Check if configuration values are set
        if (!$tesUrl || !$indeedUrl || !$apiUrl) {
            $this->error('Configuration error: TES URL or API_URL or Indeed URL is missing.');
            $this->error('Please update the config file at ' . config_path('jobscraper.php'));
            return 1;
        }

        // Define the path to the Python script
        $scriptPath = base_path('packages/MWDS/JobScraper/scripts/scrape_jobs.py');
        $configPath = base_path('packages/MWDS/JobScraper/scripts/config.json');

        // Create the config.json file
        $config = [
            'tes_url' => $tesUrl,
            'indeed_url' => $indeedUrl,
            'laravel_api_url' => $apiUrl,
        ];

        file_put_contents($configPath, json_encode($config));

        // Execute the Python script using Symfony Process
        $process = new Process(['python3', $scriptPath]);
        $process->run();

        // Check if the process was successful
        if (!$process->isSuccessful()) {
            $this->error('Error executing Python script:');
            $this->error($process->getErrorOutput());
            throw new ProcessFailedException($process);
        }

        // Output the result
        $this->info($process->getOutput());

        return 0;
    }
}
