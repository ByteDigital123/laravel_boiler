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

    /**
     * handle the upload
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function handle($file)
    {
        $this->createTempfile($file);

        $this->compressImage($file);

        $media = MediaUploader::fromSource($this->tmp)->toDirectory('nucleus')->onDuplicateIncrement()->upload();

        $return = new FileResource($media);

        return response()->json($return);
    }

    /**
     * create a temp file as mediaiable
     * doesnt like Intervention image file types
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function createTempFile($file)
    {
        $this->tmp = $file->getPath() . '/' . $file->getClientOriginalName();
    }

    /**
     * compress the iamge
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function compressImage($file)
    {
        $this->imageService->handle($file)->save($this->tmp);
    }
}
