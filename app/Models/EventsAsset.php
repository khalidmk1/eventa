<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventsAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'events_id',
        'asset_name'
    ];

  /**
   * Get the event that owns the EventsAsset
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function event(): BelongsTo
  {
      return $this->belongsTo(Events::class);
  }
}
