<?php
/**
 * Created by PhpStorm.
 * User: alanjhonnes
 * Date: 12/22/2014
 * Time: 6:24 PM
 */

namespace AlanJhonnes\FolderGallery;


use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class ImageFolder {

    protected $name;
    protected $folderPath;
    /* @var $folders ImageFolder[] */
    protected $folders;
    /* @var $images GalleryImage[] */
    protected $images;

    /**
     * @param $name string The folder name
     * @param $path string The path to the folder
     * @param $branch array The branch array
     */
    public function __construct($name, $path){
        $this->name = $name;
        $this->path = $path;
        $this->folders = array();
        $this->images = array();
        $folderFinder = new Finder();
        if($path == ''){
            $this->folderPath = $name;
        }
        else {
            $this->folderPath = $path . '/' . $name;
        }
        $folderFinder
            ->directories()
            ->in($this->folderPath)
            ->depth(0)
            ->sortByName();

        $imageFinder = new Finder();
        $imageFinder
            ->files()
            ->in($this->folderPath)
            ->depth('<= 0')
            ->name('*.jpg')
            ->name('*.jpeg')
            ->name('*.png')
            ->name('*.gif')
            ->sortByName();

        $this->verifyAndCreateFolders();

        foreach($folderFinder as $file){
            /* @var $file SplFileInfo */
            $this->folders[] = new ImageFolder($file->getFilename(), $file->getPath());
        }

        foreach($imageFinder as $file){
            /* @var $file SplFileInfo */
            $this->images[] = new GalleryImage($file);
        }
    }

    /**
     * @return array An Array containning GalleryImages and ImageFolders
     */
    public function getTree(){
        $tree = array();
        foreach($this->images as $image){
            $tree[] = $image;
        }
        foreach($this->folders as $folder){
            $subTree = $folder->getTree();
            if(count($subTree) > 0)
            $tree[$folder->getName()] = $subTree;
        }
        return $tree;
    }

    public function verifyAndCreateFolders(){
        if(!is_dir($this->folderPath)){
            mkdir($this->folderPath, 0777, true);
        }
        if(!is_dir('thumbnails/' . $this->folderPath)){
            mkdir('thumbnails/' . $this->folderPath, 0777, true);
        }
        if(!is_dir('image-icons/' . $this->folderPath)){
            mkdir('image-icons/' . $this->folderPath, 0777, true);
        }



    }

    /**
     * @return boolean
     */
    public function hasFolders(){
        if(count($this->folders) > 0){
            return true;
        }
        else {
            return false;
        }
    }

    /**
     *
     */
    public function hasImages(){
        if(count($this->images) > 0){
            return true;
        }
        else {
            return false;
        }
    }

    /**
     *
     */
    public function isEmpty(){
        return !($this->hasFolders() || $this->hasImages());
    }

    public function getName(){
        return $this->name;
    }

    public function getPath(){
        return $this->path;
    }

    /**
     * @return ImageFolder[]|array
     */
    public function getFolders(){
        return $this->folders;
    }

    /**
     * @return GalleryImage[]|array
     */
    public function getImages(){
        return $this->images;
    }


}