<?php

require_once 'Modele/Modele.php';

/**
 * Created by PhpStorm.
 * User: Nicolas Sobczak & Vincent Reynaert
 * Date: 02/11/2016
 */
class UserProfile extends Modele
{

    /** Renvoie les informations sur un utillisateurs
     *
     * @param int $id L'identifiant de l'utilisateur
     * @return array L'utilisateur
     * @throws Exception Si l'identifiant de l'utilisateur est inconnu
     */
    public function getUser($userID)
    {
        $sql = 'select userID as id, nom, prenom, niveau_accreditation, mail, mot_de_passe from user where userID=?';
        $user = $this->executerRequete($sql, array($userID));
        if ($user->rowCount() == 1)
            return $user->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun utilisateur ne correspond à l'identifiant '$userID'");
    }
}