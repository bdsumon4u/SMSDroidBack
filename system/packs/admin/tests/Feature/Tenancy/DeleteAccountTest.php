<?php

namespace Hotash\Admin\Tests\Feature\Tenancy;

use Hotash\Admin\Models\Admin;
use Tests\RefreshDatabaseWithTenant as RefreshDatabase;
use Laravel\Jetstream\Features;
use Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    use RefreshDatabase;

    protected ?string $guard = 'admin';

    public function test_admin_accounts_can_be_deleted()
    {
        if (! Features::hasAccountDeletionFeatures()) {
            return $this->markTestSkipped('Account deletion is not enabled.');
        }

        $this->actingAs($admin = Admin::factory()->create(), $this->guard);

        $response = $this->delete('/user', [
            'password' => 'password',
        ]);

        $this->assertNull($admin->fresh());
    }

    public function test_correct_password_must_be_provided_before_account_can_be_deleted()
    {
        if (! Features::hasAccountDeletionFeatures()) {
            return $this->markTestSkipped('Account deletion is not enabled.');
        }

        $this->actingAs($admin = Admin::factory()->create(), $this->guard);

        $response = $this->delete('/admin', [
            'password' => 'wrong-password',
        ]);

        $this->assertNotNull($admin->fresh());
    }
}
