<?php
class Controller
{
    private $commandModel;
    private $layoutContent;

    protected function __construct()
    {
        // Récupérer les sections
        $this->commandModel = new CommandeModel();
        $commandLeft = $this->commandModel->getLeft();

        // Construire le tableau layoutContent
        $this->layoutContent = array(
            'commandLeft' => $commandLeft
        );
    }

    // Getter pour layoutContent
    protected function getLayoutContent()
    {
        return $this->layoutContent;
    }
}
