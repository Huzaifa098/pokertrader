<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionCard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidderController extends Controller
{
    public function bieden($id)
    {


        $card = AuctionCard::findOrFail($id);

        $auction = $card->auction;


        if (!$card?->user_id) {

            $card->update([
                'highest_bid' => $card->highest_bid + 1000,
                'user_id' => Auth::id(),
            ]);
            return redirect()->back();
        }


        if ($auction->ended) {
            return redirect()->back()->with('error', 'Helaas veiling is verlopen');
        }

        if (Auth::id() == $card->user_id) {
            return redirect()->back()->with('error', 'U kan niet bieden omdat uw bod het hoogste is ');
        }


        $card->update([
            'highest_bid' => $card->highest_bid + 1000,
            'user_id' => Auth::id(),
        ]);


        return redirect()->back();
    }
}
