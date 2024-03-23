<?php

namespace App\Services;

use App\Models\Quiz;
use Exception;
use OpenAI\Laravel\Facades\OpenAI;

class QuestionsService
{
    protected int $numberOfQuestions = 5;
    protected Quiz $quiz;

    protected array $messages = [];
    protected array $questions = [];
    protected bool $isDone = false;

    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * This function is responsible for generating a quiz
     * 1. It should generate the system prompt
     * 2. It should generate the questions
     * 3. It should update the quiz messages in the database
     * 4. It should update the quiz questions in the database
     * 5. It should return itself
     *
     * @return void
     */
    public function generateQuestions(): bool
    {
        try {
            $this->isDone = false;

            $this
                ->setMessages()
                ->getQuestionsFromAI()
                ->saveQuestion();

            $this->isDone = true;

            return true;
        } catch (Exception $e) {
            dump($e->getMessage());
            return false;
        }
    }

    public function done(): bool
    {
        return $this->isDone;
    }


    protected function setMessages(): static
    {
        if(!empty($this->messages)) {
            $this->messages = [];
        }

        $this->setSystemMessage();
        $this->setUserMessage();

        return $this;
    }

    protected function setSystemMessage(): static
    {
        $this->messages[] = [
            'role' => 'system',
            'content' => 'You are a quiz master, who is specialised in creating questions for a quiz.',
        ];

        return $this;
    }

    protected function setUserMessage(): static
    {
        $topic = $this->quiz->topic;

        $userPrompt = <<<EOT
            Generate 5 multiple-choice questions with 4 options per question. Also, provide the correct answer.
            All questions must be for this topic: $topic.

            The questions should be in JSON format, in the following structure:
            {
                "question": "What is the capital of France?",
                "options": {"A": "Paris", "B": "London", "C": "Berlin", "D": "Madrid"},
                "answer": "A"
            }
        EOT;

        $this->messages[] = [
            'role' => 'user',
            'content' => $userPrompt,
        ];

        return $this;
    }

    protected function getQuestionsFromAI(): static
    {
        $response = OpenAI::chat()
            ->create([
                'model' => 'gpt-3.5-turbo-1106',
                'messages' => $this->messages,
                'response_format' => ["type" => "json_object"],
            ])
           ->choices[0]->message->content;

        $message = json_decode($response, true);
        $this->questions = $message['questions'];

        return $this;
    }

    protected function saveQuestion(): static
    {
        foreach($this->questions as $question) {
            $this->quiz->questions()->create([
                'question' => $question['question'],
                'options' => $question['options'],
                'answer' => $question['answer'],
            ]);
        }

        return $this;
    }
}
