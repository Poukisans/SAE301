<?php
class Auth
{
    // Méthode pour vérifier si l'utilisateur est connecté
    public static function isLoggedIn()
    {
        // Vérifie si une session user_id est définie et non vide
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
}
