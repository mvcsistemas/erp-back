<?php

namespace MVC\Models\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'id'                => $this->id,
            'uuid'              => $this->uuid,
            'email'             => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'active'            => $this->active,
            'remember_token'    => $this->remember_token,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];

        return $retorno;
    }
}
