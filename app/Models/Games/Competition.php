<?php

namespace App\Models\Games;

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
        return 'uploads/competitions/logos/' . $this->id;
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
