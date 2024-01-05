<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'image',
        'first_name',
        'last_name',
        'role',
        'phone',
        'organization_name',
        'adresse',
        'county',
        'block',
        'organization_link',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the code associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function code(): HasOne
    {
        return $this->hasOne(User::class, 'foreign_key', 'local_key');
    }



    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany(Events::class);
    }

    /**
     * Get all of the folow for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function folow(): HasMany
    {
        return $this->hasMany(EventFolow::class);
    }


 /**
  * Get all of the userfolow for the User
  *
  * @return \Illuminate\Database\Eloquent\Relations\HasMany
  */
 public function userfolow(): HasMany
 {
     return $this->hasMany(UserFolow::class, 'id_user');
 }



}
