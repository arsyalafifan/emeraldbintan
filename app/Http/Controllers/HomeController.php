<?php

namespace App\Http\Controllers;

use App\CarRentalService;
use App\Http\Controllers\Admin\TaxiController;
use App\PackageTravel;
use App\TaxiService;
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

    public function index(Request $request)
    {

        $path = $request->path();

        $seo = [
            'title' => 'Emerald Bintan Travel',
            'description' => 'Trusted Bintan tour, taxi, and car rental service',
            'section' => null,
        ];

        if (strpos($path, 'bintan-tour-packages') !== false) {
            $seo = [
                'title' => 'Bintan Tour Packages | Emerald Bintan',
                'description' => 'Best Bintan tour packages including Lagoi, snorkeling and island tours.',
                'section' => 'tour-packages',
            ];
        }

        if (strpos($path, 'bintan-taxi-service') !== false) {
            $seo = [
                'title' => 'Taxi Service in Bintan | Emerald Bintan',
                'description' => 'Affordable private taxi service across Bintan Island.',
                'section' => 'taxi-service',
            ];
        }

        if (strpos($path, 'bintan-car-rental') !== false) {
            $seo = [
                'title' => 'Car Rental in Bintan | Emerald Bintan',
                'description' => 'Daily and hourly car rental in Bintan with professional driver.',
                'section' => 'car-rental',
            ];
        }

        $items = PackageTravel::with('images', 'destinations', 'includes', 'excludes')
        ->whereNull('deleted_at')
        ->get();

        $taxi = TaxiService::all();

        $carRRental = CarRentalService::with('images')->get();

        // dd($taxi);

        return view('pages.home', [
            'items' => $items,
            'taxi' => $taxi,
            'carRental' => $carRRental,
            'seo' => $seo,
        ]);
    }
}
