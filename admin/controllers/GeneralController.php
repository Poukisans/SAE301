<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class GeneralController extends Controller
{
    private $_view;
    private $layoutContent;
    private $generalModel;

    public function __construct($url)
    {
        parent::__construct(); // Appeler le constructeur de la classe parente pour initialiser les informations générales
        $this->layoutContent = $this->getLayoutContent();
        
        $this->generalModel =  new GeneralModel;
        if ($url[0] == "general") {

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
        $generalInfo = $this->generalModel->getInfo();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => ucwords($url),
            'currentContent' => ("general"),
            'generalInfo' => $generalInfo
        ]);
    }

    private function handlePostRequest()
    {
        //Ajout prestation
        if (isset($_POST['updatePresentation'], $_POST['presentation'])) {
            $data = [
                'presentation' => $_POST['presentation'],
            ];
            try {
                $this->generalModel->updatePresentation($data);
                $_SESSION['successMsg'] = "La présentation a bien été ajoutée.";
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        //Maj Meta Desc
        if (isset($_POST['updateMetaDesc'], $_POST['meta_desc'])) {
            $data = [
                'meta_desc' => $_POST['meta_desc']
            ];
            try {
                $this->generalModel->updateMetaDesc($data);
                $_SESSION['successMsg'] = "La description Google a bien été mise à jour"; //Output
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage(); //Output
            }
        }
    }
}
