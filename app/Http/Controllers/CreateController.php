<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stones;
use App\Models\Minerals;
use App\Models\Territories;
use App\Models\MineralTerritory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CreateController extends Controller
{
    public function createStones(Request $request)
    {
        $stone = new Stones();

        $stone->name = $request->input('name');
        $stone->save();

        return response()->json(Stones::where('id',$stone->id)->first()); 
    }

    public function createTerritories(Request $request)
    {
        $territory = new Territories();

        $territory->name = $request->input('name');
        $territory->save();
        return response()->json(Territories::where('id',$territory->id)->first()); 
    }


    public function createMinerals(Request $request)
    {

        $files = ($_FILES['photos']);
        
        return ($files) ;

        //$i = 0;

//return base_path('storage\app\photo\100');

        for($i = 0;$i<2;$i++)
        {
            $target =base_path('storage/app/photo/100/').$_FILES['photos']['name'][$i];
            move_uploaded_file($_FILES['photos']['tmp_name'][$i], $target);
        }



        return ($files) ;
        Log::info('Request', ['Request' => $request->all()]);

        $mineral = new Minerals();
        

        $minerals = Minerals::all();

        $mineral->name = $request->input('name');
        $mineral->weight = $request->input('weight');
        $mineral->length = $request->input('length');
        $mineral->width = $request->input('width');
        $mineral->height = $request->input('height');
        $mineral->description = $request->input('description');
        $mineral->id_stone = $request->input('stone');
        

        $mineral->save();

         //echo(json_encode($request->file('photos')));

        // move_uploaded_file( $_FILES['names']['8_modem_pool_with_small_and_big_jpg']['tmp_name'], $target);

         //$files = $request->file('photos');
         foreach($files['full_path'] as $path)
         {
           Storage::put("photo/$mineral->id",$path);
         }


        $territories = $request->input('territories');

        foreach($territories as $id_territory)
        {
            $m_t = new MineralTerritory();
            $m_t->id_territory = $id_territory;
            $m_t->id_mineral = $mineral->id;
            $m_t->save();
        }
         

        return response()->json(Minerals::where('id',$mineral->id)->first()); 
    }  

}
