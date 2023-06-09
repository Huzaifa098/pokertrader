<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuctionCard extends Model
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
     * Check and sell auctionCard.
     */
    public function sellCard()
    {
        if (isset($this->user) && !$this->sold) {
            $user = User::findOrFail($this->user->id);
            $balance = $user->balance;
            $balance = $balance - $this->highest_bid;

            $user->update(['balance' => $balance]);

            $this->update(['sold' => 1]);
        }
    }

    /**
     * Get the auction that owns the auctionCard.
     */
    public function auction(): BelongsTo
    {
        return $this->belongsTo(Auction::class);
    }

    /**
     * Get the card that owns the auctionCard.
     */
    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * Get the user that owns the auctionCard.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
