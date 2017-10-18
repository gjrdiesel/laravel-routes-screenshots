# laravel-routes-screenshots

Attempts to take screenshots of all your routes in a laravel project using the `php artisan route:list` command and Laravel Dusk.

This sparked [from a question](https://www.reddit.com/r/laravel/comments/76r2ti/any_packages_to_show_all_routes_visually/) on [reddit.com/r/laravel](https://www.reddit.com/r/laravel)

## Limitations

Currently only works with `GET` routes and if a route has route bindings (i.e. /users/{user}) it [tries to find a model](https://github.com/gjrdiesel/laravel-routes-screenshots/blob/85dcad5d15c846eacf43db22b4768daba3b97937/VisualRoutesTest.php#L33-L51) factory based on Laravel 5.5 `php artisan make:factory` structure/naming convention to set up said model in order to properly screenshot the page.

Also in my case, the application is mostly a backend admin application so the test attempts to [create a admin user to login with](https://github.com/gjrdiesel/laravel-routes-screenshots/blob/master/VisualRoutesTest.php#L55-L59) before viewing the pages.

## Requirements

- Laravel
- Laravel Dusk

## Installation

Just copy it to your laravel project, run it, modify it, run it again.

**TLDR;**
```bash
# Go to your Laravel Projects tests/Browser
cd ~/MyAwesomeLaravelProject/tests/Browser

# Download the test file from github
wget https://raw.githubusercontent.com/gjrdiesel/laravel-routes-screenshots/master/VisualRoutesTest.php

# Go back to the project root
cd ~/MyAwesomeLaravelProject

# Run dusk and filter to this test specifically
php artisan dusk --filter VisualRoutesTest
```
