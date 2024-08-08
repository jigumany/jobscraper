<?php

return [

    /*
    |--------------------------------------------------------------------------
    | TES URL
    |--------------------------------------------------------------------------
    |
    | This URL is used to scrape job listings from TES.
    |
    */

    'tes_url' => env('TES_URL', 'https://www.tes.com/jobs/browse/teaching-and-lecturing'),

    /*
    |--------------------------------------------------------------------------
    | Indeed URL
    |--------------------------------------------------------------------------
    |
    | This URL is used to scrape job listings from Indeed.
    |
    */

    'indeed_url' => env('INDEED_URL', 'https://www.indeed.co.uk/Teaching-jobs'),

     /*
    |--------------------------------------------------------------------------
    | API URL
    |--------------------------------------------------------------------------
    |
    | This URL is used to send the jobs to your laravel application.
    |
    */

    'laravel_api_url' => env('API_URL', 'http://localhost:8000/api/jobs'),

];
