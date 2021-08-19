<?php

namespace Aodamuz\Form\Tests;

use Mockery;
use Aodamuz\Form\FormFieldServiceProvider;
use Aodamuz\Armored\ArmoredServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    use Assertion;

    public function tearDown(): void
    {
        Mockery::close();
    }

    protected function getPackageProviders($app)
    {
        return [FormFieldServiceProvider::class];
    }
}
