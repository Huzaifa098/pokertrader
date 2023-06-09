<?php

namespace App\Http\Controllers;

use App\Models\AuctionCard;
use App\Models\Card;
use Database\Seeders\CardSeeder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MyCardsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $admin = auth()->user()->is_admin;

        if ($admin) {
            $cards = AuctionCard::where('sold', true)->get();
        } else {
            $cards = AuctionCard::where('user_id', Auth::user()->id)->where('sold', true)->get();
        }

        return view('cards.my_cards', compact('cards'));
    }
}

