<?php

namespace App\Http\Resources\Ride;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserBasicResource;

class RidePlacementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'driver_id' => $this->driver_id,
            'amount' => $this->amount,
            'departure' => $this->departure,
            'destination' => $this->destination,
            'takeoff_time' => $this->takeoff_time,
            'available_seat' => $this->available_seat,
            'remaining_seat' => $this->remaining_seat,
            'ride_started' => $this->ride_started == 1 ? 'Started' : 'Not Yet Started' ,
            'ride_ended' => $this->ride_ended == 1 ? 'Ended' : 'Not Ended',
            'is_available' => $this->is_available == 1 ? 'Available' : 'Not Available',
            'date' => $this->date,
            'driver_detail' => new UserBasicResource($this->Driver)
        ];
    }
}
