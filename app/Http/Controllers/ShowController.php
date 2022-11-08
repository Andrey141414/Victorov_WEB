<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stones;
use App\Models\Minerals;
use App\Models\MineralTerritory;
use App\Models\Territories;
use Illuminate\Support\Facades\Storage;
class ShowController extends Controller
{
    //
    
    public function test(Request $request)
    {


        
        //$file = $request->file('photo');
        $id_mineral = 1;
        $files = $request->photo;

        return $files;
        //Storage::disk("local")->get('photo/1');
        //return ($file);
        
       // $images = $request->input('images');
        // $photo_id = 1;


        // Storage::disk("local")->makeDirectory($photo_id);
        // //цикл
        // foreach ($images as $key => $data) {
        //     $path = $photo_id.'/'.$key.'.jpeg';
        //     $data = base64_decode($data);

        //     Storage::disk("local")->put('public/'.$path,$data);
        // }
    }
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

    public function getMineral(Request $request)
    {
        $id = $request->input('id_mineral');

        $mineral  = Minerals::where('id',$id)->first();
        
        $stone_name = Stones::where('id',$mineral->id_stone)->first()->name;

        $response['mineral'] = ([
            //'id' => $mineral->id,
            'name'      =>$mineral->name,
            'weight'    =>$mineral->weight,
            'length'    =>$mineral->length,
            'width'	    =>$mineral->width,
            'height'    =>$mineral->height,
            'description'=>	$mineral->description,
            'stone_name' => $stone_name,
            //'id_stone'	=>$mineral->id_stone,
        ]);

        $m_ts = MineralTerritory::where('id_mineral', $mineral->id)->get();

        $territories = [];
        foreach($m_ts as $m_t)
        {
            $territory_info = Territories::where('id',$m_t->id_territory)->first();
            $response['territories'][]  = ($territory_info->name);
        }
        return $response;
    }
}
