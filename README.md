# BHH Webshop ITECH 

## Demo .env config
```
APP_NAME="BHH Webshop"
APP_ENV=local
APP_KEY=base64:rqjW9LqPIQoxedjjcZdUt0Aalsk2dIt1Kgz+wWVfv9Y=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5433
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password


## How to make it run

- Run "npm run dev" in one console
- Run "php artisan serve" in another console
- Run "docker compose up -d" in a third console

Or the easy way:

- Run composer run dev
```