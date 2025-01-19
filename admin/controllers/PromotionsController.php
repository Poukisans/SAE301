<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class PromotionsController extends Controller
{
    private $_view;
    private $layoutContent;
    private $promotionModel;
    private $articleModel;
    private $promotionArticleModel;


    public function __construct($url)
    {
        parent::__construct(); // Appeler le constructeur de la classe parente pour initialiser les informations générales
        $this->layoutContent = $this->getLayoutContent();

        if ($url[0] === "promotions") {
            if (count($url) > 2) {
                throw new Exception('Page not found');
            }

            $this->promotionModel = new PromotionModel;
            $this->promotionArticleModel = new PromotionArticleModel;
            $this->articleModel = new ArticleModel;

            // Vérification si des données POST sont présentes
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->handlePostRequest();
            }

            // Appel de la page en fonction du paramètre d'URL
            if (isset($url[1]) && !empty($url[1])) {
                $this->pageAction($url[0], $url[1]);
            } else {
                $this->page($url[0]);
            }
        } else {
            throw new Exception('Page not found');
        }
    }


    private function page($url)
    {
        $promotionListNext = $this->promotionModel->getListNext();
        $promotionListCurrent = $this->promotionModel->getListCurrent();
        $promotionListArchived = $this->promotionModel->getListArchived();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => ucwords($url),
            'currentContent' => ("promotion"),
            'promotionListNext' => $promotionListNext,
            'promotionListCurrent' => $promotionListCurrent,
            'promotionListArchived' => $promotionListArchived,
        ]);
    }

    private function pageAction($url, $content)
    {
        $promotionInfo = $this->promotionModel->getInfo($content); // Récupérer les informations
        $id_promo = $promotionInfo['id'];
        $promotionArticleInfo = $this->promotionArticleModel->getInfo($content); // Récupérer les informations
        $articleList = $this->articleModel->getListPromotion();

        $this->_view = new View("views/" . $url . "/edit.php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => '<a href="./' . $url . '">' . ucwords($url) . '</a> - ' . $promotionInfo['nom'],
            'currentContent' => ("promotion"),
            'promotionInfo' => $promotionInfo,
            'promotionArticleInfo' => $promotionArticleInfo,
            'articleList' => $articleList
        ]);
    }

    private function handlePostRequest()
    {
        //Ajout
        if (isset($_POST['add'], $_POST['nom'], $_POST['type'], $_POST['date_debut'], $_POST['date_fin'])) {
            $data = [
                'nom' => $_POST['nom'],
                'type' => $_POST['type'],
                'date_debut' => $_POST['date_debut'],
                'date_fin' => $_POST['date_fin']
            ];

            if ($data['date_debut'] == $data['date_fin'] || strtotime($data['date_debut']) < strtotime($data['date_fin'])) {
                try {
                    $this->promotionModel->add($data);
                    $_SESSION['successMsg'] = "La promotion a bien été ajoutée.";
                } catch (Exception $e) {
                    $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
                }
            } else {
                $_SESSION['errorMsg'] = "La date de fin doit être supérieure à la date de début.";
            }
        }

        //Maj
        if (isset($_POST['update'], $_POST['nom'], $_POST['type'], $_POST['promotion'], $_POST['date_debut'], $_POST['date_fin'])) {
            $data = [
                'id' => $_POST['update'],
                'nom' => $_POST['nom'],
                'type' => $_POST['type'],
                'promotion' => $_POST['promotion'],
                'date_debut' => $_POST['date_debut'],
                'date_fin' => $_POST['date_fin'],
            ];

            if ($data['date_debut'] == $data['date_fin'] || strtotime($data['date_debut']) < strtotime($data['date_fin'])) {
                try {
                    $this->promotionModel->update($data);
                    $_SESSION['successMsg'] = "La promotion a bien été modifiée.";
                } catch (Exception $e) {
                    $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
                }
            } else {
                $_SESSION['errorMsg'] = "La date de fin doit être supérieure à la date de début.";
            }
        }

        //Delete
        if (isset($_POST['delete'])) {
            $id = $_POST['delete'];

            try {
                $this->promotionModel->delete($id);
                $_SESSION['successMsg'] = "La promotion a bien été supprimée.";
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        // Ajout articles promotion
        if (isset($_POST['addArticle'], $_POST['selected_articles'])) {
            $id_promotion = $_POST['addArticle'];
            $selected_articles = $_POST['selected_articles'];

            try {
                $this->promotionArticleModel->addArticle($id_promotion, $selected_articles);
                // Message de succès pour la session
                $_SESSION['successMsg'] = "Les articles ont été ajoutés à la promotion.";
            } catch (Exception $e) {
                // En cas d'erreur, stocker le message d'erreur dans la session
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        // Suppression articles promotion
        if (isset($_POST['deleteArticle'], $_POST['id_promotion'])) {
            $id_article = $_POST['deleteArticle'];
            $id_promotion = $_POST['id_promotion'];

            try {
                $this->promotionArticleModel->deleteArticle($id_promotion, $id_article);
                // Message de succès pour la session
                $_SESSION['warnMsg'] = "L'article a été supprimé de la promotion.";
            } catch (Exception $e) {
                // En cas d'erreur, stocker le message d'erreur dans la session
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }
    }
}

var_dump($_POST);
