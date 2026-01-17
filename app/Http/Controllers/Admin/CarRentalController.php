<?php

namespace App\Http\Controllers\Admin;

use App\CarRentalService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Requests\Admin\CarRentalRequest;

class CarRentalController extends BaseController
{

    public $page;

    public function __construct()
    {
        $this->page = 'Car Rental Service';
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
                $items = CarRentalService::all();
                
                $count = CarRentalService::count();
                $data = CarRentalService::skip($page)->take($perpage)->get();
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
            ], 'Car Rental Service retrieved successfully.');  
        }

        return view(
            'pages.admin.car-rental.index', 
            [
                'page' => $this->page, 
                // 'createbutton' => true, 
                // 'createurl' => route('kelas.create'), 
            ]
        );
    }

    public function create()
    {
        return view('pages.admin.car-rental.create');
    }

    public function store(CarRentalRequest $request)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($request->title);

        $user = auth()->user();
        $data['addBy'] = $user ? $user->name : 'system';
        CarRentalService::create($data);
        return redirect()->route('car-rental.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $item = CarRentalService::findOrFail($id);

        return view('pages.admin.car-rental.edit',[
            'item' => $item
        ]);
    }

    public function update(CarRentalRequest $request, $id)
    {
        $data = $request->all();
        $user = auth()->user();

        $item = CarRentalService::findOrFail($id);

        $data['editBy'] = $user ? $user->name : 'system';
        $item->update($data);

        return redirect()->route('car-rental.index');
    }

    public function destroy($id)
    {
        $item = CarRentalService::findorFail($id);
        $item->delete();

        return redirect()->route('car-rental.index');
    }
}
