<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class RechercheController extends Controller
{
    private $_view;
    private $layoutContent;
    private $articleModel;

    public function __construct($url)
    {
        parent::__construct($url[0]);

        if ($url[0] === "recherche") {
            if (isset($_GET['q'])) {
                $this->page($url[0]);
            } else {
                header("Location: ./");
                exit;
            }
        } else {
            throw new Exception('Page not found');
        }
    }

    private function page($url)
    {
        // ====== Contenu général du layout ======
        $this->layoutContent = $this->getLayoutContent($url);

        $this->articleModel = new ArticleModel();

        // Formattage requete
        $query = '%' . str_replace(' ', '-', strtolower($_GET['q'])) . '%';
        $searchResult = $this->articleModel->search($query);

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'searchResult' => $searchResult,
            'no_index' => 1,
        ]);
    }
}
