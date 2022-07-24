<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VehicleTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        return view('vehicle.index');
    }

    public function getVehicleData(Request $request)
    {
        $vehicles = VehicleType::get();

        return DataTables::collection($vehicles)
            ->addColumn('actions', function ($data) {
                return $this->formActionColumn($data);
            })
            ->rawColumns(['id', 'name', 'actions'])
            ->make(true);
    }

    private function formActionColumn($data)
    {
        $watchRoute = route('vehicle.show', ['vehicle' => $data]);
        $editRoute = route('vehicle.edit', ['vehicle' => $data]);
        $deleteRoute = route('vehicle.destroy', ['vehicle' => $data]);

        if (auth()->user()->hasRole('Admin')) {
            return '<li class="nav-item dropdown list-unstyled">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Actions
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href=" '. $watchRoute . '">
                                      <i class="bi bi-eye"></i> Watch
                                    </a>
                                   <a class="dropdown-item" href=" ' . $editRoute . '">
                                      <i class="bi bi-pencil-fill"></i> Edit
                                   </a>
                                   <form id="logout-form" action=" '. $deleteRoute .'" method="POST" class="dropdown-item">
                                        <input name="_token" type="hidden" value="'. csrf_token() .'"/>
                                        <input type="hidden" name="_method" value="delete" />
                                        <button type="submit" class="delete-button"><i class="bi bi-trash3"></i> Delete</button>
                                    </form>
                                </div>
                            </li>';
        }

        return '<li class="nav-item dropdown list-unstyled">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Actions
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href=" '. $watchRoute . '">
                                      Watch
                                    </a>
                            </li>';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        VehicleType::create([
            'name' => $request->name
        ]);

        return redirect(route('vehicle.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $vehicle = VehicleType::findOrFail($id);

        return view('vehicle.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $vehicle = VehicleType::findOrFail($id);

        return view('vehicle.update', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        VehicleType::find($id)->update([
            'name' => $request->name
        ]);

        return redirect(route('vehicle.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        VehicleType::find($id)->delete();

        return redirect(route('vehicle.index'));
    }
}
