<?php

require 'vendor/autoload.php';

use AlanJhonnes\FolderGallery\Gallery;
use JMS\Serializer\SerializerBuilder;

$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, array(
    'cache' => './twig-cache',
    'auto_reload' => true
));

$gallery = new Gallery('images');
$tree = $gallery->getTree();

$serializer = SerializerBuilder::create()->build();
$jsonContent = $serializer->serialize($tree, 'json');
var_dump($tree);

$template = $twig->loadTemplate('index.html.twig');

echo $template->render(array('tree' => $tree, 'json' => $jsonContent));

?>
