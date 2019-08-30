<?php

namespace App\Services;

use MediaUploader;
use App\Services\Image\ImageService;
use App\Http\Resources\Api\File\FileResource;

class ImageFileService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function handle($file)
    {
        $compressed_file = $this->imageService->handle($file);

        $media = MediaUploader::fromSource($compressed_file)->toDirectory('nucleus')->onDuplicateIncrement()->upload();

        $return = new FileResource($media);

        return response()->json($return);
    }
}
