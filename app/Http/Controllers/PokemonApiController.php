<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Card;

class PokemonApiController extends Controller
{

    public function create(Request $request)
    {
        if ($request->pokemon ?? false)
        {
            $pokemon = $this->get_pokemon_item($request->pokemon);
            if (is_array($pokemon) ?? false)
            {
                return view('pokemon.create', ['pokemon' => $pokemon]);
            }
        }

        return view('pokemon.create', ['pokemon' => '']);
    }

    /**
     * Insert pokemon item based on id or name to DB::Card
     */
    public function add_card_item($id)
    {
        $pokemon = $this->get_pokemon_item($id);

        $check_exist = Card::where('name', $pokemon['name'])->first();

        if ($check_exist)
        {
            return redirect()->route('pokemon.create')->with(['error' => 'Deze kaart bestaat al!']);
        }

        $create = Card::create([
            'name'=> $pokemon['name'],
            'type'=> $pokemon['type'],
            'image'=> $pokemon['image'],
            'weight' => $pokemon['weight'],
            'length'=> $pokemon['length'],
        ]);

        if($create)
        {
            return redirect()->route('pokemon.create')->with(['success' => 'Kaart toegevoegd!']);
        }

        return view('pokemon.create', [ 'pokemon' => $pokemon]);
    }


    /**
     * Get pokemon item based on id or name and return an array with items
     *
     * @return array id - name - type - image - length - weight
     */
    public static function get_pokemon_item(string $id_or_name)
    {
        $id_or_name = strtolower($id_or_name);
        $url = "https://pokeapi.co/api/v2/pokemon/".$id_or_name;
        $response = Http::get($url);
        $data = $response->json();

        if(!$data)
        {
            return redirect()->route('pokemon.create')->with(['error' => 'Pokemon item not found!']);
        }

        $id  = $data['id'];
        $name = $data['name'];
        $type = $data['types'][0]['type']['name'];
        $image = $data['sprites']['front_default'];
        $length = $data['height'];
        $weight = $data['weight'];

        return [
            'id' => $id,
            'name' => $name,
            'type' => $type,
            'image' => $image,
            'length' => $length,
            'weight' => $weight
        ];
    }



}
