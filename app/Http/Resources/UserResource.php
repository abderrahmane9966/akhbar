<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->id,
            'user_name' => $this->name,
            'user_email' => $this->email,
            'api_token' => $this->api_token,
            'image' => new ImageResource($this->image),
        ];
    }
}
