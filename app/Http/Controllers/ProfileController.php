<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', Auth::id())->get()->first();
        return view('profile.index', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id', Auth::id())->get()->first();
        return view('profile.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::where('id', Auth::id())->get()->first();
        $request['bank_number'] = strtoupper($request->bank_number);

        $validated = $request->validate([
            'username' => ['required', 'max:30', Rule::unique('users')->ignore($user),],
            'email' => ['required', 'max:30', 'email', Rule::unique('users')->ignore($user),],
            'bank_name' => 'required|max:30|string',
            'bank_number' => ['required', 'string','max:30', 'regex:/^NL\d{2}[A-Z]{4}\d{10}$/'],
        ], [
            'max' => 'Dit veld mag maximaal :max characters lang zijn.',
            'required' => 'Dit veld is verplicht.',
            'email' => 'Dit veld moet een geldig e-mailadres zijn.',
            'username.unique' => 'Deze gebruikersnaam is al in gebruik.',
            'email.unique' => 'Dit e-mailadres is al in gebruik.',
            'bank_number' => 'Banknummer is ongeldig',
        ]);

        if ( $user['username'] != $validated['username'])
        {
            $user['username'] = $validated['username'];
        }

        if ( $user['email'] != $validated['email'])
        {
            $user['email'] = $validated['email'];
        }

        $user['bank_name'] = $validated['bank_name'];
        $user['bank_number'] = $validated['bank_number'];

        $user->save();

        return redirect()->route('profile.index')->with(['success' => 'Profiel succesvol bijgewerkt!']);

    }
}
