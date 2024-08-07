# JobScraper Package

A Laravel package to scrape UK teaching jobs and save to the Vacancy table.

## Installation

You can install the package via Composer:

```bash
composer require mwds/jobscraper

```

# Configuration

## Publish the configuration file:

```bash
php artisan vendor:publish --provider="Mwds\\Jobscraper\\JobScraperServiceProvider" --tag="config"

```

# Usage

## Run the scraper:

```bash
php artisan scrape:jobs

```

## Contributing

Contributions are welcome! Please follow these steps to contribute to the project:

Fork the repository.
Create a new branch (git checkout -b feature-branch).
Commit your changes (git commit -am 'Add some feature').
Push to the branch (git push origin feature-branch).
Create a new Pull Request.

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

