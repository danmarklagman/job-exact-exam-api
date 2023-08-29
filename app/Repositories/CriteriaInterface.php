<?php

namespace App\Repositories;

/**
 * Interface CriteriaInterface
 *
 * @package App\Repositories
 */
interface CriteriaInterface
{
    /**
     * @param  mixed ...$criteria
     * @return mixed
     */
    public function withCriteria(...$criteria): self;
}
