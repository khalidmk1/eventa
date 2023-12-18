<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Events extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'slug',
        'image',
        'video',
        'price',
        'categorie',
        'tags',
        'title',
        'city',
        'adresse',
        'description',
        'programme',
        'date_end',
        'date_start'
       
    ];

    protected $casts = [
        'tags' => 'array',
        'categorie'=>'array',
        'programme'=>'array'
    ];


    /**
     * Get the user that owns the Events
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    

}
