<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Http\Requests\PartRequest;
use App\Models\Car;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Car $car)
    {

        $search = $request->input("query");

        $parts = Part::whereBelongsTo($car)
        ->when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->orderBy('id', 'desc')
        ->paginate(10)
        ->withQueryString();
    

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
    public function store(PartRequest $request)
    {

        Part::create($request->validated());

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
    public function update(PartRequest $request, Part $part)
    {
        // dd($request->is_registered);
        

        $part->update($request->validated());

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
