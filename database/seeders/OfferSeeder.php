<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\offers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('offers')->insert([
            'euro' => 1,
            'poke_dollars' => 1000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
