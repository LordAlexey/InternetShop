<?php

namespace App\Http\Controllers\Admin;

use App\Model\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Address;
use App\Http\Requests\AddressRequest;

class AddressController extends MainController
{
    //
    public function index()
    {
        return view('admin.address.index',['addresses'=>Address::all()]);
    }

    public function store(Request $request,$id=null)
    {
        if(!$id)
        {
            Address::create($request->all());
            return redirect()->route('adm_address');
        }
        else {
           $good = Good::find($id);
           $address = Address::find($request->address_id);
          $good->addAddress($address);
           return redirect()->route('adm_good_edit',$id);
        }
    }

    public function destroy($id)
    {
        Address::find($id)->delete();
        return redirect()->route('adm_address');
    }

    public function edit()
    {
        
    }

    public function show($id)
    {
        $address = Address::find($id);
        return view('admin.address.list',['address'=>$address]);
    }
}
