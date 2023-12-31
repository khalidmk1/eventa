<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventFolow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'events_id',
        'confirmed',
        'check'
    ];

    /**
     * Get the event that owns the EventFolow
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Events::class , 'events_id' );
    }

    

}
