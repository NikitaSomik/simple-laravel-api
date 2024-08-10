# Simple Laravel Event API

## Installation

1. Clone the project `git@github.com:NikitaSomik/simple-laravel-api.git`
2. ####Run through docker-compose in root directory project simple-laravel-api
3. Copy .env.example to .env

   ```bash
   cp .env.example .env
   ```

4. Download composer docker image to install dependencies.

   ```bash
   docker run --rm --interactive --tty -v $(pwd):/app composer install
   ```

5. Configure a shell alias that allows you to execute Sail's commands more easily

   ```bash
   alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
   ```

6. Build and run project with **sail in daemon mode**

   ```bash
   sail up -d --build
   ```

7. Generate app key

   ```bash
   sail exec -it laravel.test php artisan key:generate
   ```

8. Create symlinks for storage

   ```bash
   sail exec -it laravel.test php artisan storage:link
   ```

