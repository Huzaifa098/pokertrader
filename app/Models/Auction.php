<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auction extends Model
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
     * Get the end time for the auction.
     */
    public function getEndTime()
    {
        return Carbon::parse($this->start_auction)
            ->addMinutes($this->duration)
            ->format("d-m-y H:i");
    }

    /**
     * Get the start time for the auction.
     */
    public function getStartTime()
    {
        return Carbon::parse($this->start_auction)->format("d-m-y H:i");
    }

    /**
     * Check and set end of auction.
     */
    public function endAuction()
    {
        if (isset($this->start_auction) && !$this->ended) {
            $end_time = Carbon::parse($this->start_auction)
                ->addMinutes($this->duration);

            if ($end_time <= now()) {
                foreach ($this->auctionCards as $auction_card) {
                    $auction_card->sellCard();
                }

                $this->update(['ended' => 1]);
            }
        }
    }

    /**
     * Get the location that owns the auction.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the auctionCards for the auction.
     */
    public function auctionCards(): HasMany
    {
        return $this->hasMany(AuctionCard::class);
    }
}
