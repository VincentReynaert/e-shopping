<?php

/**
 * User: Francis Polaert & Kévin Noet
 * Date: 21/10/2016
 */
//________________________________________________________________________________________
// Require once
require_once ('Controleur.php');
require_once ('Vue/Vue.php');

class ControleurTunnel implements Controleur
{
    public function __construct()
    {

    }

    // Affiche la page tunnel
    public function getHTML()
    {
        $vue = new Vue("Tunnel");
        $vue->generer(array());
    }
}