<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\CachedModel;

/**
 * App\Models\Game
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Searchgame[] $searchgames
 * @method static \Illuminate\Database\Eloquent\Builder|\GeneaLabs\LaravelModelCaching\CachedModel disableCache()
 * @method static \Illuminate\Database\Eloquent\Builder|\GeneaLabs\LaravelModelCaching\CachedModel withCacheCooldownSeconds($seconds)
 * @mixin \Eloquent
 */
class Game extends CachedModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_name',
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
     * Get the searchgames for the game.
     */
    public function searchgames()
    {
        return $this->hasMany(Searchgame::class);
    }
    
    /**
     * Get the game type that owns the game.
     */
    public function gameType()
    {
        return $this->belongsTo(GameType::class);
    }
}
