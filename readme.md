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

For launching the API locally (it requires PHP - **extension=pdo_mysql** enabled - and Composer installed locally):

* `cd /app`
* Rename the .env.example to .env
* `composer install`
* `php artisan serve`

## How to use the API

Postman must be configured with the following headers:

* `Content-Type: application/json`
* `Accept: application/json`

### Auth related endpoints

`/api/v1/auth`

Used to retrieve the auth token. This endpoint expects a JSON string with the following format:

```javascript
{
    "user_name": "admin_user",
    "password": "123pwd"
}
```
---

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
---

`/api/v1/user/delete/{id}`

This endpoint expects the user's id to be send in the path

---

`/api/v1/user/whoami`

This endpoint returns the current logged user

---
`/api/v1/user/logout`

This endpoint revokes the current logged user's token

### Group related endpoints

`/api/v1/group/add`

This endpoint expects a JSON string with the following format:

```javascript
{
    "group_name": "InterNations cool people"
}
```
---
`/api/v1/group/delete/{id}`

This endpoint expects the group's id to be send in the path

---
`/api/v1/group/{id}/ad/{user_id}`

This endpoint adds a given user to the given group. Both variables must be sent in the PATH

---
`/api/v1/group/{id}/remove/{user_id}`

This endpoint removes a given user to the given group. Both variables must be sent in the PATH

---