<?php
require_once 'models/AdminModel.php';

class LoginController extends AdminModel 
{
    private $authModel;
    private $error = null;
    private $login;

    public function __construct()
    {
        $this -> authModel = new Auth;
        if (Auth::isLoggedIn()){
            header("Location: ./accueil");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pseudo = $_POST['pseudo'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($this->authenticate($pseudo, $password)) {
                $_SESSION['user_id'] = $this->login['id'];
                $_SESSION['prenom'] = $this->login['prenom'];
                $_SESSION['nom'] = $this->login['nom'];
                $_SESSION['pseudo'] = $this->login['pseudo'];
                header("Location: ./accueil");

            } else {
                $this->error = "Identifiants incorrects";
            }
        }

        require_once 'views/login.php';
    }

    private function authenticate($pseudo, $password)
    {
        // Récupère les informations de l'utilisateur via AdminModel
        $this->login = $this->getAdmin($pseudo);

        // Vérifie si l'utilisateur existe et si le mot de passe est correct
        if ($this->login && password_verify($password, $this->login['password'])) {
            return true;
        }

        return false;
    }
}
