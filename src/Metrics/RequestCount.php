<?php

namespace ModernMcGuire\Meter\Metrics;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Http\Kernel;
use ModernMcGuire\Meter\Models\Metric;

class RequestCount
{
    protected $metric = 'request_count';

    public function register()
    {
        if(!config('meter.enabled')) {
            return;
        }

        $kernel = resolve(Kernel::class);
        $kernel->appendMiddlewareToGroup('web', self::class);
    }

    public function handle($request, Closure $next)
    {
        // Perform action
        if(!config('meter.enabled')) {
            return $next($request);
        }

        // log it
        Metric::updateOrCreate([
            'metric' => $this->metric,
            'metric_date' => today(),
        ],[
            'value' => DB::raw('value + 1')
        ]);

        return $next($request);
    }
}
