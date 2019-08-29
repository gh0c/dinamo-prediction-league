<?php

namespace App\Models;

use App\Models\Games\Player;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Team
 *
 * @property int $id
 * @property string $name
 * @property string|null $featured_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereFeaturedImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Games\Player[] $players
 * @property string|null $sport
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereSport($value)
 */
class Team extends Model
{
    protected $fillable = [
        'name', 'sport'
    ];

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    /**
     * @return string
     */
    public function sportName()
    {
        if ($this->sport === 'football') {
            return 'Nogomet';
        } elseif ($this->sport === 'futsal') {
            return 'Futsal';
        } else {
            return '-';
        }
    }

    /**
     * @return string
     */
    public function getLogoFolderName()
    {
        return 'uploads/teams/logos/' . $this->id;
    }

    /**
     * @return string
     */
    public function logoUrl()
    {
        return '/storage/' . $this->getLogoFolderName() . '/' . $this->featured_image;
    }

    /**
     * @return string
     */
    public function logoThumbnailUrl()
    {
        return '/storage/' . $this->getLogoFolderName() . '/thumb_' . $this->featured_image;
    }
}
