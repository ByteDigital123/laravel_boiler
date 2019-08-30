<?php

namespace App\Services;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use MediaUploader;


class ImageFileAttachService
{


    public function __construct($files, $entry, $tag)
    {
        $this->files = $files;
        $this->entry = $entry;
        $this->tag = $tag;
    }

    public function handle()
    {
      foreach ($this->files as $file) {
        $this->entry->attachMedia($file['id'], $this->tag);
    }
    }

}
