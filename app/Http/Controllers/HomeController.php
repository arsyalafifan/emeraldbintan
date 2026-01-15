<?php

namespace App\Http\Controllers;

use App\PackageTravel;
use Stichoza\GoogleTranslate\TranslateClient;
use App\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $items = PackageTravel::with('images', 'destinations', 'includes', 'excludes')
        ->whereNull('deleted_at')
        ->get();

        // dd(app()->getLocale()); 

        return view('pages.home', [
            'items' => $items
        ]);
    }
}
