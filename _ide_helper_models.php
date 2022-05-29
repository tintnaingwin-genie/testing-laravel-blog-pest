<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\BlogPost
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $author
 * @property \Illuminate\Support\Carbon $date
 * @property string $body
 * @property int $likes
 * @property \App\Models\Enums\BlogPostStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\BlogPostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost wherePublished()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereUpdatedAt($value)
 */
	class BlogPost extends \Eloquent implements \Spatie\Feed\Feedable {}
}

namespace App\Models{
/**
 * App\Models\BlogPostLike
 *
 * @property int $id
 * @property string $liker_uuid
 * @property int $blog_post_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPostLike newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPostLike newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPostLike query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPostLike whereBlogPostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPostLike whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPostLike whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPostLike whereLikerUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPostLike whereUpdatedAt($value)
 */
	class BlogPostLike extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ExternalPost
 *
 * @property int $id
 * @property string $url
 * @property string $domain
 * @property string $title
 * @property \Illuminate\Support\Carbon $date
 * @property \App\Models\Enums\ExternalPostStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalPost mostRecent()
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalPost whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalPost whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalPost whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalPost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ExternalPost whereUrl($value)
 */
	class ExternalPost extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Redirect
 *
 * @property int $id
 * @property string $from
 * @property string $to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\RedirectFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect query()
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect whereUpdatedAt($value)
 */
	class Redirect extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

