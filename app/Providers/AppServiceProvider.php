<?php

namespace App\Providers;

use App\Models\User;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Html;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    
        Route::model('user', User::class);
    
        Html::macro('linkWithHtml', function ($url, $html, $attributes = []) {
            $text = '';
            
            foreach ($attributes as $attr => $value) {
                if (!is_int($attr)) {
                    $text .= ' ' . $attr . '="' . $value . '"';
                } else {
                    $text .= ' ' . $value;
                }
            }
            
            return '<a href="' . $url . '"' . $text . '>' . $html . '</a>';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
