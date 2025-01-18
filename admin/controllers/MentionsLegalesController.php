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
        parent::__construct(); // Appeler le constructeur de la classe parente pour initialiser les informations générales
        $this->layoutContent = $this->getLayoutContent();

        $this->generalModel =  new GeneralModel;
        if ($url[0] == "mentions-legales") {

            // Vérification si des données POST sont présentes
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->handlePostRequest();
            }

            $this->page($url[0]);
        } else {
            throw new Exception('Page not found');
        }
    }

    private function page($url)
    {
        $legalInfo = $this->generalModel->getLegal();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => ucwords($url),
            'currentContent' => ("Mentions légales"),
            'legalInfo' => $legalInfo
        ]);
    }

    private function handlePostRequest()
    {
        //Maj
        if (isset($_POST['update'], $_POST['mentions_legales'])) {
            $data = [
                'mentions_legales' => $_POST['mentions_legales'],
            ];
            try {
                $this->generalModel->updateLegal($data);
                $_SESSION['successMsg'] = "Les mentions légales ont été modifiées.";
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }
    }
}
