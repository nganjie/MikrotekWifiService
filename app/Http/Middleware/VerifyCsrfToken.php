<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Les routes qui doivent être exclues de la vérification CSRF.
     *
     * @var array<int, string>
     */
    protected $except = [
        'payement-gateway/*',  // Ajoute ici les routes que tu veux exclure de la vérification CSRF
    ];
}
