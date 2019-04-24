<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /*
 * Defaut display of Carbon dates can be changed using the method
 * This method have to be called BEFORE outputing any date to string
 */

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       // \Carbon\Carbon::setToStringFormat('d-m-Y H:i:s');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


    }
}
