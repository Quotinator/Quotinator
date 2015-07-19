<?php

namespace Quotinator\Providers;

use Illuminate\Support\ServiceProvider;

class QuoteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Quotinator\Repositories\QuoteRepositoryInterface', 'Quotinator\Repositories\DBQuoteRepository');
    }
}
