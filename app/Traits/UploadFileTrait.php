<?php

namespace App\Traits;

use Illuminate\Support\Str;
use App\Enums\ImageSizeEnum;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait UploadFileTrait {

    public function uploadExternalThumbnailImage($userId, $albumId, $imageUrl): string
    {
        return $this->uploadExternalPhoto($userId, $albumId, 'thumbnail', $imageUrl, 'users');
    }

    public function uploadExternalFullImage($userId, $albumId, $image): string
    {
        return $this->uploadExternalPhoto($userId, $albumId, 'full', $image, 'users', false);
    }

    private function uploadExternalPhoto($userId, $albumId, $size, $imageUrl, $disk, $resize = false): string
    {
        $destinationPath = $userId . '/albums/' . $albumId .'/'. $size .'/';
        $imageName = Str::uuid().'.'.'png';

        $this->createDirectoryIfNotExists($destinationPath, $disk);

        $imgFile = Image::make($imageUrl);

        if ($resize) {
            $imgFile->resize(
                ImageSizeEnum::THUMBNAIL_USER_PHOTO['width'], 
                ImageSizeEnum::THUMBNAIL_USER_PHOTO['height'], 
            function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg', 80);
        } else {
            $imgFile->encode('jpg', 80);
        }

        Storage::disk($disk)->put($this->getPathFileName($destinationPath, $imageName), $imgFile);

        return $imageName;
    }

    private function uploadPayloadPhoto($userId, $albumId, $size, $image, $disk, $resize = false): string
    {
        $destinationPath = $userId . '/albums/' . $albumId .'/'. $size .'/';

        $image = $image;
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::uuid().'.'.'png';

        $this->createDirectoryIfNotExists($destinationPath, $disk);

        $imgFile = Image::make($image);

        if ($resize) {
            $imgFile->resize(
                ImageSizeEnum::THUMBNAIL_USER_PHOTO['width'], 
                ImageSizeEnum::THUMBNAIL_USER_PHOTO['height'], 
            function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg', 80);
        } else {
            $imgFile->encode('jpg', 80);
        }

        Storage::disk($disk)->put($this->getPathFileName($destinationPath, $imageName), $imgFile);

        return $imageName;
    }

    private function createDirectoryIfNotExists($destinationPath, $disk): void
    {
        if (!Storage::disk($disk)->exists($destinationPath)) {
            Storage::disk($disk)->makeDirectory($destinationPath);
        }
    }

    private function getPathFileName($destinationPath, $imageName): string
    {
        return $destinationPath.'/'.$imageName;
    }
}
