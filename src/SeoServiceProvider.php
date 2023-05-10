<?php

namespace Hexide\Seo;

use Hexide\Seo\Console\XmlGenerateCommand;
use Hexide\Seo\Http\Middleware\RedirectMiddleware;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SeoServiceProvider extends ServiceProvider
{
    private string $pkgPrefix = 'seo';
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerFacades();
        $this->registerMiddleware();
    }

    private function registerConfig()
    {
        $this->mergeConfigFrom($this->packagePath('config/config.php'), 'hexide-seo');
    }

    private function registerFacades()
    {
        $this->bindFacade('seo-helper', new SeoHelper());

        $this->bindFacade('meta', new Seo());

        $this->bindFacade('microformat', new Microformat());

        $this->bindFacade('analytics', new SeoAnalytic());

        $this->bindFacade('scripts', new Script());
    }

    private function registerMiddleware()
    {
        $this->app->make(Kernel::class)
            ->prependMiddleware(RedirectMiddleware::class);
    }

    private function bindFacade(string $facadeName, $class)
    {
        $this->app->bind($facadeName, function ($app) use ($class) {
            return $class;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // if user publishes
        $this->loadConfig();
        $this->loadTranslations();
        $this->loadAssets();
        $this->registerMigrations();
        $this->registerRoutes();
        $this->registerViews();
        $this->aliasMiddleware();
        $this->registerCommands();
        $this->scheduleCommands();
    }

    private function loadConfig()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                $this->packagePath('config/config.php') => config_path('hexide-seo.php'),
            ], 'config');

        }
    }

    private function loadTranslations()
    {
        $this->loadTranslationsFrom($this->packagePath('resources/lang'), $this->pkgPrefix);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->packagePath('resources/lang') => $this->app->langPath('vendor/' . $this->pkgPrefix),
            ], ['translations', 'assets']);
        }
    }

    private function loadAssets()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->packagePath('resources/assets') => public_path('seo'),
            ], 'assets');
        }
    }

    private function registerMigrations(): void
    {
        $this->loadMigrationsFrom($this->packagePath('database/migrations'));
    }

    private function registerRoutes(): void
    {
        Route::group($this->routeConfiguration('web'), function () {
            $this->loadRoutesFrom($this->packagePath('routes/web.php'));
        });
        Route::group($this->routeConfiguration('api'), function () {
            $this->loadRoutesFrom($this->packagePath('routes/api.php'));
        });
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom($this->packagePath('resources/views'), 'seo');



        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->packagePath('resources/views') => resource_path('views/vendor/seo'),
            ], ['views', 'assets']);
        }
    }

    private function routeConfiguration(string $group): array
    {
        $config = [];

        if ($prefix = config("hexide-seo.routes.{$group}.prefix")) {
            $config['prefix'] = $prefix;
        }

        if ($middleware = config("hexide-seo.routes.{$group}.middleware")) {
            $config['middleware'] = $middleware;
        }

        if ($as = config("hexide-seo.routes.{$group}.as")) {
            $config['as'] = $as;
        }

        return $config;
    }

    public function aliasMiddleware()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('redirect', RedirectMiddleware::class);
    }

    public function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                XmlGenerateCommand::class,
            ]);
        }
    }

    public function scheduleCommands()
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('xml:generate')->everyMinute();
        });
    }

    private function packagePath($path): string
    {
        return __DIR__."/../$path";
    }
}
