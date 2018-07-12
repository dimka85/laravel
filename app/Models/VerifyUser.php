<?php

namespace App\Models;

use App\Models\User;
use GeneaLabs\LaravelModelCaching\CachedModel;

/**
 * App\Models\VerifyUser
 *
 * @property int $id
 * @property int $user_id
 * @property string $verification_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\GeneaLabs\LaravelModelCaching\CachedModel disableCache()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VerifyUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VerifyUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VerifyUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VerifyUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\VerifyUser whereVerificationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\GeneaLabs\LaravelModelCaching\CachedModel withCacheCooldownSeconds($seconds)
 * @mixin \Eloquent
 */
class VerifyUser extends CachedModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'verification_token',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'verification_token',
    ];
    
    /**
     * VerifyUser belongs to User relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
