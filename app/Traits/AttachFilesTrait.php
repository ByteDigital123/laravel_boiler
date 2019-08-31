<?php

namespace App\Traits;

use Plank\Mediable\Mediable;

trait AttachFilesTrait
{
    use Mediable;

    /**
     * attaches files to this model
     * @param  array $files array of files to attach
     * @param  string $tag  name of the polymorphic tag
     * @return $this
     */
    public function attachFiles($files, $tag)
    {
        foreach ($files as $file) {
            $this->attachMedia($file['id'], $tag);
        }

        return $this;
    }
}
