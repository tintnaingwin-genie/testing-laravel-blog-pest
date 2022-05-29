<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublishBlogPostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'publish' => ['sometimes', 'nullable'],
        ];
    }
}
