<?php

namespace Aldmohy\SpotlayerCheck\Tests;

use Orchestra\Testbench\TestCase;
use Aldmohy\SpotlayerCheck\SpotlayerCheckServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [SpotlayerCheckServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
