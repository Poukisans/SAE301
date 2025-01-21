<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class PanierController extends Controller
{
    private $_view;
    private $layoutContent;
    private $articleModel;
    private $articleColorisModel;

    public function __construct($url)
    {
        parent::__construct($url[0]);

        if ($url[0] === "panier") {

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
        // ====== Contenu général du layout ======
        $this->layoutContent = $this->getLayoutContent($url);

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'no_index' => 1,
        ]);
    }

    private function handlePostRequest()
    {

        function removeArticleById($basket, $id_article)
        {
            // Utiliser array_filter pour filtrer les articles
            return array_values(array_filter($basket, function ($item) use ($id_article) {
                return $item['id_article'] != $id_article;
            }));
        }

        if (isset($_POST['removeArticle'])) {
            $_SESSION['basket'] = removeArticleById($_SESSION['basket'], $_POST['removeArticle']);
        }
    }
}
