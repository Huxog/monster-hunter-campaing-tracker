<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    /** @use HasFactory<\Database\Factories\CampaignFactory> */
    use HasFactory, SoftDeletes;

    /** @var string table used to store the model */
    protected $table = 'campaigns';

    /** @var string The primary key associated with the table */
    protected $primaryKey = 'id';

    /** @var array Attributes that are mass assignable */
    protected $fillable = [
        'name',
        'team',
        'mapId',
    ];

    /**
     * Map related to this campaign
     *
     **/
    public function map(): BelongsTo
    {
        return self::belongsTo(Map::class, 'mapId', 'id');
    }

    /**
     * Get all of the hunters for the Campaign
     *
     * @return HasMany
     */
    // public function hunters(): HasMany
    // {
    //     return $this->hasMany(Hunter::class);
    // }

}
