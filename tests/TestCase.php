<?php

namespace Dan142\LaravelHashingMySql\Test;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Dan142\LaravelHashingMySql\LaravelHashingMySqlServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelHashingMySqlServiceProvider::class,
        ];
    }
}