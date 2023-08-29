<?php

namespace App\Enums;

class StatusCodeEnum extends AbstractEnum
{
    const SUCCESS = 200;
    const CREATED = 201;
    const ACCEPTED = 202;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const ERROR = 422;
    const SERVER_ERROR = 500;
}
