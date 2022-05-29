<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExternalPostSuggestionRequest;
use App\Mail\ExternalPostSuggestedMail;
use App\Models\Enums\ExternalPostStatus;
use App\Models\ExternalPost;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ExternalPostSuggestionController
{
    public function __invoke(ExternalPostSuggestionRequest $request)
    {
        $validated = $request->validated();

        $title = $validated['title'];

        $url = $validated['url'];

        ExternalPost::create([
            'title' => $title,
            'url' => $url,
            'domain' => str_replace('www.', '', parse_url($validated['url'], PHP_URL_HOST)),
            'date' => now(),
            'status' => ExternalPostStatus::PENDING(),
        ]);

        Mail::to('admin@yourblog.com')->send(new ExternalPostSuggestedMail($title, $url));

        flash('Thanks for your suggestion', 'bg-ink text-white');

        return redirect()->action([BlogPostController::class, 'index']);
    }
}
