<?php
/**
 * Created by PhpStorm.
 * User: alanjhonnes
 * Date: 12/22/2014
 * Time: 5:17 PM
 */

namespace AlanJhonnes\FolderGallery;


class GalleryImage {

    protected $name;
    protected $path;
    protected $thumbnail;

    /**
     * @param $name string
     * @param $path string
     */
    public function __construct($name, $path){
        $this->name = $name;
        $this->path = $path;
        $this->generateThumbnail();
    }

    protected function generateThumbnail()
    {

    }


    /**
     * return string The path to the file;
     */
    public function getPath(){
        return $this->path . $this->name;
    }

    /**
     *
     */
    public  function getThumbnailPath(){
        //TODO
        return $this->getPath();
    }



}