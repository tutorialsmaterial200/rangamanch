<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function generate(Request $request)
    {
        $prompt = $request->input('prompt');
        $response = Http::withToken(env('AI_API_KEY'))
            ->post('https://api.openai.com/v1/completions', [
                'model' => 'text-davinci-003',
                'prompt' => $prompt,
                'max_tokens' => 500,
            ]);
        return $response->json();
    }
}