<?php

abstract class Autoload
{
    public static function inclusionAuto($className)
    {
        // __DIR__ est une constante magique qui indique le répertoire (le dossier) du fichier courant.
        // Ici elle indique C:\xampp\htdocs\blog  
        require_once __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
        // On remplace les \ par des / dans $className. Pour éviter les erreurs, sur mac essentiellement.
        // (On met 2 backslash car le 1er est un caractère anti-échappement).

        // Sans __DIR__, ça fonctionne également, mais pour être certain que ça fonctionne sur tous les navigateurs, il est préférable de le mettre.
        // require_once str_replace('\\', '/', $className) . '.php';
    }
}
spl_autoload_register(['Autoload', 'inclusionAuto']);
