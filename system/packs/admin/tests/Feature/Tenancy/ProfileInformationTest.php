<?php

namespace Hotash\Admin\Tests\Feature\Tenancy;

use Hotash\Admin\Models\Admin;
use Tests\RefreshDatabaseWithTenant as RefreshDatabase;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    protected ?string $guard = 'admin';

    public function test_profile_information_can_be_updated()
    {
        $this->actingAs($admin = Admin::factory()->create(), $this->guard);

        $response = $this->put('/user/profile-information', [
            'name' => 'Test Name',
            'email' => 'test@example.com',
        ]);

        $this->assertEquals('Test Name', $admin->fresh()->name);
        $this->assertEquals('test@example.com', $admin->fresh()->email);
    }
}
