<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class ArticlesController extends Controller
{
    private $_view;
    private $layoutContent;
    private $fileManager;
    private $articleModel;
    private $articlePhotoModel;
    private $articleColorisModel;
    private $FilePath;


    public function __construct($url)
    {
        parent::__construct(); // Appeler le constructeur de la classe parente pour initialiser les informations générales
        $this->layoutContent = $this->getLayoutContent();

        $this->FilePath = "public/articles/";

        if (empty($_SESSION['vue_article'])) {
            $_SESSION['vue_article'] = 0;
        }

        if ($url[0] === "articles") {
            if (count($url) > 2) {
                throw new Exception('Page not found');
            }

            $this->articleModel = new ArticleModel;
            $this->articlePhotoModel = new ArticlePhotoModel;
            $this->articleColorisModel = new ArticleColorisModel;
            $this->fileManager =  new FileManager;

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
        $articleList = $this->articleModel->getList();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => ucwords($url),
            'currentContent' => ("article"),
            'articleList' => $articleList
        ]);
    }

    private function pageAction($url, $content)
    {
        try {
            $articleInfo = $this->articleModel->getInfo($content); // Récupérer les informations 
        } catch (Exception $e) {
            header("Location: ./");
            exit;
        }
        $id_content = $articleInfo['id'];

        $articlePhotoList = $this->articlePhotoModel->getList($id_content); // Récupérer les images 
        $articleColorisList = $this->articleColorisModel->getList($id_content); // Récupérer les coloris


        $this->_view = new View("views/" . $url . "/edit.php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => '<a href="./' . $url . '">' . ucwords($url) . '</a> - ' . $articleInfo['nom'],
            'currentContent' => ("article"),
            'articleInfo' => $articleInfo,
            'articlePhotoList' => $articlePhotoList,
            'articleColorisList' => $articleColorisList,
        ]);
    }

    private function handlePostRequest()
    {
        //Changer Vue Article
        if (isset($_POST['changerVue'])) {
            if ($_SESSION['vue_article'] == 0) {
                $_SESSION['vue_article'] = 1;
            } elseif ($_SESSION['vue_article'] == 1) {
                $_SESSION['vue_article'] = 0;
            }
        }

        //Ajout article
        if (isset($_POST['add'], $_POST['nom'], $_POST['categorie'])) {
            $data = [
                'nom' => $_POST['nom'],
                'categorie' => $_POST['categorie'],
                //'lien' => preg_replace('/[^a-z0-9-]/', '', str_replace([' ', '/'], '-', strtolower(transliterator_transliterate('Any-Latin; Latin-ASCII', $_POST['nom']))))
                'lien' => preg_replace('/[^a-z0-9-]/', '', str_replace([' ', '/'], '-', strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $_POST['nom']))))
            ];
            try {
                $this->articleModel->add($data);
                $newLien = $data['lien'];
                $_SESSION['successMsg'] = "L'article' a bien été ajouté.";
                header("Location: $newLien");
                exit;
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        // Mise à jour de la miniature
        if (isset($_POST['update'], $_FILES['miniature'], $_POST['miniature']) && $_FILES['miniature']['error'] === UPLOAD_ERR_OK) {

            $id = $_POST['update'];
            $current_file = $_POST['miniature'];
            $uploaded_file = $_FILES['miniature']['name'];
            $file_tmp = $_FILES['miniature']['tmp_name'];

            $this->fileManager->deleteFile($current_file); //Supprime l'ancienne bannière si elle existe

            $path = $this->FilePath . $id . DIRECTORY_SEPARATOR; //Génère le chemin du fichier

            $extension = pathinfo($uploaded_file, PATHINFO_EXTENSION); // Récupère l'extension du fichier
            $file_name = $id . "miniature" . uniqid() . '.' . $extension; // Génère un nom unique

            try {
                // Déplace le fichier avec le nouveau nom
                $this->fileManager->moveFile($file_tmp, $path, $file_name);
                //Modifie l'entrée BDD
                $miniaturePath = $path . $file_name;
                $this->articleModel->updateMiniature($id, $miniaturePath);
                $_SESSION['successMsg'] = "La miniature a bien été mise à jour."; //Output
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        //Mise a jour infos
        if (isset($_POST['update'], $_POST['nom'], $_POST['prix'], $_POST['categorie'], $_POST['description'])) {
            $data = [
                'id' => $_POST['update'],
                'nom' => $_POST['nom'],
                'prix' => $_POST['prix'],
                'categorie' => $_POST['categorie'],
                'description' => $_POST['description'],
                //'lien' => preg_replace('/[^a-z0-9-]/', '', str_replace([' ', '/'], '-', strtolower(transliterator_transliterate('Any-Latin; Latin-ASCII', $_POST['nom'])))),
                'lien' => preg_replace('/[^a-z0-9-]/', '', str_replace([' ', '/'], '-', strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $_POST['nom']))))

            ];
            try {
                $this->articleModel->update($data);

                $newLien = $data['lien'];
                $this->articleModel->getInfo($newLien);
                $_SESSION['successMsg'] = "L'article a bien été mis à jour"; //Output
                header("Location: $newLien");
                exit;
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage(); //Output
            }
        }

        //Suppression
        if (isset($_POST['delete'])) {
            $id = $_POST['delete'];
            $path = $this->FilePath . $id; //Génère le chemin du fichier

            try {
                $this->fileManager->deleteDir($path);
                $this->articleModel->delete($id);
                $_SESSION['warnMsg'] = "L'article a bien été supprimé.";
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        //MAJ affichage
        if (isset($_POST['setDisplay'])) {
            $affichage = isset($_POST['affichage']) ? 1 : 0;

            $data = [
                'id' => $_POST['setDisplay'],
                'affichage' => $affichage
            ];
            try {
                $this->articleModel->setDisplay($data);
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        // MAJ stocks
        if (isset($_POST['updateStock'], $_POST['quantite'])) {
            $quantiteData = $_POST['quantite']; // Récupérer les données des quantités depuis le formulaire

            try {
                // Validation des données (optionnelle mais recommandée)
                foreach ($quantiteData as $id => $quantites) {
                    foreach ($quantites as $taille => $valeur) {
                        if (!is_numeric($valeur) || $valeur < 0) {
                            throw new Exception("Les quantités doivent être des nombres positifs.");
                        }
                    }
                }

                // Appeler le modèle pour mettre à jour les quantités
                $this->articleColorisModel->updateStock($quantiteData);

                // Message de succès pour la session
                $_SESSION['successMsg'] = "Les stocks ont été mis à jour avec succès.";
            } catch (Exception $e) {
                // En cas d'erreur, stocker le message d'erreur dans la session
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }


        // Ajout coloris
        if (isset($_POST['addColoris'], $_POST['nom'], $_POST['coloris'])) {

            $data = [
                'id_article' => $_POST['addColoris'],
                'nom' => $_POST['nom'],
                'coloris' => $_POST['coloris'],
            ];
            try {
                //Modifie l'entrée BDD
                $this->articleColorisModel->add($data);
                $_SESSION['successMsg'] = "Le coloris a bien été ajouté"; //Output
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        // MAJ coloris
        if (isset($_POST['updateColoris'], $_POST['nom'], $_POST['coloris'])) {

            $data = [
                'id' => $_POST['updateColoris'],
                'nom' => $_POST['nom'],
                'coloris' => $_POST['coloris'],
            ];
            try {
                //Modifie l'entrée BDD
                $this->articleColorisModel->update($data);
                $_SESSION['successMsg'] = "Le coloris a bien été mis à jour"; //Output
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        // Suppression coloris
        if (isset($_POST['deleteColoris'])) {

            $id = $_POST['deleteColoris'];

            try {
                //Modifie l'entrée BDD
                $this->articleColorisModel->delete($id);
                $_SESSION['warnMsg'] = "Le coloris a bien été supprimé"; //Output
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        //Mise a jour infos
        if (isset($_POST['updateInfo'], $_POST['composition'], $_POST['taille'], $_POST['entretien'], $_POST['fabrication'])) {
            $data = [
                'id' => $_POST['updateInfo'],
                'composition' => $_POST['composition'],
                'taille' => $_POST['taille'],
                'entretien' => $_POST['entretien'],
                'fabrication' => $_POST['fabrication'],
            ];
            try {
                $this->articleModel->updateInfo($data);
                $_SESSION['successMsg'] = "L'article a bien été mis à jour"; //Output
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage(); //Output
            }
        }

        // Ajout photo
        if (isset($_POST['addImage'], $_FILES['photo_article']) && $_FILES['photo_article']['error'] === UPLOAD_ERR_OK) {

            $id_article = $_POST['addImage'];
            $uploaded_image = $_FILES['photo_article']['name'];
            $file_tmp = $_FILES['photo_article']['tmp_name'];

            $path = $this->FilePath . $id . DIRECTORY_SEPARATOR; //Génère le chemin du fichier

            $extension = pathinfo($uploaded_image, PATHINFO_EXTENSION); // Récupère l'extension du fichier
            $file_name = $id . "img" . uniqid() . '.' . $extension; // Génère un nom unique

            try {
                // Déplace le fichier avec le nouveau nom
                $this->fileManager->moveFile($file_tmp, $path, $file_name);
                //Modifie l'entrée BDD
                $imgPath = $path . $file_name;
                $this->articlePhotoModel->add($id_article, $imgPath);
                $_SESSION['successMsg'] = "La photo a bien été ajoutée."; //Output
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        // Supprimer photo
        if (isset($_POST['deleteImage'], $_POST['img_article'])) {

            $id = $_POST['deleteImage'];
            $path = $_POST['img_article'];

            try {
                // Supprime le fichier avec le nouveau nom
                $this->fileManager->deleteFile($path);
                //Modifie l'entrée BDD
                $this->articlePhotoModel->delete($id);
                $_SESSION['warnMsg'] = "La photo a bien été supprimée."; //Output
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }
    }
}
