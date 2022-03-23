<?php

namespace App\Http\Controllers;

use App\Models\Brewery;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InfiniteScrollController extends Controller
{
    public function index(Request $request)
    {

        $searchinf = $request->get('searchInf');

        $query = Brewery::has('beers', '>', 0)->withCount('beers');

        if ($searchinf){
            $query->where('name', 'like', '%'. $searchinf . '%');
        }

    
        $breweries = $query->paginate(30);

        if ($request->wantsJson()) {
            return $breweries;
        }

        
        return Inertia::render('InfiniteScroll', ['breweries' => $breweries]);
    }
}
