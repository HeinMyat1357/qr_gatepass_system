<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserType;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the user types.
     */
    public function index()
    {
        $userTypes = UserType::all();
        return view('admin.pages.view-user-types', compact('userTypes'));
    }

    /**
     * Show the form for creating a new user type.
     */
    public function create()
    {
        return view('admin.pages.add-user-type');
    }

    /**
     * Store a newly created user type in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:user_types,name',
        ]);

        UserType::create([
            'name' => $request->name,
        ]);

        return redirect()->route('user_types.index')->with('success', 'User type created successfully.');
    }

    /**
     * Show the form for editing the specified user type.
     */
    public function edit($id)
    {
        $userType = UserType::findOrFail($id);
        return view('admin.pages.edit-user-type', compact('userType'));
    }

    /**
     * Update the specified user type in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:user_types,name,' . $id,
        ]);

        $userType = UserType::findOrFail($id);
        $userType->update([
            'name' => $request->name,
        ]);

        return redirect()->route('user_types.index')->with('success', 'User type updated successfully.');
    }

    /**
     * Remove the specified user type from storage.
     */
    public function destroy($id)
    {
        $userType = UserType::findOrFail($id);
        $userType->delete();

        return redirect()->route('user_types.index')->with('success', 'User type deleted successfully.');
    }
}
