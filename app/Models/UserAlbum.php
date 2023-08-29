<?php

namespace App\Models;

use App\Traits\UuidsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserAlbum extends Model
{
    use HasFactory, UuidsTrait, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function rUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rPhotos(): HasMany
    {
        return $this->hasMany(UserAlbumPhoto::class, 'user_album_id');
    }
}
