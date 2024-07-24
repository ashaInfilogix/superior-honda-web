<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.my-profile');
    }

    public function address()
    {
        //return view('profile.address');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        User::where('id', $id)->update([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'phone_number'  => $request->phone_number,
            'phone_lime'    => $request->phone_lime,
            'licence_no'    => $request->lic_no,
            'address'       => $request->address
        ]);
        return redirect()->route('profile.index')->with('success', 'Profile Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
