<?php
class Controller
{
    private $layoutContent;

    protected function __construct($url)
    {

        // Récupérer les informations générales
        $generalModel = new GeneralModel();
        $generalInfo = $generalModel->getInfo();

        // Récupérer les sections
        $sectionModel = new SectionModel();
        $sectionList = $sectionModel->getList();
        $sectionInfo = $sectionModel->getInfo($url);

        // Récupérer les réseaux
        $socialModel = new SocialModel();
        $socialList = $socialModel->getList();

        // Construire le tableau layoutContent
        $this->layoutContent = array(
            'sectionList' => $sectionList,
            'sectionNom' => $sectionInfo['nom'],
            'banner' => $sectionInfo['banner'],
            'meta_desc' => $generalInfo['meta_desc'],
            'socialList' => $socialList,
        );
    }

    // Getter pour layoutContent
    protected function getLayoutContent()
    {
        return $this->layoutContent;
    }
}
