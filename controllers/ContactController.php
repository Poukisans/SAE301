<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class ContactController extends Controller
{
    private $_view;
    private $layoutContent;
    private $generalModel;

    public function __construct($url)
    {
        parent::__construct($url[0]);

        if ($url[0] === "contact") {
                $this->page($url[0]);
        } else {
            throw new Exception('Page not found');
        }
    }

    private function page($url)
    {
        // ====== Contenu général du layout ======
        $this->layoutContent = $this->getLayoutContent($url);

        // ====== Contenu contact ======
        $this->generalModel = new GeneralModel;
        $contactInfo = $this->generalModel->getContact();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'contactInfo' => $contactInfo,
        ]);
    }
}
