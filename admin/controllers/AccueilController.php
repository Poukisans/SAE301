<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class AccueilController extends Controller
{
    private $_view;
    private $layoutContent;
    private $articleModel;

    public function __construct($url)
    {
        parent::__construct(); // Appeler le constructeur de la classe parente pour initialiser les informations générales
        $this->layoutContent = $this->getLayoutContent();

        $this->articleModel = new ArticleModel;

        // Vérification si des données POST sont présentes
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest();
        }

        if ($url[0] == "accueil") {
            $this->page($url[0]);
        } else {
            throw new Exception('Page not found');
        }
    }
    private function page($url)
    {
        $articleList = $this->articleModel->getList();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => null,
            'articleList' => $articleList,
        ]);
    }


    private function handlePostRequest()
    {
        // Ajout articles accueil
        if (isset($_POST['addArticle'], $_POST['selected_articles'])) {
            $affichage_accueil = 1;
            $selected_articles = $_POST['selected_articles'];

            try {
                $this->articleModel->setAffichageAccueil($affichage_accueil, $selected_articles);
                // Message de succès pour la session
                $_SESSION['successMsg'] = "Les articles ont été ajoutés à l'accueil.";
            } catch (Exception $e) {
                // En cas d'erreur, stocker le message d'erreur dans la session
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }


        // Suppression article accueil
        if (isset($_POST['removeArticle'])) {
            $affichage_accueil = 0;
            $id_article = $_POST['removeArticle'];

            $selected_articles = [
                'id' => $id_article,
            ];

            try {
                $this->articleModel->setAffichageAccueil($affichage_accueil, $selected_articles);
                // Message de succès pour la session
                $_SESSION['warnMsg'] = "L'article a été rétiré de l'accueil.";
            } catch (Exception $e) {
                // En cas d'erreur, stocker le message d'erreur dans la session
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }
    }
}
