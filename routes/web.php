<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\PokemonApiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/complete-registration', [RegisterController::class, 'completeRegistration'])->name('complete.registration');

// 2fa middleware
Route::middleware(['2fa', 'auth'])->group(function () {

    // HomeController
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('profile', ProfileController::class)->only(['index', 'edit', 'update']);
    Route::get('locations', [LocationController::class, 'index'])->name('locations.index');
    Route::get('auctions/{auction}', [AuctionController::class, 'show'])->name('auctions.show');
    Route::get('offers', [OffersController::class, 'index'])->name('offers.index');

    Route::get('offers/purchase/{id}', [OffersController::class, 'purchase'])->name('offers.purchase');

    // bidder route
    Route::get('bieden/{id}' , [\App\Http\Controllers\BidderController::class, 'bieden'])->name('bieden');

    //my cards route
    Route::get('mijn_kaarten' , \App\Http\Controllers\MyCardsController::class)->name('my_cards');

    //premium routes
    Route::get('premium_kopen', \App\Http\Controllers\PremiumController::class)->name('premium_kopen');
    Route::get('premium_aanschaffen', [\App\Http\Controllers\PremiumController::class, 'premium_buy'])->name('premium_aanschaffen');

    Route::post('/2fa', function () {
        return redirect(route('home'));
    })->name('2fa');

    // Admin routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [HomeController::class, 'admin_home'])->name('admin_home');
        Route::resource('locations', LocationController::class)->except(['show', 'destroy', 'index']);
        Route::resource('auctions', AuctionController::class)->except(['show', 'destroy', 'index', 'create']);
        Route::get('auctions/start_auction/{auction}', [AuctionController::class, 'start_auction'])->name('auctions.start_auction');
        Route::get('auctions/create/{location}', [AuctionController::class, 'create'])->name('auctions.create');
        Route::resource('offers', OffersController::class)->except(['show', 'index']);

        // Pokemon routes
        Route::resource('pokemon', PokemonApiController::class)->only(['create']);
        Route::get('pokemon/store/{id}', [PokemonApiController::class, 'add_card_item'])->name('pokemon.add_card_item');

        // Cards routes
        Route::get('auctions/addCard/{auction}', [AuctionController::class, 'add_card'])->name('auctions.addCard');
        Route::post('auctions/addCard/{auction}', [AuctionController::class, 'add_card_to_auction'])->name('auctions.addCardToAuction');
        Route::get('kaarten' , \App\Http\Controllers\AllCardsController::class)->name('cards');
    });
});
