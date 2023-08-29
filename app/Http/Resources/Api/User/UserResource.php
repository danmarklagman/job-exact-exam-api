<?php

namespace App\Http\Resources\Api\User;

use App\Http\Resources\Api\BaseJsonResource;

class UserResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'username'  => $this->username,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'website'   => $this->website,
            'address'   => json_decode($this->address),
            'company'   => json_decode($this->company),
            'albums'    => $this->rAlbums
        ];
    }
}