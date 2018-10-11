<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    #### Aqui eu adiciono a rota aqui, e tudo que for pra ca, nao fará a verificação de Csrf
    protected $except = [
        '/rest*'
        , '/cliente*'
    ];
}
