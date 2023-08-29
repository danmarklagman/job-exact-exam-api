<?php

namespace App\Services;

use App\Traits\Objects\HasDynamicProperties;
use Exception;

abstract class BaseService
{
    use HasDynamicProperties;

    /**
     * @throws Exception
     */
    public function checkAcceptedRequests(array $requests): void
    {
        foreach ($requests as $request) {
            if (is_a($this->request, $request)) {
                return;
            }
        }

        throw new Exception('Something went wrong, try again later.');
    }

    /**
     * @return mixed
     */
    abstract public function run();
}
