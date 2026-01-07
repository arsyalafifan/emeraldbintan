<?php

namespace App\Http\Controllers;

use App\PackageTravel;
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
    // public function index()
    // {
    //     $items = TravelPackage::with(['galleries'])->get();
    //     return view('pages.home',[
    //         'items' => $items
    //     ]);
    // }

    public function index()
    {
        // $items = DB::table('mt_travel_package as tp')
        //     ->select(
        //         'tp.travelpackageid',
        //         'tp.slug',
        //         'tp.packageTitle',
        //         'tp.packageDesc',
        //         'tp.tourTimeFrom',
        //         'tp.tourTimeTo',
        //         'tp.price',
        //         'tp.isPromo',
        //         'tp.promoPrice',
        //         'tp.isRibbon',
        //         'tp.ribbonText',
        //     )
        //     ->whereNull('tp.deleted_at')
        //     ->get();
        // return view('pages.home',[
        //     'items' => $items
        // ]);

        $items = PackageTravel::with('images', 'destinations', 'includes', 'excludes')
        ->whereNull('deleted_at')
        ->get();

        // dd($items); 

        return view('pages.home', [
            'items' => $items
        ]);
    }
}
