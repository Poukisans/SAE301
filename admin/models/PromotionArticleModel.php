<?php
require_once 'Model.php';

class PromotionArticleModel extends Model
{
    // ==================================== LISTE ====================================
    public function getInfo($id_promotion)
    {
        $sql = "SELECT b_articles.nom, b_articles.prix, b_articles.categorie, b_promotion_articles.*
                FROM `b_promotion_articles` 
                LEFT JOIN b_articles ON b_articles.id = b_promotion_articles.id_article
                WHERE id_promotion = :id_promotion";
        $statment = $this->executerRequete($sql, [':id_promotion' => $id_promotion]);

        $content = $statment->fetchAll(PDO::FETCH_ASSOC);

        if (!$content) {
            throw new Exception("404 Not Found : Article Promotion inconnue.");
        }

        return $content;
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
