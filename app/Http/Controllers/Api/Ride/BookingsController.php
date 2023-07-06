<?php

namespace App\Http\Controllers\Api\Ride;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\PlaceRide;
use App\Http\Requests\Ride\CreateBookingsFormRequest;
use App\Http\Requests\Ride\UpdateBookingsFormRequest;
use App\Http\Resources\Ride\BookingResource;


class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = auth('api')->user()->Bookings;
        return $bookings 
                ? $this->successResponse(['bookings' => BookingResource::collection($bookings)], 'Bookings', 200)
                : $this->errorResponse('You have no bookings Detail', 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookingsFormRequest $request)
    {
        if($request->validated()){
            
            $ride = PlaceRide::where('id', $request['ride_id'])->first();
            
            if($ride['driver_id'] == auth('api')->user()->id){
                return $this->showMessage('You aren\'t allowed to book ride you placed', 422);
            }

            if(!($ride->takeoff_time < \Carbon\Carbon::now())){
                return $this->errorResponse('Ride Take-off time already past', 422);
            }

            if($ride->remaining_seat == 0){
                return $this->errorResponse('Ride Seat already Filled', 422);
            }

            if($ride->ride_started){
                return $this->errorResponse('Ride already started', 422);
            }

            $data = array_merge($request->validated(), ['persanger_id' => auth('api')->user()->id]);

            $bookings = Bookings::create($data);

            $ride->remaining_seat += 1;

            $ride->save();

            return $bookings
                    ? $this->successResponse(['bookings' => new BookingResource($bookings)], 'Bookings Succefful', 200)
                    : $this->errorResponse('Unable to place booking, try again', 400);
        }
       
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bookings_detail = Bookings::where('id', $id)->first();

        return $bookings_detail
                ? $this->successResponse(['booking' => new BookingResource($bookings_detail)], 'booking details', 200)
                : $this->errorResponse('ID dupplied does not match any of the record');
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
