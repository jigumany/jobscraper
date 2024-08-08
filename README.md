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

## Update your .env File

**TES_URL=https://www.tes.com/jobs**
**INDEED_URL=https://www.indeed.com/jobs**
**API_URL=http://your-laravel-app.com/api/jobs**

## Run the scraper:

```bash
php artisan scrape:jobs

```

## Contributing

Contributions are welcome! Please follow these steps to contribute to the project:

1. **Fork the repository.**
2. **Create a new branch:**
   ```bash
   git checkout -b feature-branch
   ```
3. **Commit your changes:**
    ```bash
    git commit -am 'Add some feature'
    ```
4. **Push to the branch:**
    ```bash
    git push origin feature-branch
    ```
5. **Create a new Pull Request**

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

