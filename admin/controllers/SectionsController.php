<?php
require_once('./views/View.php');
require_once('./controllers/Controller.php');

class SectionsController extends Controller
{
    private $_view;
    private $layoutContent;
    private $fileManager;
    private $sectionModel;
    private $sectionFilePath;

    public function __construct($url)
    {
        parent::__construct(); // Appeler le constructeur de la classe parente pour initialiser les informations générales
        $this->layoutContent = $this->getLayoutContent();

        $this->sectionFilePath = "public/sections/";

        $this->sectionModel =  new SectionModel;
        $this->fileManager =  new FileManager;

        if ($url[0] == "sections") {

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
        $sectionList = $this->sectionModel->getList();

        $this->_view = new View("views/" . $url . ".php", [
            'layoutContent' => $this->layoutContent,
            'currentPage' => ucwords($url),
            'currentContent' => ("section"),
            'sectionList' => $sectionList,
        ]);
    }

    private function handlePostRequest()
    {
        //Maj section
        if (isset($_POST['update'], $_POST['nom'])) {
            $data = [
                'id' => $_POST['update'],
                'nom' => $_POST['nom'],
                'affichage' => isset($_POST['affichage']) ? 1 : 0,
                'affichage_nav' => isset($_POST['affichage_nav']) ? 1 : 0,
                'affichage_footer' => isset($_POST['affichage_footer']) ? 1 : 0,

            ];
            try {
                $this->sectionModel->update($data);
                $_SESSION['successMsg'] = "La section a bien été modifiée.";
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        // Mise à jour de la bannière
        if (isset($_POST['update'], $_FILES['banner'], $_POST['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {

            $id = $_POST['update'];
            $current_file = $_POST['banner'];
            $uploaded_file = $_FILES['banner']['name'];
            $file_tmp = $_FILES['banner']['tmp_name'];

            $this->fileManager->deleteFile($current_file); //Supprime l'ancienne bannière si elle existe

            $path = $this->sectionFilePath; //Génère le chemin du fichier

            $extension = pathinfo($uploaded_file, PATHINFO_EXTENSION); // Récupère l'extension du fichier
            $file_name = $id . "banniere" . uniqid() . '.' . $extension; // Génère un nom unique

            try {
                // Déplace le fichier avec le nouveau nom
                $this->fileManager->moveFile($file_tmp, $path, $file_name);
                //Modifie l'entrée BDD
                $bannerPath = $path . $file_name;
                $this->sectionModel->updateBanner($id, $bannerPath);
                $_SESSION['successMsg'] = "La bannière a bien été mise à jour."; //Output
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }

        // Supprimer la bannière
        if (isset($_POST['deleteBanner'], $_POST['banner'])) {

            $id = $_POST['deleteBanner'];
            $current_file = $_POST['banner'];

            try {
                $this->fileManager->deleteFile($current_file);
                $this->sectionModel->updateBanner($id, null);
                $_SESSION['warnMsg'] = "La bannière a bien été supprimée."; //Output   
            } catch (Exception $e) {
                $_SESSION['errorMsg'] = "Erreur : " . $e->getMessage();
            }
        }
    }
}
