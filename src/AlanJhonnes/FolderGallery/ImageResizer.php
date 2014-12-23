<?php

namespace AlanJhonnes\FolderGallery;

use Imagine\Image\ImageInterface;
use Imagine\Image\ImagineInterface;
use Imagine\Image\BoxInterface;
use Imagine\Image\Point;
use Imagine\Image\Box;

class ImageResizer
{
    protected $imagine;
    protected $mode;
    protected $box;

    public function __construct(ImagineInterface $imagine, BoxInterface $box, $mode = ImageInterface::THUMBNAIL_OUTBOUND) {
        $this->imagine = $imagine;
        $this->mode = $mode;
        $this->box = $box;
    }

    public function resize($imagePath, $destination)
    {
        $image = $this->imagine->open($imagePath);
        //original size
        $srcBox = $image->getSize();
        //we scale on the smaller dimension
        if ($srcBox->getWidth() > $srcBox->getHeight()) {
            $width  = $srcBox->getWidth()*($this->box->getHeight()/$srcBox->getHeight());
            $height =  $this->box->getHeight();
            //we center the crop in relation to the width
            $cropPoint = new Point((max($width - $this->box->getWidth(), 0))/2, 0);
        } else {
            $width  = $this->box->getWidth();
            $height =  $srcBox->getHeight()*($this->box->getWidth()/$srcBox->getWidth());
            //we center the crop in relation to the height
            $cropPoint = new Point(0, (max($height - $this->box->getHeight(),0))/2);
        }

        $box = new Box($width, $height);
        //we scale the image to make the smaller dimension fit our resize box
        $image = $image->thumbnail($box, ImageInterface::THUMBNAIL_OUTBOUND);

        //and crop exactly to the box
        $image->crop($cropPoint, $this->box)
            ->save($destination);
    }
}