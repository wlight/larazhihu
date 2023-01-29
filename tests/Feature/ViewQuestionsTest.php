<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function user_can_view_questions()
    {
        // 1.假设 /questions 路由存在
        // 2.访问链接 /questions
        $test = $this->get('/questions');
        // 3.正常返回 200
        $test->assertStatus(200);
    }
}
