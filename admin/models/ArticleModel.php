<?php
require_once 'Model.php';

class ArticleModel extends Model
{
    // ==================================== LISTE ====================================
    public function getList()
    {
        $sql = "SELECT id, nom, prix, miniature, affichage, lien FROM b_articles";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== INFO ====================================
    public function getInfo($content)
    {
        $sql = "SELECT * FROM b_articles WHERE lien = :lien";
        $statement = $this->executerRequete($sql, [':lien' => $content]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    // ==================================== UPDATE INFO ====================================
    public function update($data)
    {
        extract($data);

        try {
            $sql = "UPDATE b_articles SET nom = :nom, prix = :prix, categorie = :categorie, description = :description, lien = :lien  WHERE id = :id";
            $this->executerRequete($sql, [
                ':id' => $id,
                ':nom' => $nom,
                ':prix' => $prix,
                ':categorie' => $categorie,
                ':description' => $description,
                ':lien' => $lien,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== UPDATE MINIATURE ====================================
    public function updateMiniature($id, $miniaturePath)
    {
        try {
            $sql = "UPDATE b_articles SET miniature = :miniature WHERE id = :id";
            $this->executerRequete($sql, [
                ':miniature' => $miniaturePath,
                ':id' => $id
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== SUPPRESSION ====================================
    public function delete($data)
    {
        try {
            $sql = "DELETE FROM b_articles WHERE id = :id ";
            $this->executerRequete($sql, [
                ':id' => $data,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== AFFICHER/MASQUER ====================================
    public function setDisplay($data)
    {
        extract($data);

        try {
            $sql = "UPDATE b_articles SET affichage = :affichage WHERE id = :id";
            $this->executerRequete($sql, [
                ':id' => $id,
                ':affichage' => $affichage,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }
}
