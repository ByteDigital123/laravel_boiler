<?php

namespace App\Services;

use MediaUploader;
use App\Services\Image\ImageService;
use App\Http\Resources\Api\File\FileResource;

class ImageFileService
{
    protected $imageService;
    protected $tmp;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function handle($file)
    {
        $this->createTempfile($file);

        $media = MediaUploader::fromSource($this->tmp)->toDirectory('nucleus')->onDuplicateIncrement()->upload();

        $return = new FileResource($media);

        return response()->json($return);
    }

    public function createTempFile($file)
    {
        $this->tmp = $file->getPath() . '/' . $file->getClientOriginalName();
    }

    public function compressImage()
    {
        $this->imageService->handle($file)->save($this->tmp);
    }
}
