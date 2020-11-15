<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HouseModel;
use App\Http\Resources\House;

class SearchController extends Controller
{
    public function search (Request $request) {
        $prices = explode(',', $request->price);
        $query = HouseModel::where('price', '>', (int)$prices[0])->where('price', '<', (int)$prices[1]);

        if ($request->name){
            $query->where('name', 'like', '%'.$request->name.'%');
        }
        if ($request->bedrooms){
            $query->where('bedrooms', $request->bedrooms);
        }
        if ($request->garages){
            $query->where('garages', $request->garages);
        }
        if ($request->storeys){
            $query->where('storeys', $request->storeys);
        }

        $result = $query->get();
        
        return House::collection($result);
    }
}
