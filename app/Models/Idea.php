<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Idea extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'page', 'time', 'resource_id', 'user_id'];

    public function getTimeAttribute($value)
    {
        if (is_null($value))
            return null;
        return gmdate("i:s", $value);
    }

    public function setTimeAttribute($value)
    {
        if (is_null($value))
            return null;
        if (is_numeric($value)) {
            $this->attributes['time'] = $value;
            return;
        }

        [$minutes, $seconds] = explode(':', $value);
        $this->attributes['time'] = ((int) $minutes * 60) + (int) $seconds;
    }

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

    /**
     * Get the source that owns the Statement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class);
    }

}
