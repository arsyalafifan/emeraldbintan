<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Requests\Admin\PackageStayPriceRequest;
use App\PackageStay;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\PackageStayRequest;
use Facade\Ignition\Support\Packagist\Package;
use App\PackageTravelPrices;
use App\PackageStayImg;
use App\PackageStayIncl;
use App\PackageStayPrice;

class PackageStayController extends BaseController
{
    public $page;

    public function __construct()
    {
        $this->page = 'Package Stay';
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
                $items = PackageStay::all();
                
                $count = PackageStay::count();
                $data = PackageStay::skip($page)->take($perpage)->get();
            } 
            catch (Exception $e) {
                return $this->sendError('Error', $e->getMessage());
            }

            return $this->sendResponse([
                'data' => $data,
                'count' => $count
            ], 'Package retrieved successfully.');  
        }

        return view(
            'pages.admin.package-stay.index', 
            [
                'page' => $this->page,
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

    public function store(PackageStayRequest $request)
    {
        $data = $request->validated();
        // dd($data);

        if (!$data['isRibbon']) {
            $data['ribbonText'] = null;
        }

        $package = PackageStay::create([
            'slug'         => Str::slug($data['stayTitle']),
            'stayTitle' => $data['stayTitle'],
            'stayDesc'  => $data['stayDesc'] ?? null,
            'isRibbon'     => $data['isRibbon'] ?? 0,
            'ribbonText'   => $data['ribbonText'] ?? null,
            'addBy'        => auth()->id(),
        ]);
        return response()->json([
            'success' => true,
            'staypackageid' => $package->staypackageid,
            'message' => 'Paket stay berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(
            PackageStay::findOrFail($id)
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageStayRequest $request, $id)
    {
        PackageStay::where('staypackageid', $id)
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
        PackageStay::where('staypackageid', $id)->delete();

        return redirect()->route('package-stay.index');
    }

    public function getAllPackagePricesById($id)
    {

        $query = PackageStayPrice::where('staypackageid', $id);

        return DataTables::of($query)
            ->addIndexColumn() // DT_RowIndex
            ->make(true);
    }
    public function storePackagePrice(PackageStayPriceRequest $request)
    {
        $data = $request->all();
        $PackageStayPrice = PackageStayPrice::create([
            'staypackageid' => $data['staypackageid'],
            'stayPriceTitle' => $data['stayPriceTitle'] ?? null,
            'price' => $data['price'] ?? null,
            'pricePer' => $data['pricePer'] ?? null,
            'isPromo' => $data['isPromo'] ?? 0,
            'promoPrice' => $data['promoPrice'] ?? null,
            'priceDesc' => $data['priceDesc'] ?? null,
            'addBy' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'staypackagepriceid' => $PackageStayPrice->staypackagepriceid,
            'message' => 'Price berhasil ditambahkan'
        ]);
    }

    public function updatePackagePrice(PackageStayPriceRequest $request, $id)
    {
        $data = $request->all();
        PackageStayPrice::where('staypackagepriceid', $id)
            ->update([
                'staypackageid' => $data['staypackageid'],
                'stayPriceTitle' => $data['stayPriceTitle'] ?? null,
                'price' => $data['price'] ?? null,
                'pricePer' => $data['pricePer'] ?? null,
                'isPromo' => $data['isPromo'] ?? 0,
                'promoPrice' => $data['promoPrice'] ?? null,
                'priceDesc' => $data['priceDesc'] ?? null,
                'editBy' => auth()->id(),
            ]);

        return response()->json(['success' => true]);
    }

    public function deletePackagePrice($id)
    {
        PackageStayPrice::where('staypackagepriceid', $id)->delete();

        return response()->json(['success' => true]);
    }

    public function getAllPackageInclsById($id)
    {
        $query = PackageStayIncl::where('staypackageid', $id)->orderBy('staypackageinclid', 'DESC')->get();

        return DataTables::of($query)
            ->addIndexColumn() // DT_RowIndex
            ->make(true);
    }

    public function storePackageIncl(Request $request)
    {
        $data = $request->all();
        $PackageStayIncl = PackageStayIncl::create($data);

        return response()->json([
            'success' => true,
            'staypackageinclid' => $PackageStayIncl->staypackageinclid,
            'message' => 'Inclusion berhasil ditambahkan'
        ]);
    }

    public function deletePackageIncl($id)
    {
        PackageStayIncl::where('staypackageinclid', $id)->delete();

        return response()->json(['success' => true]);
    }

    public function getAllPackageImageById($id)
    {
        $query = PackageStayImg::where('staypackageid', $id)->orderBy('staypackageimgid', 'DESC')->get();

        return DataTables::of($query)
            ->addIndexColumn() // DT_RowIndex
            ->editColumn('imgUrl', function ($row) {
                    return asset('storage/' . $row->imgUrl);
                })
            ->make(true);
    }

    public function storeImage(Request $request)
    {
        $data = $request->all();
    
        $path = $request->file('image')->store('assets/package-stay-images', 'public');

        $PackageStayImg = PackageStayImg::create([
            'staypackageid' => $request->staypackageid_img,
            'imgUrl' => $path,
            'imgDesc' => $request->imgDesc
        ]);

        return response()->json([
            'success' => true,
            'staypackageimgid' => $PackageStayImg->staypackageimgid,
            'message' => 'Image berhasil ditambahkan'
        ]);
    }

    public function updateImage(Request $request)
    {
        $data = $request->all();
        $image = PackageStayImg::findOrFail($request->staypackageimgid);

        // Hapus file gambar lama dari storage
        if (Storage::disk('public')->exists(str_replace('storage/', '', $image->imgUrl))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $image->imgUrl));
        }

        // Simpan file gambar baru
        $path = $request->file('image')->store('assets/package-stay-images', 'public');

        // Update data gambar di database
        $image->update([
            'imgUrl' => $path,
            'imgDesc' => $request->imgDesc
        ]);

        return response()->json(['success' => true]);
    }

    public function deleteImage($id)
    {
        $image = PackageStayImg::findOrFail($id);

        // Hapus file gambar dari storage
        if (Storage::disk('public')->exists(str_replace('storage/', '', $image->imgUrl))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $image->imgUrl));
        }

        $image->delete();

        return response()->json(['success' => true]);
    }
}
