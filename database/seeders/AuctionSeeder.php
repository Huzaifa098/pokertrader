<?php

namespace Database\Seeders;

use App\Models\Auction;
use App\Models\Location;
use Illuminate\Database\Seeder;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = Location::all();

        foreach ($locations as $location){
            Auction::factory(random_int(1, 5))
                ->create([
                    'location_id' => $location->id,
                ]);
        }
    }
}
