<?php

namespace App\Domain\Core\Models;

use App\Support\Concerns\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FcmToken extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'expires_at' =>  'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
