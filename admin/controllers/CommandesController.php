<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class CommandesController extends Controller
{
    private $_view;
    private $layoutContent;
    private $commandeModel;

    public function __construct($url)
    {
        parent::__construct(); // Appeler le constructeur de la classe parente pour initialiser les informations générales
        $this->layoutContent = $this->getLayoutContent();

        if ($url[0] === "commandes") {
            if (count($url) > 2) {
                throw new Exception('Page not found');
            }

            $this->commandeModel = new CommandeModel;

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

        if (isset($_GET['filter'])) {
            $commandeList = $this->commandeModel->getFilteredList($_GET['filter']);
        } else {
            $commandeList = $this->commandeModel->getList();
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

        $this->_view = new View("views/" . $url . "/edit.php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => '<a href="./' . $url . '">' . ucwords($url) . '</a> - ' . $commandeInfo['nom'],
            'currentContent' => ("commande"),
            'commandeInfo' => $commandeInfo,
        ]);
    }

    private function handlePostRequest() {}
}
