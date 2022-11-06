<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stones;
use App\Models\Minerals;
use App\Models\Territories;

class ShowController extends Controller
{
    //
    public function allStones()
    {
        return response()->json(Stones::all()); 
    }

    public function allTerritories()
    {
        return response()->json(Territories::all()); 
    }


    public function allMinerals()
    {
        $minerals = Minerals::all();

        $response = [];

        foreach( $minerals as $mineral )
        {
            $stone_name = Stones::where('id',$mineral->id_stone)->first()->name;
            $response[] = ([
                'id' => $mineral->id,
                'name'      =>$mineral->name,
                'weight'    =>$mineral->weight,
                'length'    =>$mineral->length,
                'width'	    =>$mineral->width,
                'height'    =>$mineral->height,
                'description'=>	$mineral->description,
                'stone_name' => $stone_name,
                'id_stone'	=>$mineral->id_stone,
            ]);
            
        }
        return $response; 
    }
}
