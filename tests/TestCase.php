<?php

declare(strict_types=1);

namespace Hexide\Seo\Tests;

use Hexide\Seo\SeoServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            SeoServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        // config()->set('database.default', 'testing');
    }
}
