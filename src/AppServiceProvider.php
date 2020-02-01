<?php

namespace LaravelEnso\ControlPanelApi;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use LaravelEnso\ControlPanelApi\App\Commands\Monitor;
use LaravelEnso\ControlPanelApi\App\Http\Middleware\ResponseMonitor;
use LaravelEnso\ControlPanelApi\App\Services\Actions;
use LaravelEnso\ControlPanelApi\App\Services\Statistics;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        'statistics' => Statistics::class,
        'actions' => Actions::class,
    ];

    public function boot()
    {
        $this->middleware()
            ->command()
            ->loadRoutesFrom(__DIR__.'/routes/api.php');
    }

    private function command(): self
    {
        $this->commands(Monitor::class);

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('enso:control-panel-api:monitor')->everyMinute();
        });

        return $this;
    }

    private function middleware(): self
    {
        $this->app['router']
            ->aliasMiddleware('response-monitor', ResponseMonitor::class);

        return $this;
    }
}
