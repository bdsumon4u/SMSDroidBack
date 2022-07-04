<?php

namespace Hotash\Admin\Tests\Unit;

use Hotash\Admin\Providers\AdminServiceProvider;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        $this->assertTrue(class_exists(AdminServiceProvider::class));
    }
}
