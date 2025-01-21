<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class TeeShirtsController extends Controller
{
    private $_view;
    private $layoutContent;
    private $articleModel;
    private $articleColorisModel;
    private $articleCommentaireModel;
    private $articlePhotosModel;

    public function __construct($url)
    {
        if (isset($url[1])) {
            $cat = "/" . $url[1];
        }
        $const = $url[0] . $cat;
        parent::__construct($const); // Appeler le constructeur de la classe parente pour initialiser les informations générales

        // Vérification si des données POST sont présentes
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->articleModel = new ArticleModel();
            $this->handlePostRequest();
        }

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

        $order = "ASC";

        if (isset($_GET['filtre'])) {
            switch ($_GET['filtre']) {
                case "croissant":
                    $order = "ASC";
                    break;
                case "decroissant":
                    $order = "DESC";
                    break;
            }
        }

        // ====== Contenu de la page ======
        $this->articleModel = new ArticleModel();
        $articleList = $this->articleModel->getListCategory($categorie, $order);

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'currentCategory' => $categorie,
            'articleList' => $articleList,
        ]);
    }

    private function pageArticle($url, $categorie, $article)
    {
        $this->articleModel = new ArticleModel();
        $this->articleColorisModel = new ArticleColorisModel();
        $this->articleCommentaireModel = new ArticleCommentaireModel();
        $this->articlePhotosModel = new ArticlePhotoModel();


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

        $id_article = $articleInfo['id'];

        //Article coloris
        $articleColorisInfo = $this->articleColorisModel->getInfo($id_article);

        //Article photos
        $articlePhotosInfo = $this->articlePhotosModel->getInfo($id_article);

        //Article commentaire
        $articleCommentaireInfo = $this->articleCommentaireModel->getInfo($id_article);

        // ====== Contenu spécifique du layout ======
        $this->layoutContent = $this->getLayoutContent(); // Récupérer le contenu général
        $this->layoutContent['current_section'] = $articleInfo['nom'];

        $this->_view = new View("views/" . $url . "_content.php", [
            'layoutContent' => $this->layoutContent,
            'currentCategory' => $categorie,
            'currentArticle' => $articleInfo['nom'],
            'previewInfo' => $previewInfo,
            'articleInfo' => $articleInfo,
            'articleColorisInfo' => $articleColorisInfo,
            'articlePhotosInfo' => $articlePhotosInfo,
            'articleCommentaireInfo' => $articleCommentaireInfo,
        ]);
    }

    private function handlePostRequest()
    {
        if (isset($_POST['addBasket'], $_POST['coloris'], $_POST['taille'])) {
            $quantite = isset($_POST['quantite']) ? $_POST['quantite'] : 1;

            $data = [
                'id_article' => $_POST['addBasket'],
                'coloris' => $_POST['coloris'],
                'taille' => $_POST['taille'],
                'quantite' => $quantite
            ];
            $this->articleModel->getBasket($data);
        }
    }
}
