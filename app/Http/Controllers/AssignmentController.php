<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;

use App\Http\Resources\AssignmentResource;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        return response([ 'data' => AssignmentResource::collection(Assignment::all()), 'message' => 'Retrieved successfully'], 200);
    }

    public function store(StoreAssignmentRequest $request)
    {
        $assignment = Assignment::create($request->validated());
        return response([ 'data' => AssignmentResource::make($assignment), 'message' => 'Created successfully'], 201);    
    }

    public function show(Assignment $assignment)
    {
        return response([ 'data' => AssignmentResource::make($assignment), 'message' => 'Showing Assignment'], 200);    
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();
        return response(['message' => 'Deleted'], 204);
    }

    public function update(UpdateAssignmentRequest $request, Assignment $assignment)
    {
        $assignment->update($request->all());
        return response([ 'data' => AssignmentResource::make($assignment), 'message' => 'Updated Assignment'], 200);    
   
    }    
    
}
