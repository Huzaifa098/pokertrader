<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $locations = Location::all();

        $admin = auth()->user()->is_admin;

        return view('location.index', [
            'locations' => $locations,
            'admin' => $admin,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('location.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255',],
            'postcode' => ['required', 'string', 'max:255',],
            'street_number' => ['required', 'string', 'max:255',],
            'city' => ['required', 'string', 'max:255',],
            'street' => ['required', 'string', 'max:255',],
        ], [
            'max' => 'Dit veld mag maximaal :max characters lang zijn.',
            'required' => 'Dit veld is verplicht.',
        ]);

        Location::create($request->all());

        return redirect()->route('locations.index')
            ->with('success', 'Locatie success aangemaakt.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('location.edit', [
            'location' => $location,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255',],
            'postcode' => ['required', 'string', 'max:255',],
            'street_number' => ['required', 'string', 'max:255',],
            'city' => ['required', 'string', 'max:255',],
            'street' => ['required', 'string', 'max:255',],
        ], [
            'max' => 'Dit veld mag maximaal :max characters lang zijn.',
            'required' => 'Dit veld is verplicht.',
        ]);

        $location->update($request->all());

        return redirect()->route('locations.index')
            ->with('success', 'Locatie success aangepast.');
    }
}
