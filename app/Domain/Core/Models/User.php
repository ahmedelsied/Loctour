<?php

namespace App\Domain\Core\Models;

use App\Domain\Content\Models\Post;
use App\Support\Concerns\HasFactory;
use App\Support\Traits\HasPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasPassword;
    use InteractsWithMedia;

    protected $fillable = ['name', 'phone', 'password', 'username', 'phone_verified_at','status'];

    protected $hidden = ['password', 'remember_token'];

    protected $with = ['media'];

    protected $casts = [
        'status' => 'boolean',
        'owner' => 'boolean',
        'phone_verified_at' => 'datetime'
    ];

    public function fcmTokens(): HasMany
    {
        return $this->hasMany(FcmToken::class);
    }

    public function userPhoneOtp(): HasMany
    {
        return $this->hasMany(UserPhoneOtp::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function getAvatarAttribute()
    {
        return $this->getFirstMediaUrl();
    }
}
