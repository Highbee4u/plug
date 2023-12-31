<?php

namespace App\Http\Resources\Ride;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RidePlacementCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => RidePlacementResource::collection($this->collection)
        ];
    }
}
