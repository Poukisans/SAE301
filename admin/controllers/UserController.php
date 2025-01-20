<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class UserController extends Controller
{
    private $_view;
    private $login;
    private $layoutContent;
    private $adminModel;

    public function __construct($url)
    {
        parent::__construct($url[0]); // Appeler le constructeur de la classe parente pour initialiser les informations générales
        $this->layoutContent = $this->getLayoutContent();

        $this->adminModel =  new AdminModel;
        if ($url[0] == "user") {
            // Vérification si des données POST sont présentes
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->handlePostRequest();
            }

            $this->page($url[0]);
        } else {
            throw new Exception('Page not found');
        }
    }

    private function page($url)
    {
        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => 'Paramètres utilisateur',
            'currentContent' => "utilisateur",
        ]);
    }

    private function handlePostRequest()
    {

        //Maj User
        if (isset($_POST['updateUser'], $_POST['pseudo'], $_POST['prenom'], $_POST['nom'])) {
            $data = [
                'pseudo' => $_POST['pseudo'],
                'prenom' => $_POST['prenom'],
                'nom' => $_POST['nom'],
                'id' => $_SESSION['user_id']
            ];
            try {
                $this->adminModel->updateUser($data);
                $_SESSION['successMsg'] = "Les informations ont été mises à jour.";

                $_SESSION['pseudo'] = $data['pseudo'];
                $_SESSION['prenom'] = $data['prenom'];
                $_SESSION['nom'] = $data['nom'];
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        if (isset($_POST['updatePassword'], $_POST['old_password'], $_POST['password'], $_POST['password_confirm'])) {
            // Récupération et validation
            $pseudo = $_SESSION['pseudo'];
            $old_password = $_POST['old_password'];
            $new_password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];

            if ($new_password === $password_confirm) {
                // Vérification de l'ancien mot de passe
                if ($this->authenticate($pseudo, $old_password)) {
                    // Hachage du nouveau mot de passe
                    $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
                    // Appel au modèle pour mettre à jour
                    $this->adminModel->setPassword($pseudo, $hashedPassword);
                    $_SESSION['successMsg'] = "Le mot de passe a été mis à jour.";
                } else {
                    $_SESSION['errorMsg'] = "Ancien mot de passe incorrect.";
                }
            } else {
                $_SESSION['errorMsg'] = "Les nouveaux mots de passe ne correspondent pas.";
            }
        }
    }

    private function authenticate($pseudo, $old_password)
    {
        // Récupère les informations de l'utilisateur via AdminModel
        $this->login = $this->adminModel->getAdmin($pseudo);

        // Vérifie si l'utilisateur existe et si le mot de passe est correct
        if ($this->login && password_verify($old_password, $this->login['password'])) {
            return true;
        }

        return false;
    }
}
