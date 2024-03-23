<?php

namespace App\Services;

use App\Models\Quiz;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;

class ImageService
{
    protected Quiz $quiz;

    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function visualize(): void
    {
        $topic = $this->quiz->topic;
        $prompt = <<<EOT
            For my AI Quiz app I want you to create an image that represents the topic of the quiz.
            The image will be used as a cover image for the quiz. If the topic is something you are not allowed to show,
            then create something that represents the topic without showing the actual topic.
            The topic of the quiz is: $topic
        EOT;

        $url = OpenAI::images()
            ->create([
                'model' => 'dall-e-3',
                'prompt' => $prompt,
                'size' => '1792x1024'
            ])
            ->data[0]->url;

        $imageData = file_get_contents($url);
        $fileName = Str::random(10) . '.png'; // Generate a random file name
        $filePath = 'public/' . $fileName;

        Storage::put($filePath, $imageData); // Save the image to the public storage path

        $this->quiz->update(['image_path' => $fileName]); // Store the image path in the database
    }
}
