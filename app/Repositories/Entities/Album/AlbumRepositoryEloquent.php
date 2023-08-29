<?php

namespace App\Repositories\Entities\Album;

use App\Repositories\BaseRepositoryEloquent;
use App\Models\UserAlbum;

class AlbumRepositoryEloquent extends BaseRepositoryEloquent implements AlbumRepositoryInterface
{
    /**
     * AlbumRepositoryEloquent constructor.
     *
     * @param UserAlbum $model
     */
    public function __construct(UserAlbum $model)
    {
        parent::__construct($model);
    }
}
