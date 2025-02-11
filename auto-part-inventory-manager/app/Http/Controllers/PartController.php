<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $parts = Part::latest()->paginate(10);

        return response()->json($parts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'serialnumber' => 'required|string|max:255',
            'car_id' => 'required|exists:cars,id'
        ]);

        Part::create($validated);

        return redirect()->route('inventory.index')->with('message', 'Part successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Part $part)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Part $part)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Part $part)
    {
        // dd($request->is_registered);
        $validated = $request->validate([
            'name' => 'string|max:255',
            'serialnumber' => 'nullable|string',
        ]);
        

        $part->update($validated);

        return redirect()->route('inventory.index')->with('message', 'Car edited successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Part $part)
    {
        $part->delete();

        return redirect()->route('inventory.index')->with('message', 'Car deleted successfully.');
    }
}
