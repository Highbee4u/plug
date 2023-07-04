<?php

namespace App\Http\Resources\Vehicle;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleBasicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'brand' => $this->brand,
            'colour' => $this->colour,
            'registration_no' => $this->registration_no,
            'car_model' => $this->car_model,
            'air_condition' => $this->air_condition,
            'manufacture_year' => $this->manufacture_year,
            'body_type' => $this->body_type,
            'engine_no' => $this->engine_no,
            'owners_name' => $this->owners_name,
            'registration_status' => $this->registration_status
        ];
    }
}
