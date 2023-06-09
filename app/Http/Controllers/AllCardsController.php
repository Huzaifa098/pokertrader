<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AllCardsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $cards = Card::all();
        return view('cards.all_cards', compact('cards'));
    }
}
