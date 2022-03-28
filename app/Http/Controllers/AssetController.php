<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;

use App\Http\Resources\AssetResource;

use App\Models\Asset;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        return response([ 'data' => AssetResource::collection(Asset::all()), 'message' => 'Retrieved successfully'], 200);
    }

    public function store(StoreAssetRequest $request)
    {
        $asset = Asset::create($request->validated());
        return response([ 'data' => AssetResource::make($asset), 'message' => 'Created successfully'], 201);    
    }

    public function show(Asset $asset)
    {
        return response([ 'data' => AssetResource::make($asset), 'message' => 'Showing Asset'], 200);    
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return response(['message' => 'Deleted'], 204);
    }

    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $asset->update($request->all());
        return response([ 'data' => AssetResource::make($asset), 'message' => 'Updated Asset'], 200);    
   
    }

}
