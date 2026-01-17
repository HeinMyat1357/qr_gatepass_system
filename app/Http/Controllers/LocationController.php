<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of all locations.
     */
    public function index()
    {
        $locations = Location::all();
        return view('admin.pages.view-locations', compact('locations'));
    }

    /**
     * Show the form for creating a new location.
     */
    public function create()
    {
        return view('admin.pages.create-location');
    }

    /**
     * Store a newly created location in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'type' => 'required|string',
            // 'description' => 'nullable|string',
            // 'access_level_required' => 'nullable|string',
        ]);

        Location::create([
            'name' => $request->name,
            // 'type' => $request->type,
            // 'description' => $request->description,
            // 'access_level_required' => $request->access_level_required,
        ]);

        return redirect()->route('locations.index')->with('success', 'Location created successfully.');
    }

    /**
     * Show the form for editing the specified location.
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id);
        return view('admin.pages.edit-location', compact('location'));
    }

    /**
     * Update the specified location in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'type' => 'required|string',
            // 'description' => 'nullable|string',
            // 'access_level_required' => 'nullable|string',
        ]);

        $location = Location::findOrFail($id);
        $location->update([
            'name' => $request->name,
            // 'type' => $request->type,
            // 'description' => $request->description,
            // 'access_level_required' => $request->access_level_required,
        ]);

        return redirect()->route('locations.index')->with('success', 'Location updated successfully.');
    }

    /**
     * Remove the specified location from storage.
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('locations.index')->with('success', 'Location deleted successfully.');
    }
}
