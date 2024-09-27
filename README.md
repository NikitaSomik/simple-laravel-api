# Simple Laravel Event API

## Installation

1. Clone the project `git@github.com:NikitaSomik/simple-laravel-api.git`
2. ####Run through docker-compose in root directory project simple-laravel-api
3. Copy .env.example to .env

   ```bash
   cp .env.example .env
   ```

4. Copy .env.testing.example to .env.testing

   ```bash
   cp .env.testing.example .env.testing
   ```

5. Download composer docker image to install dependencies.

   ```bash
   docker run --rm --interactive --tty -v $(pwd):/app composer install
   ```

6. Configure a shell alias that allows you to execute Sail's commands more easily

   ```bash
   alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
   ```

7. Build and run project with **sail in daemon mode**

   ```bash
   sail up -d --build
   ```
8. Generate app key

   ```bash
   sail exec -it laravel.test php artisan key:generate
   ```
9. Create symlinks for storage

   ```bash
   sail exec -it laravel.test php artisan storage:link
   ```
10. Run migrations and seeds

   ```bash
   sail exec -it laravel.test php artisan migrate --seed
   ```

11. Run laravel-worker by supervisorctl

    ```bash
    sail exec -it laravel.test supervisorctl start laravel-worker
    ```

12. API Documentation

    ```bash
    http://localhost/docs/api#/
    ```

13. Web UI Supervisor

    ```bash
    http://localhost:9001
    ```

14. Health App

    ```bash
    http://localhost/up
    ```    

15. Generate IDE Helper File

- `sail exec -it laravel.test php artisan ide-helper:generate` - [PHPDoc generation for Laravel Facades](#automatic-phpdoc-generation-for-laravel-facades)
- `sail exec -it laravel.test php artisan ide-helper:models -M` - [PHPDocs for models](#automatic-phpdocs-for-models)
- `sail exec -it laravel.test php artisan ide-helper:meta` - [PhpStorm Meta file](#phpstorm-meta-for-container-instances)
- `sail exec -it laravel.test php artisan ide-helper:eloquent` - Adds Eloquent, Database\Eloquent\Builder, and Database\Query\Builder to the base model class. This is done right in the vendor directory. This gives a hint to the models that they have all the query builder methods. It is very convenient if you use scope functions.

16. Run tests

    ```bash
    sail exec -it laravel.test php artisan test
    ```

17. Run Larastan (PHPStan)

    ```bash
    sail exec -it laravel.test composer phpstan
    ```

18. Run Laravel Pint

    ```bash
    sail exec -it laravel.test ./vendor/bin/pint
    ```
