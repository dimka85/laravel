<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\CachedModel;

/**
 * App\Models\Searchgame
 *
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\GeneaLabs\LaravelModelCaching\CachedModel disableCache()
 * @method static \Illuminate\Database\Eloquent\Builder|\GeneaLabs\LaravelModelCaching\CachedModel withCacheCooldownSeconds($seconds)
 * @mixin \Eloquent
 */
class Searchgame extends CachedModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //
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
     * Searchgame belongs to User relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    /**
     * Get the game that owns the searchgame.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
