<?php

class View {
    public function __construct($viewPath, $data = []) {
        // Extraire les variables du tableau $data
        extract($data);

        if (file_exists($viewPath)) {
            ob_start();
            require_once $viewPath; 
            $content = ob_get_clean(); 
    
            require_once 'views/layouts/main.php';
        } else {
            throw new Exception("La page indiquée n'existe pas ou a été supprimée.");
        }
    }
}
?>
