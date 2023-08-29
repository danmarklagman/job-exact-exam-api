<?php

namespace App\Http\Resources\Api;

use App\Traits\Http\Templates\Resources\Api\ResponseJsonResourceTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BaseJsonResource
 * @package App\Http\Resources\Api
 */
abstract class BaseJsonResource extends JsonResource
{
    use ResponseJsonResourceTemplate;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
