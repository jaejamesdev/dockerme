<?php

namespace JaeJamesDev\DockerMe;

use Illuminate\Support\ServiceProvider;

class DockerMeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->runningInConsole()) {
            $this->commands([
                DockerMeCommand::class
            ]);
        }
    }
}
