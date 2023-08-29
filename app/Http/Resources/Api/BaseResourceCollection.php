<?php

namespace App\Http\Resources\Api;

use App\Traits\Http\Templates\Resources\Api\ResponseResourceCollectionTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class BaseResourceCollection
 * @package App\Http\Resources\Api
 */
abstract class BaseResourceCollection extends ResourceCollection
{
    use ResponseResourceCollectionTemplate;

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
