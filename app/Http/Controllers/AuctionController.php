<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionCard;
use App\Models\Card;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuctionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Location $location)
    {
        return view('auction.create', [
            'location' => $location,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'location_id' => ['required', 'exists:locations,id'],
            'duration' => ['nullable', 'integer', 'min:1', 'max:100000'],
            'name' => ['required', 'string'],
            'premium' => ['nullable']
        ]);


        $auction = Auction::create($request->all());

        return redirect()->route('auctions.show', $auction)
            ->with('success', 'Veiling aangemaakt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Auction $auction)
    {
        return view('auction.show', [
            'auction' => $auction,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auction $auction)
    {
        if ($auction->start_auction) {
            return redirect()->route('auctions.show', $auction)->with(['error' => 'Deze veiling is al gestart en kan niet meer bewerkt wordt!']);
        }

        return view('auction.edit', [
            'auction' => $auction,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Auction $auction): RedirectResponse
    {
        if ($auction->start_auction) {
            return redirect()->route('auctions.show', $auction)->with(['error' => 'Deze veiling is al gestart en kan niet meer bewerkt wordt!']);
        }

        $request->validate([
            'duration' => ['nullable', 'integer', 'min:1', 'max:100000'],
            'name' => ['required', 'string'],

        ]);

        if (!$request->premium) {
            $request->request->add(['premium' => 0]);
        }


        $auction->update($request->all());

        return redirect()->route('auctions.show', $auction)
            ->with('success', 'Veiling aangepast.');
    }

    public function add_card(Auction $auction)
    {
        if ($auction->start_auction) {
            return redirect()->route('auctions.show', $auction)->with(['error' => 'Deze veiling is al gestart en kan niet meer bewerkt wordt!']);
        }

        $cards = Card::all();
        return view('auction.addcard', ['auction' => $auction, 'cards' => $cards]);
    }

    public function add_card_to_auction(Request $request, Auction $auction): RedirectResponse
    {
        AuctionCard::create([
            'auction_id' => $auction->id,
            'card_id' => $request->card,
        ]);

        return redirect()->route('auctions.show', $auction)->with('success', 'Kaart toegevoegd.');
    }

    public function start_auction(Auction $auction): RedirectResponse
    {
        $this->check_started($auction);

        if (!$auction->duration) {
            return redirect()->route('auctions.start_auction', $auction)->with(['error' => 'De veiling lengte moet ingevuld zijn!']);
        }

        $auction->update([
            'start_auction' => Carbon::now()
        ]);

        return redirect()->route('auctions.show', $auction)->with('info', 'Veiling gestart!.');
    }

    public function check_started(Auction $auction)
    {
        if ($auction->start_auction) {
            return redirect()->route('auctions.show', $auction)->with(['error' => 'Deze veiling is al gestart en kan niet meer bewerkt wordt!']);
        }
    }
}
