<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\Storage;

class UploadController
{
    public function __invoke(UploadRequest $request)
    {
        $file = $request->file('file');

        $timestamp = now()->format('Y-m-d-H-i-s');

        $filename = "{$timestamp}-{$file->getClientOriginalName()}";

        Storage::disk('public')->putFileAs("uploads", $file, $filename);

        return parse_url(Storage::disk('public')->url("uploads/{$filename}"), PHP_URL_PATH);
    }
}
