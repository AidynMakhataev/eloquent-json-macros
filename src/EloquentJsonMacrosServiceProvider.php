<?php

namespace AidynMakhataev\EloquentJsonMacros;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class EloquentJsonMacrosServiceProvider extends ServiceProvider
{
    
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        Collection::make(glob(__DIR__.'/Macros/*.php'))
            ->mapWithKeys(function ($path) {
                return [$path => pathinfo($path, PATHINFO_FILENAME)];
            })
            ->reject(function ($macro) {
                return Collection::hasMacro($macro);
            })
            ->each(function ($macro, $path) {
                require_once $path;
            });
    }

}