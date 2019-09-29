<?php

namespace App\Models\Games;

use Cloudder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Games\Competition
 *
 * @property int $id
 * @property string $name
 * @property string $sport
 * @property string|null $featured_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Competition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Competition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Competition query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Competition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Competition whereFeaturedImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Competition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Competition whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Competition whereSport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Games\Competition whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Competition extends Model
{
    protected $fillable = [
        'name', 'sport'
    ];

    /**
     * @return string
     */
    public function getLogoFolderName()
    {
        return config('cloudder.folder') . '/uploads/competitions/logos/' . $this->id;
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
