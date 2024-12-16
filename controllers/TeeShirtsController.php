<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class TeeShirtsController extends Controller
{
    private $_view;
    private $layoutContent;
    private $articleModel;

    public function __construct($url)
    {
        parent::__construct($url[0]); // Appeler le constructeur de la classe parente pour initialiser les informations générales

        if ($url[0] === "tee-shirts") {
            if (count($url) > 3) {
                throw new Exception('Page not found');
            }

            if (isset($url[1]) && !empty($url[1])) {
                $this->pageCategory($url[0], $url[1]);
            } else {
                $this->page($url[0]);
            }
        } else {
            throw new Exception('Page not found');
        }
    }

    private function page($url)
    {
        // ====== Contenu général layout ======
        $this->layoutContent = $this->getLayoutContent($url); // Récupérer le contenu général

        // ====== Contenu de la page ======
        $this->articleModel = new ArticleModel();
        $articleList = $this->articleModel->getList();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'articleList' => $articleList,
        ]);
    }

    private function pageCategory($url, $categorie)
    {
        // ====== Contenu général layout ======
        $this->layoutContent = $this->getLayoutContent($url); // Récupérer le contenu général

        // ====== Contenu de la page ======
        $this->articleModel = new ArticleModel();
        $articleList = $this->articleModel->getList();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'articleList' => $articleList,
        ]);
    }

    private function pageCategory($url, $categorie)
    {
        $this->articleModel = new ArticleModel();

        try {
            $filmInfo = $this->filmModel->getInfo($film); // Récupérer les informations du film
        } catch (Exception $e) {
            header("Location: ./");
            exit;
        }

        //Vérification affichage page
        if ($articleInfo['affichage'] == 0) {
            session_start();
            if (!Auth::isLoggedIn()) {
                header("Location: ./");
                exit();
            } else {
                $previewInfo = "Mode prévisualisation. Cette page n'a pas encore été publiée.";
            }
        } else {
            $previewInfo = null;
        }

        $filmId = $filmInfo['id'];

        // ====== Contenu spécifique du layout ======
        $this->layoutContent = $this->getLayoutContent($url); // Récupérer le contenu général

        $this->layoutContent['banner'] = $filmInfo['banner'];
        $this->layoutContent['meta_desc'] = $filmInfo['synopsis'];
        $this->layoutContent['current_section'] = $filmInfo['nom'];

        $this->_view = new View("views/" . $url . "_content.php", [
            'layoutContent' => $this->layoutContent,
            'previewInfo' => $previewInfo,
        ]);
    }
}
