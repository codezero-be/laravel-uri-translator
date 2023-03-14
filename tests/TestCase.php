<?php

namespace CodeZero\UriTranslator\Tests;

use CodeZero\UriTranslator\UriTranslatorServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends  BaseTestCase
{
    /**
     * Get the packages service providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            UriTranslatorServiceProvider::class,
        ];
    }
}
