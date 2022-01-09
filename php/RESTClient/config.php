<?php
require './vendor/autoload.php';
// reference to the Twig Environment;
use Twig\Environment;
// reference tp filesystem
use Twig\Loader\FilesystemLoader;
// tell Twig path to the template file
$loader = new FilesystemLoader(__DIR__ . '/templates');
// Create Twig Object ready to use
$view = new Environment($loader);
