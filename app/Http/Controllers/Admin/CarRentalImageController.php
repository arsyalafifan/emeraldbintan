<?php

namespace App\Http\Controllers\Admin;

use App\CarRentalServiceImg;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarRentalImageController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'carrentalserviceid' => 'required|exists:mt_car_rental_services,carrentalserviceid',
                'imgUrl' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'imgDesc' => 'required|string|max:255'
            ]);

            $imagePath = null;
            if ($request->hasFile('imgUrl')) {
                $file = $request->file('imgUrl');
                $filename = time() . '_' . $file->getClientOriginalName();
                $imagePath = $file->storeAs('assets/car-rental', $filename, 'public');
            }

            CarRentalServiceImg::create([
                'carrentalserviceid' => $request->carrentalserviceid,
                'imgUrl' => $imagePath,
                'imgDesc' => $request->imgDesc
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get list of images for a car rental service
     */
    public function list(Request $request)
    {
        try {
            $carrentalserviceid = $request->get('carrentalserviceid');

            $images = CarRentalServiceImg::where('carrentalserviceid', $carrentalserviceid)
                ->get()
                ->map(function($image) {
                    return [
                        'carrentalserviceimgid' => $image->carrentalserviceimgid,
                        'imgUrl' => asset('storage/' . $image->imgUrl),
                        'imgDesc' => $image->imgDesc ?? '-'
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $images
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete an image
     */
    public function destroy($id)
    {
        try {
            $image = CarRentalServiceImg::findOrFail($id);
            
            // Delete from storage
            // if ($image->imgUrl && Storage::disk('public')->exists('storage/' . $image->imgUrl)) {
            //     Storage::disk('public')->delete('storage/' . $image->imgUrl);
            // }

            if (Storage::disk('public')->exists(str_replace('storage/', '', $image->imgUrl))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $image->imgUrl));
            }
            
            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
