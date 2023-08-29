<?php

namespace App\Enums;

class ImageSizeEnum extends AbstractEnum
{
    const THUMBNAIL_USER_PHOTO = [
        'width'     => 100,
        'height'    => 100
    ];

    const FULLSIZE_USER_PHOTO = [
        'width'     => 500,
        'height'    => 500
    ];
}
