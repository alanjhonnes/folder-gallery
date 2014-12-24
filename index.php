<?php

require 'vendor/autoload.php';

use AlanJhonnes\FolderGallery\Gallery;

$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, array(
    'cache' => './twig-cache',
    'auto_reload' => true
));

$gallery = new Gallery('images');
$tree = $gallery->getTree();

$template = $twig->loadTemplate('index.html.twig');

echo $template->render(array('tree' => $tree));

?>
