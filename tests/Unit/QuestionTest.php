<?php

namespace Tests\Unit;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_question_has_many_answers()
    {
        $question = Question::factory()->create();

        Answer::factory()->create(['question_id' => $question->id]);

        $this->assertInstanceOf(HasMany::class, $question->answers());
    }

    /** @test  */
    public function questions_with_published_at_date_are_published()
    {
        $publishedQuestion1 = Question::factory()->published()->create();
        $publishedQuestion2 = Question::factory()->published()->create();
        $unpublishedQuestion = Question::factory()->unpublished()->create();

        $publishedQuestions = Question::query()->published()->get();

        $this->assertTrue($publishedQuestions->contains($publishedQuestion1));
        $this->assertTrue($publishedQuestions->contains($publishedQuestion2));
        $this->assertFalse($publishedQuestions->contains($unpublishedQuestion));
    }
}
