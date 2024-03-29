<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    

    /**
     * Get all of the event for the Events
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function folow(): HasMany
    {
        return $this->hasMany(EventFolow::class);
    }

      /**
     * Get all of the paticipated for the Events
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paticipated(): HasMany
    {
        return $this->hasMany(EventFolow::class);
    }

    /**
     * Get the assetevent associated with the Events
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function assetevent(): HasOne
    {
        return $this->hasOne(EventsAsset::class, 'events_id');
    }

    

}
