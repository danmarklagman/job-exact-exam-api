<?php

namespace App\Services\Album;

use App\Repositories\Entities\Album\AlbumRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;

class GetAlbumByParameterService extends BaseService
{
    private AlbumRepositoryInterface $albumRepositoryInterface;

    public function __construct(AlbumRepositoryInterface $albumRepositoryInterface)
	{
        $this->albumRepositoryInterface = $albumRepositoryInterface;
    }

    public function run(): Model
    {
        return $this->albumRepositoryInterface->findByFirst(
            [$this->parameter['column'] => $this->parameter['value']],
            ['*'],
            ['rPhotos', 'rUser']
        );
    }
}
