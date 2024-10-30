<?php

namespace App\Domain\Location\Models;

use App\Support\Concerns\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Place extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    protected $guarded = [];
    protected $with = ['media'];
    protected array $translatable = ['name','description','address'];
}
