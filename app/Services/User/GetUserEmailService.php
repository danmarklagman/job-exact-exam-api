<?php

namespace App\Services\User;

use App\Services\BaseService;
use App\Repositories\Entities\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class GetUserEmailService extends BaseService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
	{
        $this->userRepository = $userRepository;
    }

    public function run(): Model
    {
        return $this->userRepository->findByFirst(
            ['email' => $this->emailAddress],
            ['*'],
            ['rRole']
        );
    }
}
