<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class PanierController extends Controller
{
    private $_view;
    private $layoutContent;

    public function __construct($url)
    {
        parent::__construct($url[0]);

        if ($url[0] === "panier") {
                $this->page($url[0]);
        } else {
            throw new Exception('Page not found');
        }
    }

    private function page($url)
    {
        // ====== Contenu général du layout ======
        $this->layoutContent = $this->getLayoutContent($url);

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'no_index' => 1,
        ]);
    }
}
