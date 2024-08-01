<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
class CustomCsrfMiddleware
{
    
    protected $except = [
        'post-type', // Add your route here
    ];
      
     
}
