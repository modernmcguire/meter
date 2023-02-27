<?php

namespace ModernMcGuire\Meter\Metrics;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Queue\Events\JobFailed;
use ModernMcGuire\Meter\Models\Metric;

class FailedJobCount
{
    protected $metric = 'failed_job_count';

    public function register()
    {
        Event::listen(JobFailed::class, FailedJobCount::class);
    }

    public function handle(JobFailed $event)
    {
        Metric::updateOrCreate([
            'metric' => $this->metric,
            'metric_date' => today(),
        ],[
            'value' => DB::raw('value + 1')
        ]);
    }
}
