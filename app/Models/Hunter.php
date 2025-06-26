<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Iluminate\Database\Eloquent\BelongsTo;

class Hunter extends Model
{
      /** @var string $table table used to store the model */
    protected $table = 'hunters';

     /** @var string $primaryKey The primary key associated with the table */
    protected $primaryKey = 'id';

    /** @var array $fillable Attributes that are mass assignable */
    protected $fillable = [
        'playerName',
        'hunterName',
        'campaignId'
    ];

     /**
     * Campaing related to this hunter
     *
     * @return BelongsTo
     **/
    public function campaign(): BelongsTo
    {
        return self::belongsTo(Campaing::class, 'campaignId', 'id');
    }
}
