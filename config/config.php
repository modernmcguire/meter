<?php

use ModernMcGuire\Meter\Metrics\FailedJobCount;
use ModernMcGuire\Meter\Metrics\JobCount;
use ModernMcGuire\Meter\Metrics\RequestCount;

/*
 * You can place your custom package configuration in here.
 */
return [

    'enabled' => env('METER_ENABLED', true),

    'metrics' => [
        JobCount::class,
        FailedJobCount::class,
        RequestCount::class,
    ]
];
