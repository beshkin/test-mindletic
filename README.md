# Test Mindletic

This is a repo for tech test.

## Installation
1. Clone the project
2. Install dependencies
```shell
composer install
```
3. Start docker 
```shell
./vendor/bin/sail up -d
```
4. Copy env variables file
```shell
docker exec -it test-mindletic-laravel.test-1 cp /var/www/html/.env.example /var/www/html/.env
```
5.Migrate database
```shell
./vendor/bin/sail artisan migrate
```

Test site is accessible on http://localhost
