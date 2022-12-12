<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Role
 * @package App\Models
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }
}
