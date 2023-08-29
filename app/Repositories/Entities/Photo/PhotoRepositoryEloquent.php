<?php

namespace App\Repositories\Entities\Photo;

use App\Repositories\BaseRepositoryEloquent;
use App\Models\UserAlbumPhoto;

class PhotoRepositoryEloquent extends BaseRepositoryEloquent implements PhotoRepositoryInterface
{
    /**
     * PhotoRepositoryEloquent constructor.
     *
     * @param UserAlbumPhoto $model
     */
    public function __construct(UserAlbumPhoto $model)
    {
        parent::__construct($model);
    }
}
