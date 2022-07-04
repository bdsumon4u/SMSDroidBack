<?php

namespace Hotash\Admin\Tests\Feature\Tenancy;

use Hotash\Admin\Models\Admin;
use Tests\RefreshDatabaseWithTenant as RefreshDatabase;
use Tests\TestCase;

class BrowserSessionsTest extends TestCase
{
    use RefreshDatabase;

    protected ?string $guard = 'admin';

    public function test_other_browser_sessions_can_be_logged_out()
    {
        $this->actingAs($admin = Admin::factory()->create(), $this->guard);

        $response = $this->delete('/user/other-browser-sessions', [
            'password' => 'password',
        ]);

        $response->assertSessionHasNoErrors();
    }
}
