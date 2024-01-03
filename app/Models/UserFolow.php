<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFolow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'id_user',
        'confirmed'
    ];


    /**
     * Get the user that owns the UserFolow
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class , 'id_user');
    }
}
