<?php

namespace App\Http\Controllers\Admin;

use App\Destination;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BaseController as BaseController;
use Exception;

class DestinationController extends BaseController
{
    public $page;

    public function __construct()
    {
        $this->page = 'Destination';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = [];
            $count = 0;
            $page = $request->get('start', 0);  
            $perpage = $request->get('length',50);
            try {
                $items = Destination::all();
                
                $count = Destination::count();
                $data = Destination::skip($page)->take($perpage)->get();
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
            ], 'Destination retrieved successfully.');  
        }

        return view(
            'pages.admin.destination.index', 
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
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('pages.admin.destination.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($request->title);

        $user = auth()->user();
        $data['addBy'] = $user ? $user->name : 'system';
        Destination::create($data);
        return redirect()->route('destination.index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $item = Destination::findOrFail($id);

        return view('pages.admin.destination.edit',[
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = auth()->user();

        $item = Destination::findOrFail($id);

        $data['editBy'] = $user ? $user->name : 'system';
        $item->update($data);

        return redirect()->route('destination.index');
    }

    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);

        // cek apakah masih dipakai
        if (
            $destination->packageTravelDestinations()->exists() ||
            $destination->taxiServices()->exists()
        ) {
            return redirect()
                ->back()
                ->with('error', 'Destination tidak dapat dihapus karena masih digunakan di data lain.');
        }

        $destination->delete();

        return redirect()
            ->route('destination.index')
            ->with('success', 'Destination berhasil dihapus.');
        }
}
