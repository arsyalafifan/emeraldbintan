<?php

namespace App\Http\Controllers\Admin;

use App\Destination;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Requests\Admin\TaxiRequest;
use App\TaxiService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;

class TaxiController extends BaseController
{
    public $page;

    public function __construct()
    {
        $this->page = 'Taxi Service';
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
                $count = TaxiService::count(); // Total records
                $data = TaxiService::select('mt_taxi_services.*', 'mt_destination.destinationName as destinationName', 'mt_destination_from.destinationName as destinationNameFrom')
                    ->leftJoin('mt_destination', 'mt_destination.destinationid', '=', 'mt_taxi_services.destinationid')
                    ->leftJoin('mt_destination as mt_destination_from', 'mt_destination_from.destinationid', '=', 'mt_taxi_services.destinationid_from')
                    ->skip($page)
                    ->take($perpage)
                    ->get();

                return $this->sendResponse([
                    'data' => $data,
                    'recordsTotal' => $count,
                    'recordsFiltered' => $count
                ], 'Taxi Service retrieved successfully.');  
            } 
            // catch (QueryException $e) {
            //     return $this->sendError('SQL Error', $this->getQueryError($e));
            // }
            catch (Exception $e) {
                return $this->sendError('Error', $e->getMessage());
            }
        }

        return view(
            'pages.admin.taxi.index', 
            [
                'page' => $this->page, 
                // 'createbutton' => true, 
                // 'createurl' => route('kelas.create'), 
            ]
        );
    }

    public function create()
    {
        $destinations = Destination::all();
        // dd($destinations);
        return view('pages.admin.taxi.create',[
            'destinations' => $destinations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaxiRequest $request)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($request->title);

        $user = auth()->user();
        $data['addBy'] = $user ? $user->name : 'system';
        TaxiService::create($data);
        return redirect()->route('taxi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $item = TaxiService::findOrFail($id);

        $destinations = Destination::all();

        return view('pages.admin.taxi.edit',[
            'item' => $item,
            'destinations' => $destinations
        ]);
    }

    public function update(TaxiRequest $request, $id)
    {
        $data = $request->all();
        $user = auth()->user();

        $item = TaxiService::findOrFail($id);

        $data['editBy'] = $user ? $user->name : 'system';
        $item->update($data);

        return redirect()->route('taxi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = TaxiService::findorFail($id);
        $item->delete();

        return redirect()->route('taxi.index');
    }
}
