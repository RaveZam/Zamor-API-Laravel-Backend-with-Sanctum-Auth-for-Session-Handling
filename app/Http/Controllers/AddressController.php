<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller 
{
    public function saveAddress(Request $request){

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'address' => 'required',
            'flatNumber' => 'required',
            'province' => 'required',
            'postcode' => 'required',
            'phoneNumber' => 'required'
        ]);
        
        $address = Address::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'surname' => $request->surname,
            'address' => $request->address,
            'flatNumber' => $request->flatNumber,
            'province' => $request->province,
            'postcode' => $request->postcode,
            'phoneNumber' => $request->phoneNumber
        ]);
        
        return response()->json($address, 201);
    }

    public function fetchAddresses(){
        $userAddresses = Address::where('user_id', auth()->id())->get();
        return response()->json($userAddresses);
    }

    public function deleteAddress(Request $request){

        $address  = Address::where('id', $request->id)->where('user_id', auth()->id())->first();

        if($address){
            $address->delete();
        }

    }

        public function show($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        return response()->json($address, 200);
    }

    public function update(Request $request, $id)
{
    $address = Address::find($id);

    if (!$address) {
        return response()->json(['message' => 'Address not found'], 404);
    }

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'flatNumber' => 'nullable|string|max:255',
        'province' => 'required|string|max:255',
        'postcode' => 'required|string|max:20',
        'phoneNumber' => 'required|string|max:20',
    ]);

    $address->update($validated);

    return response()->json([
        'message' => 'Address updated successfully.',
        'address' => $address,
    ], 200);
}

}