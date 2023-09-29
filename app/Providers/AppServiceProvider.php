<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(function (string $model_name) {
            $namespace = 'Database\\Factories\\';
            $model_name = Str::afterLast($model_name, '\\');
            return $namespace . $model_name . 'Factory';
        });

        Password::defaults(function () {
            return Password::min(8)
                           ->letters()
                           ->numbers()
                           ->mixedCase()
                           ->symbols();
        });
    }
}
