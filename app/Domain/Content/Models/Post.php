<?php

namespace App\Domain\Content\Models;

use App\Domain\Core\Models\User;
use App\Domain\Location\Models\Place;
use App\Support\Concerns\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];
    protected $with = ['user','media','place'];

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function toggleLike()
    {
        $userId = auth()->id();

        // Find existing like for the current user
        $liked = $this->likes()->where('user_id', $userId)->exists();

        $liked ?
            $this->likes()->where('user_id', $userId)->delete()
        :
            $this->likes()->create(['user_id' => $userId]);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

}
