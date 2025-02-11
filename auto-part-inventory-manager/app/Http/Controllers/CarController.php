<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
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
        // dd($search);


        $cars = Car::when($carSearch, function ($query, $carSearch) {
                    return $query->where('name', 'like', '%' . $carSearch . '%');
                })
                ->when($partSearch, function ($query, $partSearch){
                    return $query->whereHas('parts', function ($subQuery) use ($partSearch) {
                        $subQuery->where('name', 'like', '%' . $partSearch . '%');
                    });
                })
                ->latest()
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
    public function store(Request $request)
    {   

        $isRegistered = filter_var($request->is_registered, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        $request->merge(['is_registered' => $isRegistered]);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => $request->is_registered ? 'required|integer|digits_between:1,10' : 'nullable|integer|digits_between:1,10',
            'is_registered' => 'required|boolean'
        ]);
        
        Car::create($validated);

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
    public function update(Request $request, Car $car)
    {

        $isRegistered = filter_var($request->is_registered, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        $request->merge(['is_registered' => $isRegistered]);

        // dd($request->is_registered);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => $request->is_registered ? 'required|integer|digits_between:1,10' : 'nullable|integer|digits_between:1,10',
            'is_registered' => 'required|boolean'
        ]);


        $car->update($validated);

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
