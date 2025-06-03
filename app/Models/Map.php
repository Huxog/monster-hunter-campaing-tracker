<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    /** @use HasFactory<\Database\Factories\MapFactory> */
    use HasFactory, SoftDeletes;

    /** @var string $table table used to store the model */
    protected $table = 'maps';

    /** @var string $primaryKey The primary key asosciated with the table */
    protected $primaryKey = 'id';

    /** @var array $fillable Attributes that are mass assignable */
    protected $fillable = [
        'name'
    ];

    /**
     * Campaigns on this maps
     *
     * @return HasMany
     **/
    public function campaings(): HasMany
    {
        return self::hasMany(Campaign::class, 'mapId', 'id');
    }
}
