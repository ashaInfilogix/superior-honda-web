<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::where('user_id',Auth::id())->orderBy('is_default', 'desc')->get();
        return view('profile.address', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        $savedAddress = Address::where('user_id',Auth::id())->get()->count();

        return view('profile.add-address',compact('countries','savedAddress'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $savedAddress = Address::where('user_id',Auth::id())->get()->count();
        if ($request->is_default || $savedAddress <= 0) {
            $is_default = 1;
            Address::where('user_id', Auth::id())->update([
                'is_default' => 0
            ]);
        } else {
            $is_default = 0;
        }
        Address::create([
            'user_id'     => Auth::id(),
            'full_name'   => $request->full_name,
            'mobile_number'   => $request->mobile_no,
            'address'     => $request->address,
            'state_id'       => $request->state_id,
            'city'        => $request->city,
            'postal_code' => $request->postal_code,
            'nearby'      => $request->nearby,
            'country_id'      => $request->country_id,
            'is_default'  => $is_default
        ]);

        return redirect()->route('addresses.index')->with('success', 'Address added successfully.'); 
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
        $address = Address::with('state')->with('country')->find($id);
        $countries = Country::all();
        $states = State::where('country_id',$address->country_id)->get();
        return view('profile.edit-address',compact('address','countries','states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->is_default) {
            $is_default = 1;
            Address::where('user_id', Auth::id())->update([
                'is_default' => 0
            ]);
        } else {
            $is_default = 0;
        }
        Address::where('id', $id)->update([
            'full_name'   => $request->full_name,
            'mobile_number'   => $request->mobile_no,
            'address'     => $request->address,
            'state_id'       => $request->state_id,
            'city'        => $request->city,
            'postal_code' => $request->postal_code,
            'nearby'      => $request->nearby,
            'country_id'      => $request->country_id,
            'is_default'  => $is_default
        ]);
        return redirect()->route('addresses.index')->with('success', 'Address Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        if($address->is_default == 1){
            $lastAddress = Address::where('user_id', Auth::id())->latest()->first();
            $lastAddress->is_default = 1;
            $lastAddress->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Address deleted successfully.'
        ]);
    }

    public function getStates( $country_id = null ){
        $states = State::where('country_id',$country_id)->get();
        
        $option = '<option>Select State</option>';
        foreach($states as $state){
            $option .= '<option value="'.$state->id.'">'.$state->name.'</option>';
        }
        return response($option); 
    }
}
