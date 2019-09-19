<?php

namespace App\Models\Games;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Games\Season
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Season newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Season newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Season query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Season whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Season whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Season whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Season whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Season whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $jokers_available
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Season whereJokersAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Season active()
 */
class Season extends Model
{
    protected $fillable = [
        'name', 'is_active', 'jokers_available'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope a query to fetch only the active season
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->first();
    }
}
