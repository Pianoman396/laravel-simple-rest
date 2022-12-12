<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Location
 * @package App\Models
 */
class Location extends Model
{
    use HasFactory;

    protected $fillable = [
      'ip',
      'user_id',
      'coord_x',
      'coord_y'
    ];

    /**
     * @return HasOne
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
