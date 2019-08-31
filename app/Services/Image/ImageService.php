<?php

namespace App\Services\Image;

use Intervention\Image\Facades\Image;

class ImageService
{
    protected $img;

    /**
     * set up the class
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function handle($file)
    {
        $this->getWidthAndHeight($file);

        $this->img = Image::make($file);

        if ($this->img_width > config('image.max-width')) {
            if (config('image.resize')) {
                $this->resize();
            }
        }

        if (config('image.compression')) {
            $this->compress();
        }

        return $this->img;
    }

    /**
     * resize the image
     */
    public function resize()
    {
        $this->img->resize(config('image.max-width'), null, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });

        return $this;
    }

    /**
     * compress the image
     */
    public function compress()
    {
        $this->img->encode('jpg', config('image.compress-percent'));

        return $this;
    }

    /**
     * crop the image
     */
    public function crop()
    {
        $this->img->crop($this->required_width, $this->required_height);

        return $this;
    }


    
    /**
     * get the file extension
     */
    public function getFileExtension()
    {
        return pathinfo($this->file->getClientOriginalName(), PATHINFO_EXTENSION);
    }

    /**
     * get the file name
     * @return [type] [description]
     */
    public function getFileName($file)
    {
        return pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    }

    public function getWidthAndHeight($file)
    {
        list($this->img_width, $this->img_height) = getimagesize($file);
    }

    public function getOrientation()
    {
        if ($this->img_width > $this->mg_height) {
            $this->orientation = 'landscape';
        } else {
            $this->orientation = 'portrait';
        }
    }

    public function cropImageDependingOnOrientation()
    {
        switch ($orientation) {
            case 'landscape':
                $this->img->resize($this->required_width, null, function ($c) {
                    $c->aspectRatio();
                });
                $this->img->crop($this->required_width, $this->required_height);
                $this->img->encode('jpg', 90);
            break;

            case 'portrait':
                $this->img->resize($this->required_width, null, function ($c) {
                    $c->aspectRatio();
                });
                $this->img->crop($this->required_width, $this->required_height);
                $this->img->encode('jpg', 90);
            break;

            default:
                $this->img->widen($this->required_width, function ($c) {
                    $c->aspectRatio();
                });
                $this->img->crop($this->required_width, $this->required_height);
                $this->img->encode('jpg', 90);
            break;
        };
    }
}
