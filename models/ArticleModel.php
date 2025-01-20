<?php
require_once 'Model.php';

class ArticleModel extends Model
{
    // ==================================== LISTE ====================================
    public function getList()
    {
        $sql = "SELECT 
                a.id, 
                a.nom, 
                a.prix, 
                a.miniature, 
                a.affichage, 
                a.affichage_accueil, 
                a.categorie, 
                a.lien, 
                p.type AS type_promotion, 
                p.promotion AS taux_promotion,
                CASE 
                    WHEN p.id IS NOT NULL AND CURDATE() BETWEEN p.date_debut AND p.date_fin THEN 
                        CASE 
                            WHEN p.type = 0 THEN a.prix - (a.prix * p.promotion / 100)
                            WHEN p.type = 1 THEN p.promotion
                            WHEN p.type = 2 THEN 'lot'
                            ELSE a.prix
                        END
                    ELSE NULL
                END AS promotion,
                COUNT(com.id) AS commentaire, -- Nombre total de commentaires pour l'article
                ROUND(AVG(com.note), 2) AS note -- Moyenne des notes (arrondie à 2 décimales)
            FROM 
                b_articles a
            LEFT JOIN 
                b_promotion_articles pa ON a.id = pa.id_article
            LEFT JOIN 
                b_promotions p ON pa.id_promotion = p.id
            LEFT JOIN 
                b_article_commentaires com ON com.id_article = a.id
            WHERE
                a.affichage = 1
            GROUP BY 
                a.id, a.nom, a.prix, a.miniature, a.affichage, a.affichage_accueil, a.categorie, a.lien, 
                p.type, p.promotion, p.id, p.date_debut, p.date_fin
            ORDER BY 
                a.prix;";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== LISTE ====================================
    public function getListCategory($categorie)
    {
        $sql = "SELECT 
                a.id, 
                a.nom, 
                a.prix, 
                a.miniature, 
                a.affichage, 
                a.affichage_accueil, 
                a.categorie, 
                a.lien, 
                p.type AS type_promotion,
                p.promotion AS taux_promotion,
                CASE 
                    WHEN p.id IS NOT NULL AND CURDATE() BETWEEN p.date_debut AND p.date_fin THEN 
                        CASE 
                            WHEN p.type = 0 THEN a.prix - (a.prix * p.promotion / 100)
                            WHEN p.type = 1 THEN p.promotion
                            WHEN p.type = 2 THEN 'lot'
                            ELSE a.prix
                        END
                    ELSE NULL
                END AS promotion,
                COUNT(DISTINCT com.id) AS commentaire, -- Nombre total de commentaires (distincts) pour éviter les doublons
                ROUND(AVG(com.note), 2) AS note -- Moyenne des notes (arrondie à 2 décimales)
            FROM 
                b_articles a
            LEFT JOIN 
                b_promotion_articles pa ON a.id = pa.id_article
            LEFT JOIN 
                b_promotions p ON pa.id_promotion = p.id
            LEFT JOIN 
                b_article_commentaires com ON com.id_article = a.id
            WHERE
                a.affichage = 1 
                AND a.categorie = :categorie
            GROUP BY 
                a.id, a.nom, a.prix, a.miniature, a.affichage, a.affichage_accueil, a.categorie, a.lien
            ORDER BY 
                a.prix;";
        $statment = $this->executerRequete($sql, [':categorie' => $categorie]);

        $content = $statment->fetchAll(PDO::FETCH_ASSOC);
        return $content;
    }

    // ==================================== INFO ====================================
    public function getInfo($content)
    {
        $sql = "SELECT 
                a.*,
                p.type AS type_promotion, 
                p.promotion AS taux_promotion,
                CASE 
                    WHEN p.id IS NOT NULL AND CURDATE() BETWEEN p.date_debut AND p.date_fin THEN 
                        CASE 
                            WHEN p.type = 0 THEN a.prix - (a.prix * p.promotion / 100)
                            WHEN p.type = 1 THEN p.promotion
                            WHEN p.type = 2 THEN 'lot'
                            ELSE a.prix
                        END
                    ELSE NULL
                END AS promotion,
                ROUND(AVG(com.note), 1) AS note
            FROM 
                b_articles a
            LEFT JOIN 
                b_promotion_articles pa ON a.id = pa.id_article
            LEFT JOIN 
                b_promotions p ON pa.id_promotion = p.id
            LEFT JOIN 
                b_article_commentaires com ON com.id_article = a.id
            WHERE
                a.lien = :lien
            GROUP BY 
                a.id
            ORDER BY 
                a.nom;";
        $statment = $this->executerRequete($sql, [':lien' => $content]);

        $content = $statment->fetch(PDO::FETCH_ASSOC);

        if (!$content) {
            throw new Exception("404 Not Found : Article inconnu.");
        }

        return $content;
    }
}
