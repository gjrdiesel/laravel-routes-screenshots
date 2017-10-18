# laravel-routes-screenshots

Attempts to take screenshots of all your routes in a laravel project using the `php artisan route:list` command and Laravel Dusk.

This sparked [from a question](https://www.reddit.com/r/laravel/comments/76r2ti/any_packages_to_show_all_routes_visually/) on [reddit.com/r/laravel](https://www.reddit.com/r/laravel)

## Limitations

Currently only works with `GET` routes and if a route has route bindings (i.e. /users/{user}) it tries to find a model factory based on Laravel 5.5 `php artisan make:factory` structure/naming convention to set up said model in order to properly screenshot the page.
