<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogPostSlugRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'slug' => ['string', 'required'],
        ];
    }
}
