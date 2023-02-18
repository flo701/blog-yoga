<?php

// Dans le fichier index, importer votre autoload...
require_once 'autoload.php';

// ...puis instancier la classe controller.
// On instancie la classe Controller avec l'objet $controller :
// ($controller est l'objet = controller est le namespace\Controller est la Classe).
$controller = new controller\Controller;

// Depuis l'objet controller, faire appel à la méthode handleRequest() :
$controller->handleRequest();
