<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class CommandesController extends Controller
{
    private $_view;
    private $layoutContent;
    private $commandeModel;
    private $commandeArticleModel;

    public function __construct($url)
    {
        parent::__construct(); // Appeler le constructeur de la classe parente pour initialiser les informations générales
        $this->layoutContent = $this->getLayoutContent();

        if ($url[0] === "commandes") {
            if (count($url) > 2) {
                throw new Exception('Page not found');
            }

            $this->commandeModel = new CommandeModel;
            $this->commandeArticleModel = new CommandeArticleModel;


            // Vérification si des données POST sont présentes
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->handlePostRequest();
            }

            // Appel de la page en fonction du paramètre d'URL
            if (isset($url[1]) && !empty($url[1])) {
                $this->pageAction($url[0], $url[1]);
            } else {
                $this->page($url[0]);
            }
        } else {
            throw new Exception('Page not found');
        }
    }

    private function page($url)
    {
        $archive = 0;
        if (isset($_GET['archive'])) {
            $archive = 1;
        }

        if (isset($_GET['filter'])) {
            $commandeList = $this->commandeModel->getFilteredList($_GET['filter'], $archive);
        } else {
            $commandeList = $this->commandeModel->getList($archive);
        }

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => ucwords($url),
            'currentContent' => ("commande"),
            'commandeList' => $commandeList,
        ]);
    }

    private function pageAction($url, $content)
    {
        try {
            $commandeInfo = $this->commandeModel->getInfo($content); // Récupérer les informations 
        } catch (Exception $e) {
            header("Location: ./");
            exit;
        }
        $commandeId = $commandeInfo['id'];
        $commandeArticleInfo = $this->commandeArticleModel->getInfo($commandeId); // Récupérer les informations 

        $this->_view = new View("views/" . $url . "/edit.php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => '<a href="./' . $url . '">' . ucwords($url) . '</a> - ' . $commandeInfo['nom'],
            'currentContent' => ("commande"),
            'commandeInfo' => $commandeInfo,
            'commandeArticleInfo' => $commandeArticleInfo,
        ]);
    }

    private function handlePostRequest()
    {

        //Mise a jour infos
        if (isset($_POST['statut'])) {
            $data = [
                'id' => $_POST['id'],
                'statut' => $_POST['statut'],
            ];
            try {
                $this->commandeModel->update($data);
                $_SESSION['successMsg'] = "Le statut a bien été mis à jour"; //Output
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage(); //Output
            }
        }

        //Archiver
        if (isset($_POST['archive'])) {
            $data = [
                'id' => $_POST['archive'],
            ];
            try {
                $this->commandeModel->archive($data);
                $_SESSION['successMsg'] = "La commande a été archivée"; //Output
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage(); //Output
            }
        }

        //Desarchiver
        if (isset($_POST['unarchive'])) {
            $data = [
                'id' => $_POST['unarchive'],
            ];
            try {
                $this->commandeModel->unarchive($data);
                $_SESSION['successMsg'] = "La commande a été retirée des archives"; //Output
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage(); //Output
            }
        }
    }
}
