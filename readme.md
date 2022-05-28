# Internations Test

User and group management API with permissions management.
This test has been prepared with the following technologies:

* docker containers [bitnami/laravel](https://hub.docker.com/r/bitnami/laravel)
* Laravel 9 + Sanctum
* MariaDB
* Composer

## Models location

As part of the test, a domain and database model has been requested.
The models are located in the 'Documentation' directory.

## How to Install and Run

For launching the API in a docker environment (it requires Docker installer locally):
* **Initialize containers:** `docker compose up -d`
* **Install dependencies:** `docker exec internations-test-InterNationsApi-1 composer install`
* **Launch migrations:** `docker exec internations-test-InterNationsApi-1 php artisan migrate`

For launching the API locally (it requires PHP - extension=pdo_mysql enabled - and Composer installed locally):

* `cd /app`
* Rename the .env.example to .env
* `composer install`
* `php artisan serve`

## How to use the API

### User related endpoints
`/api/v1/user/add`

This endpoint expects a JSON string with the following format:

```javascript
{
    "id_role": 2,
    "user_name": "admin_user",
    "password": "123pwd",
    "password_confirmation": "123pwd"
}
```
