<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class AccueilController extends Controller
{
    private $_view;
    private $layoutContent;

    public function __construct($url)
    {
        parent::__construct('');

        if (empty($url)) {
            $this->page('accueil');
        } else {
            throw new Exception('Page not found');
        }
    }

    private function page($url)
    {
        // ====== Contenu général layout ======
        $this->layoutContent = $this->getLayoutContent($url);
        $this->layoutContent['current_section'] = null; //Masquer "Accueil"

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
        ]);
    }
}
