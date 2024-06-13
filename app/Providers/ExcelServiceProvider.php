<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\ExcelServiceProvider as BaseExcelServiceProvider;

class ExcelServiceProvider extends BaseExcelServiceProvider
{
    public function register()
    {
        $this->app->singleton('excel', function ($app) {
            return $app->make('Maatwebsite\Excel\Excel');
        });
    }
}
