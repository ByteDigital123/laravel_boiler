<?php

namespace App\Services;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use MediaUploader;
use App\Http\Resources\Api\File\FileResource;

class ImageFileService
{


    public function __construct($file)
    {
        $this->file = $file;
    }

    public function handle()
    {
      $media = MediaUploader::fromSource($this->file)->toDirectory('nucleus')->onDuplicateIncrement()->upload();
      $originalFile = $this->file;
      $return = new FileResource($media);
      return response()->json($return);
    }

}
