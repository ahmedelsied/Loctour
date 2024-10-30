<?php

namespace App\Domain\Content\Models;

use App\Support\Concerns\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
