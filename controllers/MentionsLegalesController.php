<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class MentionsLegalesController extends Controller
{
    private $_view;
    private $layoutContent;
    private $generalModel;

    public function __construct($url)
    {
        parent::__construct($url[0]);

        if ($url[0] === "mentions-legales") {
            $this->page($url[0]);
        } else {
            throw new Exception('Page not found');
        }
    }

    private function page($url)
    {
        // ====== Contenu général du layout ======
        $this->layoutContent = $this->getLayoutContent($url);

        // ====== Contenu faq ======
        $this->generalModel = new GeneralModel;
        $legalInfo = $this->generalModel->getLegals();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'legalInfo' => $legalInfo,
            'no_index' => 1,
        ]);
    }
}
