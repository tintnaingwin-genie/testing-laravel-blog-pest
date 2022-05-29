<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogPostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['string', 'required'],
            'author' => ['string', 'required'],
            'body' => ['string', 'required'],
            'date' => ['date_format:Y-m-d', 'required'],
            'publish' => ['sometimes', 'nullable'],
        ];
    }
}
