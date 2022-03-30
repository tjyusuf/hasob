<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;

use App\Http\Resources\VendorResource;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        return response([ 'data' => VendorResource::collection(Vendor::all()), 'message' => 'Retrieved successfully'], 200);
    }

    public function store(StoreVendorRequest $request)
    {
        $vendor = Vendor::create($request->validated());
        return response([ 'data' => VendorResource::make($vendor), 'message' => 'Created successfully'], 201);    
    }

    public function show(Vendor $vendor)
    {
        return response([ 'data' => VendorResource::make($vendor), 'message' => 'Showing Vendor'], 200);    
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return response(['message' => 'Deleted'], 204);
    }

    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $vendor->update($request->all());
        return response([ 'data' => VendorResource::make($vendor), 'message' => 'Updated Vendor'], 200);    
   
    }    
}
