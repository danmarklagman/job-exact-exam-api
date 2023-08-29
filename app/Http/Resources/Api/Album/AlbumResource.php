<?php

namespace App\Http\Resources\Api\Album;

use App\Http\Resources\Api\BaseJsonResource;

class AlbumResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'user'      => $this->rUser,
            'photos'    => $this->rPhotos,
        ];
    }
}