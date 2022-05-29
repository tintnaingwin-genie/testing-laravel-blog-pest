<?php

namespace App\Models;

use App\Exceptions\BlogPostCouldNotBePublished;
use App\Http\Controllers\BlogPostController;
use App\Jobs\CreateOgImageJob;
use App\Models\Enums\BlogPostStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class BlogPost extends Model implements Feedable
{
    use HasFactory;

    protected $casts = [
        'date' => 'datetime',
        'likes' => 'integer',
        'status' => BlogPostStatus::class,
    ];

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        self::creating(function (BlogPost $post) {
            if (! $post->slug) {
                $post->slug = Str::slug($post->title);
            }
        });

        self::saved(function (BlogPost $post) {
            if ($post->wasRecentlyCreated || $post->wasChanged('title')) {
                dispatch(new CreateOgImageJob($post));
            }
        });
    }

    public function postLikes(): HasMany
    {
        return $this->hasMany(BlogPostLike::class);
    }

    public function isPublished(): bool
    {
        return $this->status->equals(BlogPostStatus::PUBLISHED());
    }

    public function scopeWherePublished(Builder $builder): void
    {
        $builder
            ->where('status', BlogPostStatus::PUBLISHED())
            ->where('date', '<=', now()->toDateTimeString());
    }

    public function publish(): self
    {
        if($this->status === BlogPostStatus::PUBLISHED()) {
            throw BlogPostCouldNotBePublished::make();
        }

        $this->update([
            'status' => BlogPostStatus::PUBLISHED(),
        ]);

        return $this;
    }

    public function isLikedBy(?string $likerUuid): bool
    {
        if ($likerUuid === null) {
            return false;
        }

        return BlogPostLike::query()
            ->where('liker_uuid', $likerUuid)
            ->where('blog_post_id', $this->id)
            ->exists();
    }

    public function addLikeBy(string $likerUuid): self
    {
        BlogPostLike::create([
            'blog_post_id' => $this->id,
            'liker_uuid' => $likerUuid,
        ]);

        $this->likes += 1;

        $this->save();

        return $this;
    }

    public function removeLikeBy(string $likerUuid): void
    {
        BlogPostLike::where([
            'liker_uuid' => $likerUuid,
            'blog_post_id' => $this->id,
        ])->delete();

        $this->likes -= 1;

        $this->save();
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->updated($this->updated_at)
            ->link(action([BlogPostController::class, 'show'], $this->slug))
            ->summary($this->title)
            ->authorName($this->author);
    }

    public static function getFeedItems()
    {
        return self::all();
    }

    public function saveOgImage(string $file)
    {
        Storage::disk('public')->put($this->ogImagePath(), $file);
    }

    public function ogImagePath(): string
    {
        return "blog/{$this->slug}.png";
    }

    public function ogImageUrl(): string
    {
        return Storage::disk('public')->url($this->ogImagePath());
    }
}
