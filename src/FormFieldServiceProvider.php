<?php

namespace Aodamuz\Form;

use Illuminate\Support\ServiceProvider;

class FormFieldServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/form.php', 'form');
        $this->registerInputBuilder();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePublishing();
    }

    /**
     * Configure the publishable resources offered by the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        if ($this->app->runningInConsole()) {

        }
    }

    /**
     * Register the input builder instance.
     *
     * @return void
     */
    protected function registerInputBuilder()
    {
        $this->app->singleton('input', function ($app) {
            $input = new Input($app['view'], $app['request']);

            return $input->setSessionStore($app['session.store']);;
        });
    }
}
