<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserBasicResource;

class LiscenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'identification_no' => $this->identification_no,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'registration_date' => $this->registration_date,
            'liscence_class' => $this->liscence_class,
            'expiration_date' => $this->expiration_date,
            'owners_detail' => new UserBasicResource($this->user)
        ];
    }
}
