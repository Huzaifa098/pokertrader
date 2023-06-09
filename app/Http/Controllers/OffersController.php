<?php

namespace App\Http\Controllers;

use App\Models\offers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = auth()->user()->is_admin;
        $offers = offers::all()->sortByDesc('poke_dollars')->sortBy('euro');

        return view('offers.index', compact('offers', 'admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('offers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'euro' => 'required|numeric|between:0.01,999.99|regex:/^\d+(\.\d{1,2})?$/',
            'poke_dollars' => 'required|integer|between:10,999990',
        ]);

        $pokedollarMin = $request->euro * 1000;
        $pokedollarMax = $pokedollarMin * 1.2;

        if ($request->poke_dollars < $pokedollarMin) {
            return redirect()->route('offers.create')->with('error', 'De minimale aanbieding is ₱1000 per euro');
        }
        if ($request->poke_dollars > $pokedollarMax) {
            return redirect()->route('offers.create')->with('error', 'De maximale aanbieding is ₱1200 per euro');
        }

        offers::create($request->all());

        return redirect()->route('offers.index')->with('success', 'Aanbieding success aangemaakt');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(offers $offers, $id)
    {
        $offers = offers::findOrfail($id);
        return view('offers.edit', compact('offers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, offers $offers, $id)
    {
        $offers = offers::findOrFail($id);

        $request->validate([
            'euro' => 'required|numeric|between:0.01,999.99|regex:/^\d+(\.\d{1,2})?$/',
            'poke_dollars' => 'required|integer|between:10,999990',
        ]);

        $pokedollarMin = $request->euro * 1000;
        $pokedollarMax = $pokedollarMin * 1.2;

        if ($request->poke_dollars < $pokedollarMin) {
            return redirect()->route('offers.edit', $offers)->with('error', 'De minimale aanbieding is ₱1000 per euro');
        }
        if ($request->poke_dollars > $pokedollarMax) {
            return redirect()->route('offers.edit', $offers)->with('error', 'De maximale aanbieding is ₱1200 per euro');
        }

        $offers->update([
            'euro' => $request->euro,
            'poke_dollars' => $request->poke_dollars
        ]);
        return redirect()->route('offers.index')->with('success', 'Aanbieding succesvol bijgewerkt.');
    }

    /**
     * Purchase PokemonDollars.
     */
    public function purchase($id)
    {
        $offer = offers::findOrFail($id);
        $user = User::where('id', Auth::id())->get()->first();

        if ($user->is_admin) {
            return redirect()->route('offers.index')->with('info', 'Admin heeft geen balans');
        }

        $user->update([
            'balance' => $user->balance + $offer->poke_dollars,
        ]);

        return redirect()->route('offers.index')->with('success', 'Aanbieding success besteld');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $offer = offers::find($id);
        $offer->delete();
        return redirect()->route('offers.index')->with('success', 'Aanbieding success verwijderd');
    }
}
