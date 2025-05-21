<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

/**
 * [General] VerifyCsrfToken class
 * @author Marylyn Lajato <marylyn.lajato@diversifyoss.com>
 * @since July 26, 2018
 * @modified Sept 7, 2023
 */
class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     * @var array
     */
    protected $except = [
    		'trainings/module/api/store/*',
    		'oauth/*',
            'webhook/*',
            '/cronjob/attendance-notification/*',
            '/cronjob/attendance-notification-custom/*',
            '/cronjob/hmo-account-status-update/*',
    ];
}
