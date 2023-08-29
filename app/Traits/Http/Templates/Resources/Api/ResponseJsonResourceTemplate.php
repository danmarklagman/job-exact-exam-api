<?php

namespace App\Traits\Http\Templates\Resources\Api;

use Illuminate\Http\Response;
use JsonException;

/**
 * Trait ResponseJsonResourceTemplate
 * @package App\Traits\Http\Templates\Resources\Api
 */
trait ResponseJsonResourceTemplate
{
    /**
     * Customize the response for a request.
     *
     * @param $request
     * @param $response
     * @throws JsonException
     */
    public function withResponse($request, $response): void
    {
        $responseContent = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $content = [
            'status'  => $response->getStatusCode(),
            'message' => period_at_the_end(Response::$statusTexts[$response->getStatusCode()]),
            'result'  => (object) $responseContent
        ];

        $response->setContent(json_encode($content, JSON_THROW_ON_ERROR));
    }
}
