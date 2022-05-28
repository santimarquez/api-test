# Internations Test

User and group management API with permission management.

This test has been prepared with the following technology:

* docker containers [bitnami/laravel](https://hub.docker.com/r/bitnami/laravel)
* Laravel 9
* MariaDB

## Models location

As part of the test, a domain and database model has been requested.
The models are located in the 'Documentation' directory.

## How to Install and Run

For launching the API in a docker environment:
* **Initialize containers:** `docker compose up -d`
* **Launch migrations:** `docker exec internations-test-InterNationsApi-1 php artisan migrate`

For launching the API locally:

* `cd /app`
* Rename the .env.example to .env
* `php artisan serve`
## How to use the API