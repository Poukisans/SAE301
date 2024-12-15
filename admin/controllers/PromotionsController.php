<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class PromotionsController extends Controller
{
    private $_view;
    private $layoutContent;
    private $promotionModel;


    public function __construct($url)
    {
        parent::__construct(); // Appeler le constructeur de la classe parente pour initialiser les informations générales
        $this->layoutContent = $this->getLayoutContent();

        if ($url[0] === "promotions") {
            if (count($url) > 2) {
                throw new Exception('Page not found');
            }

            $this->promotionModel = new PromotionModel;

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
            $promotionList = $this->promotionModel->getList();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => ucwords($url),
            'currentContent' => ("promotion"),
            'promotionList' => $promotionList
        ]);
    }

    private function pageAction($url, $content)
    {
        $promotionInfo = $this->promotionModel->getInfo($content); // Récupérer les informations 

        $this->_view = new View("views/" . $url . "/edit.php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => '<a href="./' . $url . '">' . ucwords($url) . '</a> - ' . $promotionInfo['nom'],
            'currentContent' => ("article"),
            'promotionInfo' => $promotionInfo,
        ]);
    }

    private function handlePostRequest()
    {
       
    }
}
