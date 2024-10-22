<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_logout()
    {
        // 创建一个用户
        $user = User::factory()->create();

        // 为用户创建一个令牌
        $token = $user->createToken('test-token')->plainTextToken;

        // 使用令牌发送登出请求
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/logout');

        // 检查响应状态和内容
        $response->assertStatus(200);
        $response->assertJson(['message' => '已成功登出']);

        // 验证令牌已被删除
        $this->assertCount(0, $user->tokens);
    }

    public function test_unauthenticated_user_cannot_logout()
    {
        // 尝试在没有令牌的情况下登出
        $response = $this->postJson('/api/logout');

        // 检查是否返回未认证错误
        $response->assertStatus(401);
    }
}
