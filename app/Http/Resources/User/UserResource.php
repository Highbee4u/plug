<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Account\AccountBasicResource;
use App\Http\Resources\Vehicle\VehicleBasicResource;


class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone_number,
            'gender' => $this->gender,
            'account_detail' => new AccountBasicResource($this->Account),
            'vehicle_detail' => $this->has_car === 1 ? new VehicleBasicResource($this->vehicle) : [],
            'liscence_detail' => $this->has_car === 1 ? new LiscenceBasicResource($this->vehicle) : []
        ];
    }
}
