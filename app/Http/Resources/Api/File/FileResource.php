<?php

namespace App\Http\Resources\Api\File;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

       return [
           'id' => $this->id,
           'filename' => $this->filename,
           'path' => $this->path,
           'size' => $this->size,
           'extension' => $this->extension,
           'url' => $this->getUrl()
       ];
    }
}
