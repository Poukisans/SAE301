<?php
require_once 'Model.php';

class PromotionModel extends Model
{
    // ==================================== LISTE ====================================
    public function getList()
    {
        $sql = "SELECT id, nom, date_debut, date_fin FROM b_promotions";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== LISTE ====================================
    public function getInfo()
    {
        $sql = "SELECT * FROM `promotions`";
        $statment = $this->executerRequete($sql);
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    // ==================================== AJOUT ====================================
    public function add($id_article, $path)
    {
        try {
            $sql = "INSERT INTO b_article_photos (id_article, img_article) VALUES (:id_article, :img_article)";
            $this->executerRequete($sql, [
                ':id_article' => $id_article,
                ':img_article' => $path
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== SUPPRESSION ====================================
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM b_article_photos WHERE id = :id ";
            $this->executerRequete($sql, [
                ':id' => $id,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }
}
