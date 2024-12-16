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

            //Vérifié si la catégorie est valide
            if (isset($url[1]) && !in_array($url[1], ['homme', 'femme', 'enfant'])) {
                header('Location: ' . BASE_URL . 'tee-shirts');
                exit;
            }

            if (isset($url[1]) && !empty($url[1]) && isset($url[2]) && !empty($url[2])) {
                $this->pageArticle($url[0], $url[1], $url[2]); //Page Article

            } elseif (isset($url[1]) && !empty($url[1])) {
                $this->pageCategory($url[0], $url[1]); //Page tee-shirts catégorie

            } else {
                $this->page($url[0]); //Page tee-shirts sans catégorie
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
        $articleList = $this->articleModel->getListCategory($categorie);

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'articleList' => $articleList,
        ]);
    }

    private function pageArticle($url, $categorie, $article)
    {
        $this->articleModel = new ArticleModel();

        // Vérifier si l'article existe
        try {
            $articleInfo = $this->articleModel->getInfo($article);
        } catch (Exception $e) {
            header('Location: ' . BASE_URL . 'tee-shirts/' . $categorie);
            exit;
        }

        //vérification catégorie de l'article
        if ($articleInfo['categorie'] != $categorie) {
            header('Location: ' . BASE_URL . 'tee-shirts/' . $categorie);
            exit;
        }

        //Vérification affichage page
        if ($articleInfo['affichage'] == 0) {
            session_start();
            if (!Auth::isLoggedIn()) {
                header('Location: ' . BASE_URL . 'tee-shirts');
                exit;
            } else {
                $previewInfo = "Mode prévisualisation. Cette page n'a pas encore été publiée.";
            }
        } else {
            $previewInfo = null;
        }

        // ====== Contenu spécifique du layout ======
        $this->layoutContent = $this->getLayoutContent($url); // Récupérer le contenu général

        $this->_view = new View("views/" . $url . "_content.php", [
            'layoutContent' => $this->layoutContent,
            'previewInfo' => $previewInfo,
            'articleInfo' => $articleInfo,
        ]);
    }
}
