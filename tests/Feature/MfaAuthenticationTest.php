<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MfaAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        DB::table('sys_roles')->insert(['name' => 'admin', 'description' => 'System Admin']);
    }

    public function test_can_generate_and_save_two_factor_code(): void
    {
        $user = User::factory()->create();
        
        $this->assertNull($user->two_factor_code);
        
        // Simulate MFA generation that was causing issues earlier due to missing column
        DB::table('users')->where('id', $user->id)->update([
            'two_factor_code' => '123456',
            'two_factor_expires_at' => now()->addMinutes(15),
        ]);
        
        $updatedUser = DB::table('users')->where('id', $user->id)->first();
        
        $this->assertEquals('123456', $updatedUser->two_factor_code);
        $this->assertNotNull($updatedUser->two_factor_expires_at);
    }
}
