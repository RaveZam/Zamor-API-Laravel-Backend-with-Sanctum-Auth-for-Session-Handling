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
}