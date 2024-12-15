<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class AccueilController extends Controller
{
    private $_view;
    private $layoutContent;

    public function __construct($url)
    {
        parent::__construct(); // Appeler le constructeur de la classe parente pour initialiser les informations générales
        $this->layoutContent = $this->getLayoutContent();

        if ($url[0] == "accueil") {
            $this->page($url[0]);
        } else {
            throw new Exception('Page not found');
        }
    }
    private function page($url)
    {
        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => null
        ]);
    }
}
