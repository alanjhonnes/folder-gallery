<?php
/**
 * Created by PhpStorm.
 * User: alanjhonnes
 * Date: 12/22/2014
 * Time: 5:17 PM
 */

namespace AlanJhonnes\FolderGallery;


use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Symfony\Component\Finder\SplFileInfo;

class GalleryImage {

    protected $file;
    protected $name;
    protected $path;
    protected $thumbnail;


    /**
     * @param SplFileInfo $file
     */
    public function __construct(SplFileInfo $file){
        $this->file = $file;
        $this->name = $file->getBasename('.' . $file->getExtension());
        $this->path = $file->getPath() . '/' . $file->getFilename();
        $this->generateThumbnail();
    }

    protected function generateThumbnail()
    {
        if(!is_file($this->getThumbnailPath())){
            $resizer = new ImageResizer(new Imagine(), new Box(300, 300) );
            $resizer->resize($this->getPath(), $this->getThumbnailPath());
        }
        if(!is_file($this->getIconPath())){
            $resizer = new ImageResizer(new Imagine(), new Box(24, 24) );
            $resizer->resize($this->getPath(), $this->getIconPath());
        }

    }

    public function getName(){
        return $this->name;
    }


    /**
     * return string The path to the file;
     */
    public function getPath(){
        return $this->path;
    }

    /**
     *
     */
    public  function getThumbnailPath(){
        return 'thumbnails/' . $this->getPath();
    }

    /**
     *
     */
    public  function getIconPath(){
        return 'image-icons/' . $this->getPath();
    }



}