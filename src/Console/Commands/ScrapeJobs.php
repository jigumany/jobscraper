<?php

namespace Mwds\Jobscraper\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ScrapeJobs extends Command
{
    protected $signature = 'scrape:jobs';
    protected $description = 'Scrape UK teaching jobs and save to Vacancy table';

    public function handle()
    {
        $scriptPath = base_path('packages/MWDS/JobScraper/scripts/scrape_jobs.py');
        $configPath = base_path('packages/MWDS/JobScraper/scripts/config.json');

        $config = [
            'tes_url' => config('jobscraper.tes_url'),
            'indeed_url' => config('jobscraper.indeed_url'),
        ];

        file_put_contents($configPath, json_encode($config));

        $process = new Process(['python3', $scriptPath]);
        $process->run();

        if (!$process->isSuccessful()) {
            $this->error('Error executing Python script:');
            $this->error($process->getErrorOutput());
            throw new ProcessFailedException($process);
        }

        $this->info($process->getOutput());

        return 0;
    }
}
