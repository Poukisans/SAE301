<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class FaqController extends Controller
{
    private $_view;
    private $layoutContent;
    private $faqModel;

    public function __construct($url)
    {
        parent::__construct(); // Appeler le constructeur de la classe parente pour initialiser les informations générales
        $this->layoutContent = $this->getLayoutContent();

        $this->faqModel =  new FaqModel;
        if ($url[0] == "faq") {

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
        $faqList = $this->faqModel->getList();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => ucwords($url),
            'currentContent' => ("F.A.Q"),
            'faqList' => $faqList
        ]);
    }

    private function handlePostRequest()
    {
        //Ajout reseau
        if (isset($_POST['add'], $_POST['question'], $_POST['reponse'])) {
            $data = [
                'question' => $_POST['question'],
                'reponse' => $_POST['reponse']
            ];
            try {
                $this->faqModel->add($data);
                $_SESSION['successMsg'] = "La question a bien été ajoutéé.";
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        //Maj reseau
        if (isset($_POST['update'], $_POST['question'], $_POST['reponse'])) {
            $data = [
                'id' => $_POST['update'],
                'question' => $_POST['question'],
                'reponse' => $_POST['reponse']
            ];
            try {
                $this->faqModel->update($data);
                $_SESSION['successMsg'] = "La question a bien été modifiée.";
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        //Delete reseau
        if (isset($_POST['delete'])) {
            $id = $_POST['delete'];

            try {
                $this->faqModel->delete($id);
                $_SESSION['successMsg'] = "La question a bien été supprimée.";
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }
    }
}
