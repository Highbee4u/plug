<?php

namespace App\Http\Controllers\Api\Ride;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Ride\CreateRidePlacementFormRequest;
use App\Http\Requests\Ride\UpdateRidePlacementFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\PlaceRide;
use App\Http\Resources\Ride\RidePlacementResource;

class RidePlacementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail = auth('api')->user()->placed_ride;
        return $detail 
                ? $this->successResponse(['placed_ride' => new RidePlacementResource($detail)], 'Active Ride Placement Detail', 200)
                : $this->errorResponse('You have no active ride placement');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRidePlacementFormRequest $request)
    {
        if(auth('api')->user()->placed_ride){
            return $this->errorResponse('You have an active ride placement', 422);
        }

        $data = array_merge($request->validated(), ['driver_id' => auth('api')->user()->id]);

        $response = PlaceRide::create($data);

        return $response
                ? $this->successResponse(['placed_ride' => new RidePlacementResource($response)], 'You have sucessfully placed a ride', 200)
                : $this->errorResponse('Unable to placed ride, try again later', 422);
    }

   
    public function show(string $id)
    {
        if(PlaceRide::find($id)){
            return $this->successResponse(['placed_ride' => new RidePlacementresource(PlaceRide::find($id))], 'Placed Ride Details', 200);
        }else{
            return $this->errorResponse('Ride Id Supply doesn\'t match any record', 404);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRidePlacementFormRequest $request, string $id)
    {
        if(PlaceRide::find($id)){
            $placement = PlaceRide::where('id', $id)->update($request->validated());

            return $placement
                    ? $this->showMessage('Ride Placement Successfully Update', 200)
                    : $this->errorResponse('Unable to update Ride placement, try again later', 400);

        }else{
            return $this->errorResponse('Ride Id Supply doesn\'t match any record', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(PlaceRide::find($id)){
            try {
                
                DB::beginTransaction(); 

                // Delete Bookings if exists
                $booking = auth('api')->user()->placed_ride->bookings->delete();

                // Delete ride placement
                $placement = PlaceRide::find($id)->delete();

                DB::commit();

                return ($booking && $placement) ? $this->showMessage('Ride detail deleted', 200) : $this->errorResponse('unable to delete placement', 400);

                

            }catch(\Exception $exp) {
                DB::rollBack(); 
                return $this->errorResponse($exp->getMessage(), 400);
            }
           
        }else{
            return $this->errorResponse('Ride Id Supply doesn\'t match any record', 404);
        }
    }
}
