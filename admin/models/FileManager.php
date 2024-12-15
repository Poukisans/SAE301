<?php

class FileManager
{
    //=============== CREER DOSSIER ===============
    private function createDir($path)
    {
        $serverPath = $_SERVER['DOCUMENT_ROOT'] . $path;
        if (!file_exists($serverPath)) {
            if (!mkdir($serverPath, 0751, true)) { // `true` pour création récursive
                throw new Exception("Erreur lors de la création du dossier : $serverPath");
            }
        }
    }

    //=============== SUPPRIMER FICHIER ===============
    public function deleteFile($path)
    {
        $serverPath = $_SERVER['DOCUMENT_ROOT'] . $path;
    
        // Si le fichier n'existe pas ou n'est pas un fichier, quitter la fonction sans erreur
        if (!file_exists($serverPath) || !is_file($serverPath)) {
            return; // Quitter sans interruption si le fichier est introuvable
        }
    
        // Tente de supprimer le fichier et lance une exception en cas d'erreur
        if (!unlink($serverPath)) {
            throw new Exception("Échec de la suppression du fichier : $serverPath");
        }
    }
    

    //=============== DEPLACER FICHIER ===============
    public function moveFile($file_tmp, $path, $file_name)
    {
        $serverPath = $_SERVER['DOCUMENT_ROOT'] . $path;
        // Vérifie si le répertoire existe, sinon le crée avec des permissions appropriées
        if (!is_dir($serverPath)) {
            $this->createDir($path);
        }

        // Déplace le fichier vers le chemin cible
        if (move_uploaded_file($file_tmp, $serverPath.$file_name)) {
            return true; // Retourne true si le déplacement est réussi
        } else {
            throw new Exception("Le fichier n'a pas pu être déplacé vers le répertoire spécifié.");
        }
    }

    //=============== SUPPRIMER DOSSIER ET CONTENU ===============
    public function deleteDir($path)
    {
        $serverPath = $_SERVER['DOCUMENT_ROOT'] . $path;
        if (!is_dir($serverPath)) {
            return; // Quitte si $path n'est pas un dossier
        }

        $files = scandir($serverPath);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $filePath = $serverPath . '/' . $file;

                // Supprime récursivement les sous-dossiers, ou les fichiers directement
                if (is_dir($filePath)) {
                    $this->deleteDir($filePath);
                } else {
                    if (!unlink($filePath)) {
                        throw new Exception("Erreur lors de la suppression du fichier : $filePath");
                    }
                }
            }
        }

        // Supprime le dossier lui-même et vérifie si la suppression a réussi
        if (!rmdir($serverPath)) {
            throw new Exception("Erreur lors de la suppression du dossier : $serverPath");
        }
    }
}
