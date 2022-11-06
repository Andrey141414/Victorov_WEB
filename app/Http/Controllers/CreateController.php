<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stones;
use App\Models\Minerals;
use App\Models\Territories;
use App\Models\MineralTerritory;

class CreateController extends Controller
{
    public function createStones(Request $request)
    {
        $stone = new Stones();

        $stone->name = $request->input('name');
        $stone->save();

        return response()->json(Stones::all()); 
    }

    public function createTerritories(Request $request)
    {
        $territory = new Territories();

        $territory->name = $request->input('name');
        $territory->save();
        return response()->json(Territories::all()); 
    }


    public function createMinerals(Request $request)
    {


        $mineral = new Minerals();
        

        'territories';
        $minerals = Minerals::all();

        $mineral->name = $request->input('name');
        $mineral->weight = $request->input('weight');
        $mineral->length = $request->input('length');
        $mineral->width = $request->input('width');
        $mineral->height = $request->input('height');
        $mineral->description = $request->input('description');
        $mineral->id_stone = $request->input('stone');
        
        $mineral->save();
        

        $territories = $request->input('territories');

        foreach($territories as $id_territory)
        {
            $m_t = new MineralTerritory();
            $m_t->id_territory = $id_territory;
            $m_t->id_mineral = $mineral->id;
            $m_t->save();
        }
         

        return response()->json(Minerals::all()); 
    }  

}
