<?php

/**
 * Created by PhpStorm.
 * User: Nicolas Sobczak & Vincent Reynaert
 * Date: 02/11/2016
 */
//TODO : initialiser dans $_SESSION les parametres de users
//________________________________________________________________________________________
// Require once
require_once 'Controleur/Controleur.php';
require_once 'Vue/Vue.php';
require_once 'Modele/UserLogin.php';

class ControleurLogin implements Controleur
{
    //Attributs
    /**
     * @var int
     */
    private $login_code;
    /**
     * @var UserLogin
     */
    private $userLogin;


    //______________________________________________________________________________________
    /**
     * ControleurLogin constructor.
     */
    public function __construct()
    {
        $this->login_code = 0;
        $this->userLogin = new UserLogin();
    }


    /**
     * Selectionne la page a afficher
     *
     * @return int L'id de l'utilisateur s'il est connecte, -1 sinon
     */
    public function selectHTML()
    {
        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
        } else // Pour aller a la page de login
        {
            $userID = -1;
        }
        return $userID;
    }


    /**
     * Fonction qui...
     */
    public function logguerUser()
    {
        // Aucun champ n'est rempli => Le client vient de cliquer sur "Login ou Profil et il n'est pas connecté"
        // donc on affiche le formulaire
        var_dump('je suis dans logguerUser');
        $vue = new Vue("Login");
        if (isset($_POST)) {

            var_dump('le post est set');
            var_dump($_POST);
            if (empty($_POST['mail']) && empty($_POST['password'])) {
                $this->login_code = 0;
                var_dump('il ny a ni mail ni password dentree');
            } elseif (empty($_POST['mail']) || empty($_POST['password'])) {
                $this->login_code = UserLogin::FORM_INPUTS_ERROR;
                var_dump('il manque le mail ou le password');
            } elseif (!empty($_POST['mail']) && !empty($_POST['password'])) {
                var_dump('tu mas bien donnee mail et password maintenant faut que je regarde ca');
                $this->login_code = $this->userLogin->connectUser($_POST['mail'], $_POST['password']);
                if($this->login_code == UserLogin::LOGIN_OK)
                {
                    header('Location: index.php?action=userProfile');
                    die();
                }
            }
            $vue->generer(array('login_code' => $this->login_code));
        } else {

            var_dump('rien n est poste');
            $vue->generer();
        }
    }


    /**
     * Affiche la page
     */
    public function getHTML()
    {
        $userID = $this->selectHTML();

        // si l'utilisateur est connecte
        if ($userID >= 0) {
            header('Location: index.php?action=userProfile');
            die();
        } // sinon redirection vers la page de login
        else {
            $this->logguerUser();
        }

    }


    /**
     * Fonction qui renvoie les informations sur un utilisateur
     *
     * @param int $userID L'identifiant de l'utilisateur
     * @return array L'utilisateur
     */
    public function displayUserLogin($userID)
    {
        $user = new UserLogin();
        $result = $user->getUser($userID);
        return $result;
    }


    /**
     * Fonction qui...
     */
    public function logguer()
    {

        var_dump('on va logguer le user');
        $this->logguerUser();
    }

}





