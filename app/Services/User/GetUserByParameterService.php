<?php

namespace App\Services\User;

use App\Services\BaseService;
use App\Repositories\Entities\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class GetUserByParameterService extends BaseService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
	{
        $this->userRepository = $userRepository;
    }

    public function run(): Model
    {
        return $this->userRepository->findByFirst(
            [$this->parameter['column'] => $this->parameter['value']],
            ['*'],
            ['rAlbums', 'rAlbums.rPhotos']
        );
    }
}
