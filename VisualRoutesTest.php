<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VisualRoutesTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_run()
    {
        \Artisan::call('route:list');
        $routes = \Artisan::output();

        $routes = collect(explode("\n", $routes))
            ->filter(function ($route) {
                return !str_contains($route, '_dusk/');
            })->filter(function ($route) {
                return str_contains($route, 'GET');
            })->map(function ($route) {
                $line = explode('|', $route);
                return trim($line[4]);
            });

        $this->browse(function (Browser $browser) use ($routes) {

            foreach ($routes as $route) {

                if (str_contains($route, ['{', '}'])) {
                    $model = str_after($route, '{');
                    $model = str_before($model, '}');
                    $modelClass = ucfirst($model);

                    $modelFactory = "{$modelClass}Factory";
                    $modelFactory = database_path("factories/{$modelFactory}.php");

                    if (file_exists($modelFactory)) {
                        $modelClass = factory("App\\".$modelClass)->create();

                        $id = $modelClass->getRouteKey();

                        $route = str_replace("{{$model}}", $id, $route);
                    } else {
                        // you could comment this out if you want it to run anyway
                        throw new \Exception('Could not find factory for ' . $modelClass . ' on ' . $route);
                    }
                }

                $screenshot_name = str_slug($route);

                // this may or may not be needed for you
                $admin = factory(User::class)->create(['admin'=>true]);

                $browser
                    ->loginAs($admin)
                    ->visit($route)
                    ->screenshot($screenshot_name);
            }
        });
    }
}
