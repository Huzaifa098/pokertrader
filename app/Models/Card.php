<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    use HasFactory;
    use HasTimestamps;
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Get the auctionCards for the card.
     */
    public function auctionCards(): HasMany
    {
        return $this->hasMany(AuctionCard::class);
    }
}
