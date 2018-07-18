<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\CachedModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Role
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\GeneaLabs\LaravelModelCaching\CachedModel disableCache()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|
 * \GeneaLabs\LaravelModelCaching\CachedModel withCacheCooldownSeconds($seconds)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $role_name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereRoleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 * @property int $basic
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereBasic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|
 * \GeneaLabs\LaravelModelCaching\CachedModel withCacheCooldownSeconds($seconds)
 */
class Role extends CachedModel
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_name', 'basic',
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
}
