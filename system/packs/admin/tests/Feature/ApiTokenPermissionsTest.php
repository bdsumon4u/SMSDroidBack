<?php

namespace Hotash\Admin\Tests\Feature;

use Hotash\Admin\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Tests\TestCase;

class ApiTokenPermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected ?string $guard = 'admin';

    public function test_api_token_permissions_can_be_updated()
    {
        if (! Features::hasApiFeatures()) {
            return $this->markTestSkipped('API support is not enabled.');
        }

        $this->actingAs($admin = Admin::factory()->create(), $this->guard);

        $token = $admin->tokens()->create([
            'name' => 'Test Token',
            'token' => Str::random(40),
            'abilities' => ['create', 'read'],
        ]);

        $response = $this->put('/user/api-tokens/'.$token->id, [
            'name' => $token->name,
            'permissions' => [
                'delete',
                'missing-permission',
            ],
        ]);

        $this->assertTrue($admin->fresh()->tokens->first()->can('delete'));
        $this->assertFalse($admin->fresh()->tokens->first()->can('read'));
        $this->assertFalse($admin->fresh()->tokens->first()->can('missing-permission'));
    }
}
