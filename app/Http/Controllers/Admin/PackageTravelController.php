<?php

namespace App\Http\Controllers\Admin;

use App\Destination;
use App\Http\Controllers\Controller;
use App\PackageTravel;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PackageTravelRequest;
use App\Http\Requests\Admin\PackageTravelPriceRequest;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BaseController as BaseController;
use App\PackageTravelDest;
use App\PackageTravelExcl;
use App\PackageTravelImg;
use App\PackageTravelIncl;
use App\PackageTravelPrices;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;

class PackageTravelController extends BaseController
{
    public $page;

    public function __construct()
    {
        $this->page = 'Package Travel';
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = [];
            $count = 0;
            $page = $request->get('start', 0);  
            $perpage = $request->get('length',50);
            try {
                $items = PackageTravel::all();
                
                $count = PackageTravel::count();
                $data = PackageTravel::skip($page)->take($perpage)->get();
            } 
            catch (QueryException $e) {
                return $this->sendError('SQL Error', $this->getQueryError($e));
            }
            catch (Exception $e) {
                return $this->sendError('Error', $e->getMessage());
            }

            return $this->sendResponse([
                'data' => $data,
                'count' => $count
            ], 'Package retrieved successfully.');  
        }
        $destinations = Destination::all();

        return view(
            'pages.admin.package-travel.index', 
            [
                'page' => $this->page, 
                'destinations' => $destinations,
                // 'createbutton' => true, 
                // 'createurl' => route('kelas.create'), 
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(PackageTravelRequest $request)
    {
        $data = $request->validated();
        // dd($data);

        // Pastikan data konsisten
        if (!$data['isPromo']) {
            $data['promoPrice'] = null;
        }

        if (!$data['isRibbon']) {
            $data['ribbonText'] = null;
        }

        $package = PackageTravel::create([
            'slug'         => Str::slug($data['packageTitle']),
            'packageTitle' => $data['packageTitle'],
            'packageDesc'  => $data['packageDesc'] ?? null, // ✅ FIX
            'tourTimeFrom' => $data['tourTimeFrom'] ?? null,
            'tourTimeTo'   => $data['tourTimeTo'] ?? null,
            'price'        => $data['price'],
            'isPromo'      => $data['isPromo'] ?? 0,
            'promoPrice'   => $data['promoPrice'] ?? null,
            'isRibbon'     => $data['isRibbon'] ?? 0,
            'ribbonText'   => $data['ribbonText'] ?? null,
            'addBy'        => auth()->id(),
        ]);
        return response()->json([
            'success' => true,
            'travelpackageid' => $package->travelpackageid,
            'message' => 'Paket travel berhasil ditambahkan'
        ]);
    }

    public function show($id)
    {
        return response()->json(
            PackageTravel::findOrFail($id)
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(PackageTravelRequest $request, $id)
    {
        PackageTravel::where('travelpackageid', $id)
        ->update($request->validated());

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getPackageDestById($id)
    {
        // $package = PackageTravelDest::where('travelpackageid', $id)
        // ->with('destination')
        // ->get();
        // if (!$package) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Paket travel dest tidak ditemukan'
        //     ], 404);
        // }

        // return response()->json([
        //     'success' => true,
        //     'data' => $package
        // ]);

        $query = PackageTravelDest::with('destination')
        ->where('travelpackageid', $id);

        return DataTables::of($query)
            ->addIndexColumn() // DT_RowIndex
            ->make(true);
    }

    public function getAllPackagePricesById($id)
    {
        $query = PackageTravelPrices::where('travelpackageid', $id)->orderBy('priceSeq', 'asc');

        return DataTables::of($query)
            ->addIndexColumn() // DT_RowIndex
            ->make(true);
    }

    public function getPackageImageById($id)
    {
        // $package = PackageTravelImg::where('travelpackageid', $id)->get();
        // if (!$package) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Paket travel image tidak ditemukan'
        //     ], 404);
        // }

        // return response()->json([
        //     'success' => true,
        //     'data' => $package
        // ]);
        $query = PackageTravelImg::where('travelpackageid', $id);
        return DataTables::of($query)
            ->addIndexColumn() // DT_RowIndex
                ->editColumn('imgUrl', function ($row) {
                    return asset('storage/' . $row->imgUrl);
                })
            ->make(true);
    }

    public function getPackageInclById($id)
    {
        // $package = PackageTravelIncl::where('travelpackageid', $id)->get();
        // if (!$package) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Paket travel tidak ditemukan'
        //     ], 404);
        // }

        // return response()->json([
        //     'success' => true,
        //     'data' => $package
        // ]);
        $query = PackageTravelIncl::where('travelpackageid', $id);
        return DataTables::of($query)
            ->addIndexColumn() // DT_RowIndex
            ->make(true);
    }

    public function getPackageExclById($id)
    {
        // $package = PackageTravelExcl::where('travelpackageid', $id)
        //     ->get();
        // if (!$package) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Paket travel tidak ditemukan'
        //     ], 404);
        // }

        // return response()->json([
        //     'success' => true,
        //     'data' => $package
        // ]);
        $query = PackageTravelExcl::where('travelpackageid', $id);
        return DataTables::of($query)
            ->addIndexColumn() // DT_RowIndex
            ->make(true);
    }

    public function storePackageDest(Request $request)
    {
        $data = $request->all();

        $packageDest = PackageTravelDest::create([
            'travelpackageid' => $data['travelpackageid'],
            'destinationid'   => $data['destinationid'],
            'addBy'           => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'travelpackagedestid' => $packageDest->travelpackagedestid,
            'message' => 'Destination berhasil ditambahkan'
        ]);
    }
    public function deletePackageDest($id)
    {
        PackageTravelDest::where('travelpackagedestid', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Destination berhasil dihapus'
        ]);
    }

    public function storePackagePrice(PackageTravelPriceRequest $request)
    {
        $data = $request->all();

        $packagePrice = PackageTravelPrices::create([
            'travelpackageid'   => $data['travelpackageid'],
            'packagePriceTitle' => $data['packagePriceTitle'],
            'price'             => $data['price'],
            'pricePer'          => $data['pricePer'] ?? null,
            'isPromo'           => $data['isPromo'] ?? 0,
            'promoPrice'        => $data['promoPrice'] ?? null,
            'priceDesc'         => $data['priceDesc'] ?? null,
            'addBy'             => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'travelpackagepriceid' => $packagePrice->travelpackagepriceid,
            'message' => 'Price berhasil ditambahkan'
        ]);
    }

    public function updatePackagePrice(PackageTravelPriceRequest $request, $id)
    {
        $data = $request->all();

        PackageTravelPrices::where('travelpackagepriceid', $id)
        ->update([
            'packagePriceTitle' => $data['packagePriceTitle'],
            'price'             => $data['price'],
            'pricePer'          => $data['pricePer'] ?? null,
            'isPromo'           => $data['isPromo'] ?? 0,
            'promoPrice'        => $data['promoPrice'] ?? null,
            'priceDesc'         => $data['priceDesc'] ?? null,
            'editBy'            => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Price berhasil diupdate'
        ]);
    }

    public function deletePackagePrice($id)
    {
        PackageTravelPrices::where('travelpackagepriceid', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Price berhasil dihapus'
        ]);
    }

    public function storeImage(Request $request)
    {
        $request->validate([
            'travelpackageid_img' => 'required',
            'image' => 'required|image|max:2048'
        ]);

        $path = $request->file('image')->store('assets/package', 'public');

        PackageTravelImg::create([
            'travelpackageid' => $request->travelpackageid_img,
            'imgUrl' => $path,
            'imgDesc' => $request->imgDesc
        ]);

        return response()->json(['success' => true]);
    }

    public function updateImage(Request $request)
    {
        $img = PackageTravelImg::findOrFail($request->travelpackageimgid);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete(str_replace('storage/', '', $img->imgUrl));
            $path = $request->file('image')->store('assets/package', 'public');
            $img->imgUrl = $path;
        }

        $img->imgDesc = $request->imgDesc;
        $img->save();

        return response()->json(['success' => true]);
    }


    public function deleteImage($id)
    {
        $image = PackageTravelImg::findOrFail($id);

        // Hapus file gambar dari storage
        if (Storage::disk('public')->exists(str_replace('storage/', '', $image->imgUrl))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $image->imgUrl));
        }

        $image->delete();

        return response()->json(['success' => true]);
    }

    public function storePackageIncl(Request $request)
    {
        $data = $request->all();

        $packageDest = PackageTravelIncl::create([
            'travelpackageid' => $data['travelpackageid'],
            'includeText'   => $data['includeText'],
            'addBy'           => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'travelpackageinclid' => $packageDest->travelpackageinclid,
            'message' => 'Include berhasil ditambahkan'
        ]);
    }
    public function deletePackageIncl($id)
    {
        PackageTravelIncl::where('travelpackageinclid', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Destination berhasil dihapus'
        ]);
    }

    public function storePackageExcl(Request $request)
    {
        $data = $request->all();

        $packageDest = PackageTravelExcl::create([
            'travelpackageid' => $data['travelpackageid'],
            'excludeText'   => $data['excludeText'],
            'addBy'           => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'travelpackageexclid' => $packageDest->travelpackageexclid,
            'message' => 'Exclude berhasil ditambahkan'
        ]);
    }
    public function deletePackageExcl($id)
    {
        PackageTravelExcl::where('travelpackageexclid', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Destination berhasil dihapus'
        ]);
    }
}
