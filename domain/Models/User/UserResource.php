<?php

namespace MVC\Models\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'   => $this->uuid,
            'name'   => $this->name,
            'email'  => $this->email,
            'active' => $this->active
        ];

        return $retorno;
    }
}
