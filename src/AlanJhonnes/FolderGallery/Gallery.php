<?php
/**
 * Created by PhpStorm.
 * User: alanjhonnes
 * Date: 12/22/2014
 * Time: 5:06 PM
 */

namespace AlanJhonnes\FolderGallery;

class Gallery {

    /**
     * @var ImageFolder[]
     */
    protected $rootFolder;

    /**
     * Constructor.
     * @param $rootFolderName string The folder name to search for images and subfolders.
     */
    public function __construct($rootFolderName){
        $this->rootFolder = new ImageFolder('images', '');
    }

    /**
     * @return string[]
     */
    public function getTree(){
        return $this->rootFolder->getTree();
    }

    public function getRootFolder(){
        return $this->rootFolder;
    }


}