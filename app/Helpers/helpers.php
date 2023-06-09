<?php

use App\Models\Auction;
use App\Models\User;
use Carbon\Carbon;

/**
 * Check for ended auctions.
 */

if (!function_exists('EndAuctions')) {
    function endAuctions()
    {
        $auctions = Auction::where('ended', false)->get();

        foreach ($auctions as $auction) {
            $auction->endAuction();
        }
    }
}
