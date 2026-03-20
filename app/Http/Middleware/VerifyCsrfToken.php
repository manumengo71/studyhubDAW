<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'createLessonStep1/{id}',
        'createLessonStep2/{id}',
        'storeLessonStep1/{id}',
        'storeLessonStep2/{id}',
        'post-media/*',
    ];
}
