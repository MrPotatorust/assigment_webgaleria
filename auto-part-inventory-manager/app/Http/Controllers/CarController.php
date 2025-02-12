<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\Part;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Redirect;
use Response;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $carSearch = $request->input('car-query');
        $partSearch = $request->input('part-query');

        $cars = Car::when($carSearch, function ($query, $carSearch) {
                    return $query->where('name', 'like', '%' . $carSearch . '%');
                })
                ->when($partSearch, function ($query, $partSearch){
                    return $query->whereHas('parts', function ($subQuery) use ($partSearch) {
                        $subQuery->where('name', 'like', '%' . $partSearch . '%');
                    });
                })
                ->paginate(20)
                ->withQueryString();

        return $request->wantsJson()
            ? response()->json($cars)
            : Inertia::render('Inventory', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'create';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request)
    {   
        
        Car::create($request->validated());

        return redirect(route('inventory.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return $car;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, Car $car)
    {


        $car->update($request->validated());

        return redirect()->route('inventory.index')->with('message', 'Car edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car): RedirectResponse
    {
        // Gate::authorize('delete', $car);

        $car->delete();

        return redirect()->route('inventory.index')->with('message', 'Car deleted successfully.');
    }
}
