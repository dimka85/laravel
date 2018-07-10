<?php

namespace App\Models;

use App\Models\User;
use GeneaLabs\LaravelModelCaching\CachedModel;

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
