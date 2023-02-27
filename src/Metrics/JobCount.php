<?php

namespace ModernMcGuire\Meter\Metrics;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use ModernMcGuire\Meter\Models\Metric;
use Illuminate\Queue\Events\JobProcessing;

class JobCount
{
    protected $metric = 'job_count';

    public function register()
    {
        Event::listen(JobProcessing::class, JobCount::class);
    }

    public function handle(JobProcessing $event)
    {
        Metric::updateOrCreate([
            'metric' => $this->metric,
            'metric_date' => today(),
        ],[
            'value' => DB::raw('value + 1')
        ]);
    }
}

