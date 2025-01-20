<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class BonsPlansController extends Controller
{
    private $_view;
    private $layoutContent;
    private $articleModel;

    public function __construct($url)
    {
        parent::__construct($url[0]);

        if ($url[0] === "bons-plans") {
            $this->page($url[0]);
        } else {
            throw new Exception('Page not found');
        }
    }

    private function page($url)
    {
        // ====== Contenu général du layout ======
        $this->layoutContent = $this->getLayoutContent($url);

        $this->articleModel = new ArticleModel;
        $articlePromoList = $this->articleModel->getList();
        $articleOffreList = $this->articleModel->getOffreList();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'articlePromoList' => $articlePromoList,
            'articleOffreList' => $articleOffreList,
        ]);
    }
}
