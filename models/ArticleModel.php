<?php
require_once 'Model.php';

class ArticleModel extends Model
{
    // ==================================== LISTE ====================================
    public function getList()
    {
        $sql = "SELECT 
                a.id AS id_article, 
                a.nom, 
                a.prix AS prix_origine, 
                a.miniature, 
                a.categorie, 
                a.affichage_accueil,
                a.lien, 
                CASE 
                    WHEN p.id IS NOT NULL AND CURDATE() BETWEEN p.date_debut AND p.date_fin THEN p.type
                    ELSE NULL
                END AS type_promotion,
                CASE 
                    WHEN p.id IS NOT NULL AND CURDATE() BETWEEN p.date_debut AND p.date_fin THEN p.promotion
                    ELSE NULL
                END AS taux_promotion,
                ROUND(
                    CASE 
                        WHEN p.id IS NOT NULL AND CURDATE() BETWEEN p.date_debut AND p.date_fin THEN 
                            CASE 
                                WHEN p.type = 0 THEN a.prix - (a.prix * p.promotion / 100)
                                WHEN p.type = 1 THEN p.promotion
                                ELSE a.prix
                            END
                        ELSE a.prix
                    END, 2
                ) AS prix, 
                COUNT(com.id) AS commentaire,
                ROUND(AVG(com.note), 2) AS note,
                c.id AS id_coloris
            FROM 
                b_articles a
            LEFT JOIN 
                b_promotion_articles pa ON a.id = pa.id_article
            LEFT JOIN 
                b_promotions p ON pa.id_promotion = p.id
            LEFT JOIN 
                b_article_commentaires com ON com.id_article = a.id
            LEFT JOIN 
                b_article_coloris c ON c.id_article = a.id
            WHERE
                a.affichage = 1
            GROUP BY 
                a.id
            ORDER BY 
                prix;";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== LISTE ====================================
    public function getListCategory($categorie, $order)
    {
        $sql = "SELECT 
                a.id AS id_article, 
                a.nom, 
                a.prix AS prix_origine, 
                a.miniature, 
                a.categorie, 
                a.affichage_accueil,
                a.lien, 
                CASE 
                    WHEN p.id IS NOT NULL AND CURDATE() BETWEEN p.date_debut AND p.date_fin THEN p.type
                    ELSE NULL
                END AS type_promotion,
                CASE 
                    WHEN p.id IS NOT NULL AND CURDATE() BETWEEN p.date_debut AND p.date_fin THEN p.promotion
                    ELSE NULL
                END AS taux_promotion,
                ROUND(
                    CASE 
                        WHEN p.id IS NOT NULL AND CURDATE() BETWEEN p.date_debut AND p.date_fin THEN 
                            CASE 
                                WHEN p.type = 0 THEN a.prix - (a.prix * p.promotion / 100)
                                WHEN p.type = 1 THEN p.promotion
                                ELSE a.prix
                            END
                        ELSE a.prix
                    END, 2
                ) AS prix, 
                COUNT(com.id) AS commentaire,
                ROUND(AVG(com.note), 2) AS note,
                c.id AS id_coloris
            FROM 
                b_articles a
            LEFT JOIN 
                b_promotion_articles pa ON a.id = pa.id_article
            LEFT JOIN 
                b_promotions p ON pa.id_promotion = p.id
            LEFT JOIN 
                b_article_commentaires com ON com.id_article = a.id
            LEFT JOIN 
                b_article_coloris c ON c.id_article = a.id
            WHERE
                a.affichage = 1
            AND
                a.categorie = :categorie
            GROUP BY 
                a.id
            ORDER BY 
                prix $order;";
        $statment = $this->executerRequete($sql, [
            ':categorie' => $categorie,
        ]);

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

    // ==================================== RECHERCHE ====================================
    public function search($query)
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
            AND (
                REPLACE(LOWER(a.nom), ' ', '-') COLLATE utf8mb4_general_ci LIKE :query
                OR REPLACE(LOWER(a.categorie), ' ', '-') COLLATE utf8mb4_general_ci LIKE :query
            )
            GROUP BY 
                a.id
            ORDER BY 
                a.id;";

        $statement = $this->executerRequete($sql, [':query' => $query]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== PANIER ====================================
    public function getBasket($data)
    {
        // Extraction des données

        extract($data);        
        // Récupération des informations de l'article via la requête SQL
        $sql = "SELECT 
                a.id AS id_article, 
                a.nom, 
                a.prix AS prix_origine, 
                a.miniature, 
                a.categorie, 
                a.lien, 
                CASE 
                    WHEN p.id IS NOT NULL AND CURDATE() BETWEEN p.date_debut AND p.date_fin THEN p.type
                    ELSE NULL
                END AS type_promotion,
                CASE 
                    WHEN p.id IS NOT NULL AND CURDATE() BETWEEN p.date_debut AND p.date_fin THEN p.promotion
                    ELSE NULL
                END AS taux_promotion,
                ROUND(
                    CASE 
                        WHEN p.id IS NOT NULL AND CURDATE() BETWEEN p.date_debut AND p.date_fin THEN 
                            CASE 
                                WHEN p.type = 0 THEN a.prix - (a.prix * p.promotion / 100)
                                WHEN p.type = 1 THEN p.promotion
                                ELSE a.prix
                            END
                        ELSE a.prix
                    END, 2
                ) AS prix, 
                c.nom AS coloris_nom
            FROM 
                b_articles a
            LEFT JOIN 
                b_promotion_articles pa ON a.id = pa.id_article
            LEFT JOIN 
                b_promotions p ON pa.id_promotion = p.id
            LEFT JOIN 
                b_article_coloris c ON c.id_article = a.id
            WHERE
                a.id = :id_article AND c.id = :id_coloris
            LIMIT 1";
    
        // Préparation et exécution de la requête SQL
        $statment = $this->executerRequete($sql, [
            ':id_article' => $id_article,
            ':id_coloris' => $coloris
        ]);
        
        $article = $statment->fetch(PDO::FETCH_ASSOC);
        print_r($article);
    
        // Vérification que l'article existe dans la base de données
        if ($article) {
            // Préparer les données à ajouter au panier
            $articleData = [
                'id_article' => $article['id_article'],
                'nom' => $article['nom'],
                'lien' => $article['lien'],
                'prix_origine' => $article['prix_origine'],
                'prix' => $article['prix'],
                'miniature' => $article['miniature'],
                'type_promotion' => $article['type_promotion'],
                'taux_promotion' => $article['taux_promotion'],
                'coloris' => $article['coloris_nom'],
                'quantite' => $quantite, // Utiliser la quantité passée depuis le contrôleur
                'taille' => $taille
            ];
    
            // Vérifier si l'article est déjà dans le panier (si un article avec le même id et coloris existe)
            $articleExists = false;
            if (isset($_SESSION['basket'])) {
                foreach ($_SESSION['basket'] as &$basketItem) {
                    if (
                        $basketItem['id_article'] === $articleData['id_article'] &&
                        $basketItem['coloris'] === $articleData['coloris'] &&
                        $basketItem['taille'] === $articleData['taille']
                    ) {
                        // Si l'article existe déjà, on met à jour la quantité (on l'incrémente)
                        $basketItem['quantite'] += $articleData['quantite'];
                        $articleExists = true;
                        break;
                    }
                }
            }
    
            // Si l'article n'est pas dans le panier, on l'ajoute
            if (!$articleExists) {
                $_SESSION['basket'][] = $articleData;
            }
        }
    }
    




    // ==================================== LISTE ====================================
    public function getPromoList()
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
            AND
                p.type = 0
            GROUP BY 
                a.id
            ORDER BY 
                a.prix;";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== LISTE ====================================
    public function getOffreList()
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
            AND
                p.type = 1
            GROUP BY 
                a.id
            ORDER BY 
                a.prix;";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }
}
