<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class ReseauxController extends Controller
{
    private $_view;
    private $layoutContent;
    private $reseauModel;

    public function __construct($url)
    {
        parent::__construct(); // Appeler le constructeur de la classe parente pour initialiser les informations générales
        $this->layoutContent = $this->getLayoutContent();

        $this->reseauModel =  new ReseauxModel;
        if ($url[0] == "reseaux") {

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
        $socialList = $this->reseauModel->getList();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => ucwords($url),
            'currentContent' => ("reseaux"),
            'socialList' => $socialList
        ]);
    }

    private function handlePostRequest()
    {
        //Ajout reseau
        if (isset($_POST['add'], $_POST['nom'], $_POST['lien'])) {
            $data = [
                'nom' => $_POST['nom'],
                'lien' => $_POST['lien']
            ];
            try {
                $this->reseauModel->add($data);
                $_SESSION['successMsg'] = "Le réseau a bien été ajouté.";
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        //Maj reseau
        if (isset($_POST['update'], $_POST['nom'], $_POST['lien'])) {
            $data = [
                'id' => $_POST['update'],
                'nom' => $_POST['nom'],
                'lien' => $_POST['lien']
            ];
            try {
                $this->reseauModel->update($data);
                $_SESSION['successMsg'] = "Le réseau a bien été modifié.";
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        //Delete reseau
        if (isset($_POST['delete'])) {
                $id = $_POST['delete'];

            try {
                $this->reseauModel->delete($id);
                $_SESSION['successMsg'] = "Le réseau a bien été supprimé.";
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }
    }
}
