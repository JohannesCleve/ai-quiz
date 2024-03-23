<?php

namespace App\Services;

use App\Models\Quiz;
use Exception;
use OpenAI\Laravel\Facades\OpenAI;

class QuestionsService
{
    protected Quiz $quiz;

    protected array $messages = [];
    protected array $questions = [];

    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function generateQuestions(): bool
    {
        try {
            $this
                ->setMessages()
                ->getQuestionsFromAI()
                ->saveQuestion();

            return true;
        } catch (Exception $e) {
            dump($e->getMessage());
            return false;
        }
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
