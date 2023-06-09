<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PremiumController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {


        /*    $user = Auth::user();
             $user->update([
                'is_premium' => 1
             ]);*/


        /* return redirect()->route('premium_kopen')->with(['success' => 'je bent premium']);*/

        return view('premium.premium_kopen');

    }

    public function premium_buy()
    {


        $user = Auth::user();
        $user->update([
            'is_premium' => 1
        ]);
        return redirect()->route('premium_kopen')->with(['success' => 'je bent premium']);

    }


}
