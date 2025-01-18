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
    public function getInfo($id)
    {
        $sql = "SELECT 
                p.*,
                CASE 
                    WHEN p.id IS NOT NULL AND NOW() BETWEEN p.date_debut AND p.date_fin THEN 
                        CASE 
                            WHEN p.type = 0 THEN a.prix - (a.prix * p.promotion / 100)
                            WHEN p.type = 1 THEN p.promotion
                            WHEN p.type = 2 THEN 'lot'
                            ELSE a.prix
                        END
                    ELSE null
                END AS 'promotion'
            FROM 
                b_promotions p
            LEFT JOIN 
                b_promotion_articles pa ON p.id = pa.id_promotion
            LEFT JOIN 
                b_articles a ON pa.id_article = a.id
            WHERE
                p.id = 1
            ORDER BY 
                a.nom;";
        $statment = $this->executerRequete($sql, [':id' => $id]);

        $content = $statment->fetch(PDO::FETCH_ASSOC);

        if (!$content) {
            throw new Exception("404 Not Found : Promotion inconnue.");
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
