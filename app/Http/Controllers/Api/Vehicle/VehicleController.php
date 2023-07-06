<?php

namespace App\Http\Controllers\Api\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Http\Resources\Vehicle\VehicleResource;
use App\Http\Requests\Vehicle\RegisterVehicleFormRequest;
use App\Http\Requests\Vehicle\UpdateVehicleFormRequest;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicle_detail = auth('api')->user()->Vehicle;
        return $vehicle_detail 
                ? $this->successResponse(['vehicle_detail' => new VehicleResource($vehicle_detail)], 'Vehicle Detail', Response::HTTP_OK)
                : $this->errorResponse('You have no vehicle yet', Response::HTTP_NOT_FOUND);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterVehicleFormRequest $request)
    {
        if(!auth('api')->user()->has_car){
            return $this->errorResponse('You registered has a user, kindly update your profile and select has car', 422);
        }
        
        if(auth('api')->user()->Vehicle){
            return $this->errorResponse('You already register a vehicle', 422);
        }

        if($request->validated()){
            // process vehicle registration
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleFormRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
