<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ResourceType;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'url',
        'author',
        'domain',
        'user_id'
    ];

    protected $casts = [
        'type' => ResourceType::class,
    ];

    /**
     * Get the user that owns the resource.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include resources belonging to the given user.
     */
    public function scopeOwn(Builder $query): Builder
    {
        return $query->where('user_id', Auth::id());
    }

}
