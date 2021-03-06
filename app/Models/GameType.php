<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\CachedModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\GameType
 *
 * @property int $id
 * @property string $game_type
 * @property int $min
 * @property int $max
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GameType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GameType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GameType whereGameType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GameType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GameType whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GameType whereMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GameType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GameType onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GameType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GameType withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\GeneaLabs\LaravelModelCaching\CachedModel disableCache()
 * @method static \Illuminate\Database\Eloquent\Builder|
 * \GeneaLabs\LaravelModelCaching\CachedModel withCacheCooldownSeconds($seconds)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Game[] $games
 */
class GameType extends CachedModel
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_type', 'min', 'max',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * Get the games for the game type.
     */
    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
