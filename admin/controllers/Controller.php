<?php
class Controller
{
    private $contactModel;
    private $layoutContent;

    protected function __construct()
    {
        // Récupérer les sections


        // Construire le tableau layoutContent
        $this->layoutContent = array(
            '' => 0
        );
    }

    // Getter pour layoutContent
    protected function getLayoutContent()
    {
        return $this->layoutContent;
    }
}
