<?php
require_once 'Model.php';

class PromotionArticleModel extends Model
{
    // ==================================== LISTE ====================================
    public function getInfo($action)
    {
        $sql = "SELECT 
                b_articles.nom, 
                b_articles.prix, 
                b_articles.categorie,
                p.type, 
                b_promotion_articles.*,
                CASE 
                    WHEN p.id IS NOT NULL AND CURDATE() BETWEEN p.date_debut AND p.date_fin THEN 
                        CASE 
                            WHEN p.type = 0 THEN b_articles.prix - (b_articles.prix * p.promotion / 100)
                            WHEN p.type = 1 THEN p.promotion
                            WHEN p.type = 2 THEN p.promotion
                            ELSE b_articles.prix
                        END
                    ELSE null
                END AS prix_promotion
            FROM 
                b_promotion_articles 
            LEFT JOIN 
                b_articles ON b_articles.id = b_promotion_articles.id_article
            LEFT JOIN 
                b_promotions p ON b_promotion_articles.id_promotion = p.id
            WHERE 
                b_promotion_articles.id_promotion = :action;";
        $statment = $this->executerRequete($sql, [
            ':action' => $action,
        ]);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== AJOUT ====================================
    public function addArticle($id_promotion, $data)
    {
        try {
            $sql = "INSERT INTO b_promotion_articles (id_article, id_promotion) VALUES (:id_article, :id_promotion)";

            foreach ($data as $article) {
                $this->executerRequete($sql, [
                    ':id_promotion' => $id_promotion,
                    ':id_article' => $article,
                ]);
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== SUPPRESSION ====================================
    public function deleteArticle($id_promotion, $id_article)
    {
        try {
            $sql = "DELETE FROM b_promotion_articles WHERE id_promotion = :id_promotion AND id_article = :id_article";
            $this->executerRequete($sql, [
                ':id_promotion' => $id_promotion,
                ':id_article' => $id_article,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }
}
