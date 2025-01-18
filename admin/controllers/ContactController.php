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
        parent::__construct(); // Appeler le constructeur de la classe parente pour initialiser les informations générales
        $this->layoutContent = $this->getLayoutContent();

        $this->generalModel =  new GeneralModel;
        if ($url[0] == "contact") {

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
        $contactInfo = $this->generalModel->getContact();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => ucwords($url),
            'currentContent' => ("Contact"),
            'contactInfo' => $contactInfo
        ]);
    }

    private function handlePostRequest()
    {
        //Maj reseau
        if (isset($_POST['update'], $_POST['contact_title'], $_POST['contact'])) {
            $data = [
                'contact_title' => $_POST['contact_title'],
                'contact' => $_POST['contact']
            ];
            try {
                $this->generalModel->updateContact($data);
                $_SESSION['successMsg'] = "La page contact a bien été modifiée.";
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }
    }
}
