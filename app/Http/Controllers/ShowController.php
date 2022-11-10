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

        Storage::disk("local")->makeDirectory('public/'.'IN_GOOD_HANDS/');
        $file = 'C:\Users\andru\OneDrive\Рабочий стол\лабы для пацанов\application\storage\app\public\photo\72\0.jpeg';
        Storage::url($file);

return Storage::url($file);

       // return str_replace("1","2","111222");
        //     array|string $search,
        //     array|string $replace,
        //     string|array $subject,
        //     int &$count = null
        // ): string|array




        // $directory = 'photo/56';
        // Storage::deleteDirectory($directory);

        // return 0;
        
        $files = Storage::disk("local")->allFiles("/photo/57");
        $file = $files[1];
        $file1 = $files[0];
        //Storage::download($files[0]);
        $path1 = str_replace("\\","/",Storage::path($file));
        $path0 = str_replace("\\","/",Storage::path($file1));

        
$arr = [
    response()->file($path0),
    response()->file($path1),
];
return $arr[1];

//return response()->file([$path0,$path1]);
        //return response()->file('C:\Users\andru\OneDrive\Рабочий стол\лабы для пацанов\application\storage\app\photo\58');
        //return "<img src=$file>";
       
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
            'name'      =>$mineral->name,
            'weight'    =>$mineral->weight,
            'length'    =>$mineral->length,
            'width'	    =>$mineral->width,
            'height'    =>$mineral->height,
            'description'=>	$mineral->description,
            'stone_name' => $stone_name,
            
        ]);

        $m_ts = MineralTerritory::where('id_mineral', $mineral->id)->get();


        $photos = Storage::disk("local")->allFiles("public/photo/$mineral->id");

        return Storage::url($photos[0]);
        foreach($photos as $photo)
        {
            $photo =  Storage::path($photo);
            $response['photos'][] = ($photo);
        }
        
        $territories = [];
        foreach($m_ts as $m_t)
        {
            $territory_info = Territories::where('id',$m_t->id_territory)->first();
            $response['territories'][]  = ($territory_info->name);
        }
        return  $response;
    }
}
