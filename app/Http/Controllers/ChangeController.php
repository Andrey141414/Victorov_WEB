<?php

namespace App\Http\Controllers;

use App\Models\Stones;
use App\Models\Minerals;
use App\Models\Territories;
use App\Models\MineralTerritory;
use Illuminate\Http\Request;

class ChangeController extends Controller
{
    public function changeStones(Request $request)
    {
        $id_stone = $request->input('id_stone');
        $stone = Stones::where('id',$id_stone)->first();
        $stone->name = $request->input('name');
        
        $stone->save();

        return response()->json(Stones::all()); 
    }

    public function changeTerritories(Request $request)
    {
        $id_territory = $request->input('id_territory');
        
        $territory = Territories::where('id',$id_territory)->first();
        $territory->name = $request->input('name');
        
        $territory->save();
        return response()->json(Territories::all()); 
    }


    public function changeMinerals(Request $request)
    {

        $id_mineral = $request->input('id_mineral');
        
        $mineral = Minerals::where('id',$id_mineral)->first();
        

        $mineral->name = $request->input('name');
        $mineral->weight = $request->input('weight');
        $mineral->length = $request->input('length');
        $mineral->width = $request->input('width');
        $mineral->height = $request->input('height');
        $mineral->description = $request->input('description');
        $mineral->id_stone = $request->input('stone');
        
        $mineral->save();
        

        $territories = $request->input('territories');

        $mineralsOfTerritory =  MineralTerritory::where('id_mineral',$id_mineral)->get();
        foreach($mineralsOfTerritory as $minerals)
        {
            $mineral->delete();
            $mineral->save();
        }

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