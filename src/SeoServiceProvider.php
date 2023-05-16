<?php

declare(strict_types=1);

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
     */
    public function register(): void
    {
        $this->registerConfig();
        $this->registerFacades();
        $this->registerMiddleware();
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom($this->packagePath('config/config.php'), 'hexide-seo');
    }

    private function registerFacades(): void
    {
        $this->bindFacade('seo-helper', new SeoHelper());

        $this->bindFacade('meta', new Seo());

        $this->bindFacade('microformat', new Microformat());

        $this->bindFacade('scripts', new Script());
    }

    private function registerMiddleware(): void
    {
        $this->app->make(Kernel::class)
            ->prependMiddleware(RedirectMiddleware::class);
    }

    private function bindFacade(string $facadeName, $class): void
    {
        $this->app->bind($facadeName, fn ($app) => $class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
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

    private function loadConfig(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->packagePath('config/config.php') => config_path('hexide-seo.php'),
            ], 'config');
        }
    }

    private function loadTranslations(): void
    {
        $this->loadTranslationsFrom($this->packagePath('resources/lang'), $this->pkgPrefix);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->packagePath('resources/lang') => $this->app->langPath('vendor/' . $this->pkgPrefix),
            ], ['translations', 'assets']);
        }
    }

    private function loadAssets(): void
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

    public function aliasMiddleware(): void
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('redirect', RedirectMiddleware::class);
    }

    public function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                XmlGenerateCommand::class,
            ]);
        }
    }

    public function scheduleCommands(): void
    {
        $this->app->booted(function (): void {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('xml:generate')->everyMinute();
        });
    }

    private function packagePath($path): string
    {
        return __DIR__ . "/../{$path}";
    }
}
