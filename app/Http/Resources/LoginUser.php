<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginUser extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => (int) $this->type,
            'name' => (string) $this->name,
            'email' => (string) $this->email,
        ];
    }
}
