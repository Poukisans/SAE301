<?php
class Controller
{
    private $layoutContent;
    
    protected function __construct($url)
    {

        // Construire le tableau layoutContent
        $this->layoutContent = array(
        );
    }

    // Getter pour layoutContent
    protected function getLayoutContent()
    {
        return $this->layoutContent;
    }
}
