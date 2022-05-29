<?php

use App\Http\Controllers\UploadController;
use Illuminate\Http\UploadedFile;
use function Pest\Laravel\post;
use function Spatie\PestPluginTestTime\testTime;

it('can handle an upload', function () {
    testTime()->freeze('2021-01-01 00:00:00');

    Storage::fake('public');

    $file = UploadedFile::fake()->image('test.jpg');

    post(action(UploadController::class), [
        'file' => $file,
    ])
        ->assertSuccessful()
        ->assertSee('uploads/2021-01-01-00-00-00-test.jpg');

    Storage::disk('public')->assertExists('uploads/2021-01-01-00-00-00-test.jpg');
});
