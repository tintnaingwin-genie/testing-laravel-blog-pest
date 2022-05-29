<?php

namespace App\Models;

use App\Http\Controllers\BlogPostController;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    use HasFactory;

    public $guarded = [];

    public static function createForPost(string $oldSlug, string $newSlug): self
    {
        $oldUrl = parse_url(action([BlogPostController::class, 'show'], $oldSlug))['path'] ?? null;

        $newUrl = parse_url(action([BlogPostController::class, 'show'], $newSlug))['path'] ?? null;

        $newRedirect = self::create([
            'from' => $oldUrl,
            'to' => $newUrl,
        ]);

        if ($exitingRedirect = Redirect::where('from', $newRedirect->to)) {
            $exitingRedirect->delete();
        }

        return $newRedirect;
    }
}
