<?php

namespace App\Models\Games;

use Cloudder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Games\Team
 *
 * @property int $id
 * @property string $name
 * @property string|null $featured_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Team whereFeaturedImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Team whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Games\Player[] $players
 * @property string|null $sport
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Team whereSport($value)
 * @property-read int|null $players_count
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
    public function getLogoFolderName()
    {
        return config('cloudder.folder') . '/uploads/teams/logos/' . $this->id;
    }

    /**
     * @return string
     */
    public function logoUrl()
    {
        return Cloudder::secureShow($this->getLogoPublicId());
    }

    /**
     * @return string
     */
    public function logoThumbnailUrl()
    {
        return Cloudder::secureShow($this->getLogoThumbnailPublicId());
    }

    /**
     * @return string
     */
    public function getLogoPublicId()
    {
        return $this->getLogoFolderName() . '/' . $this->featured_image;
    }

    /**
     * @return string
     */
    public function getLogoThumbnailPublicId()
    {
        return $this->getLogoFolderName() . '/thumb_' . $this->featured_image;
    }
}
