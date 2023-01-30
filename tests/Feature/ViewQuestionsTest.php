<?php

namespace Tests\Feature;

use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewQuestionsTest extends TestCase
{
    use RefreshDatabase;
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

    /** @test */
    public function user_can_view_a_single_question()
    {
        // 1. 创建一个问题
        $question = Question::factory()->create([
            'published_at' => Carbon::parse('-1 day')
        ]);
        // 2. 访问链接
        $test = $this->withExceptionHandling()->get('/questions/' . $question->id);
        // 3. 应该看到的问题内容
        $test->assertStatus(200)
            ->assertSee($question->title)
            ->assertSee($question->content);
    }

    /** @test */
    public function user_can_view_a_published_question()
    {
        $question = Question::factory()->create(['published_at' => Carbon::parse('-1 week')]);

        $this->get('/questions/' . $question->id)
            ->assertStatus(200)
            ->assertSee($question->title)
            ->assertSee($question->content);
    }

    /** @test */
    public function user_cannot_view_unpublished_question()
    {
        $question = Question::factory()->create(['published_at' => null]);

        $this->withExceptionHandling()
            ->get('/questions/' . $question->id)
            ->assertStatus(404);
    }

    /** @test */
    public function questions_with_published_at_date_published()
    {
        $question1 = Question::factory()->create([
            'published_at' => Carbon::parse('-1 week')
        ]);
        $question2 = Question::factory()->create([
            'published_at' => Carbon::parse('-1 week')
        ]);
        $unpublishQuestion = Question::factory()->create();

        $publishQuestions = Question::published()->get();

        $this->assertTrue($publishQuestions->contains($question1));
        $this->assertTrue($publishQuestions->contains($question2));
        $this->assertFalse($publishQuestions->contains($unpublishQuestion));
    }
}
