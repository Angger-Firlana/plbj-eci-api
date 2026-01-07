<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

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
        //
        Relation::morphMap([
            'lpbj' => \App\Models\Lpbj::class,
            'quotation' => \App\Models\Quotation::class,
            'purchased_order' => \App\Models\PurchasedOrder::class,
        ]);
    }
}
