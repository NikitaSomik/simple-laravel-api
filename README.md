# Simple Laravel Event API

## Installation

1. Clone the project `git@github.com:NikitaSomik/simple-laravel-api.git`
2. ####Run through docker-compose in root directory project simple-laravel-api
3. Copy .env.example to .env

   ```bash
   cp .env.example .env
   ```

4. Copy .env.testing.example to ..env.testing

   ```bash
   cp .env.example .env
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

11. API Documentation

    ```bash
    http://localhost/docs/api#/
    ```

12. Web UI Supervisor

    ```bash
    http://localhost:9001
    ```

13. Health App

    ```bash
    http://localhost/up
    ```    

14. Run tests

    ```bash
    sail exec -it laravel.test php artisan test
    ```

15. Run Larastan (PHPStan)

    ```bash
    sail exec -it laravel.test composer phpstan
    ```
    
16. Run Laravel Pint
    ```bash
    sail exec -it laravel.test ./vendor/bin/pint
    ```
