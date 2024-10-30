<?php

namespace App\Domain\Content\Models;

use App\Support\Concerns\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function likeable()
    {
        return $this->morphTo();
    }
}
