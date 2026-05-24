<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareAliases = [
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'vendor' => \App\Http\Middleware\VendorMiddleware::class,
        'customers' => \App\Http\Middleware\CustomersMiddleware::class,
    ];
}