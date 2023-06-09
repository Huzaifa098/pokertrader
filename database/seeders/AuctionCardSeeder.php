<?php

namespace Database\Seeders;

use App\Models\Auction;
use App\Models\AuctionCard;
use App\Models\Location;
use Illuminate\Database\Seeder;

class AuctionCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $auctions = Auction::all();

        foreach ($auctions as $auction){
            AuctionCard::factory(random_int(3, 8))
                ->create([
                    'auction_id' => $auction->id,
                ]);
        }
    }
}
