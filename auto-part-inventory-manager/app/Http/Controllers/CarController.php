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
    public function index()
    {
        $cars = Car::with('parts')->get();
        return Inertia::render('Inventory', ['cars' => $cars]);
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

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => $request->is_registered ? 'required|string|max:255' : 'nullable|string|max:255',
            'is_registered' => 'boolean'
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

        // $request->merge(['is_registered' => $isRegistered]);

        // dd($request->is_registered);
        $validated = $request->validate([
            'name' => 'string|max:255',
            'registration_number' => 'string|max:255',
            'is_registered' => 'boolean'
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
