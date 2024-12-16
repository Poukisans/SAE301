<?php
require_once 'Model.php';

class ArticleModel extends Model
{
  // Liste 
  public function getList()
  {

    $condition = NULL;

    $sql = "SELECT 
    a.id,
    a.nom,
    a.lien,
    a.miniature,
    a.categorie,
    CASE 
        WHEN p.id IS NOT NULL AND NOW() BETWEEN p.date_debut AND p.date_fin THEN p.rabais
        ELSE NULL
    END AS rabais,
    CASE 
        WHEN p.id IS NOT NULL AND NOW() BETWEEN p.date_debut AND p.date_fin THEN p.prix_force
        ELSE NULL
    END AS prix_force,
    CASE 
        WHEN p.id IS NOT NULL AND NOW() BETWEEN p.date_debut AND p.date_fin THEN 
            CASE 
                WHEN p.prix_force IS NOT NULL THEN p.prix_force
                WHEN p.rabais IS NOT NULL THEN a.prix - (a.prix * p.rabais / 100)
                ELSE a.prix
            END
        ELSE a.prix
    END AS prix
FROM 
    b_articles a
LEFT JOIN 
    b_promotion_articles pa ON a.id = pa.id_article
LEFT JOIN 
    b_promotions p ON pa.id_promotion = p.id
ORDER BY 
    a.nom;
   ";

    $statment = $this->executerRequete($sql);
    return $statment->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getListCategory($categorie)
  {

    $condition = NULL;

    $sql = "SELECT 
    a.id,
    a.nom,
    a.lien,
    a.miniature,
    a.categorie,
    CASE 
        WHEN p.id IS NOT NULL AND NOW() BETWEEN p.date_debut AND p.date_fin THEN p.rabais
        ELSE NULL
    END AS rabais,
    CASE 
        WHEN p.id IS NOT NULL AND NOW() BETWEEN p.date_debut AND p.date_fin THEN p.prix_force
        ELSE NULL
    END AS prix_force,
    CASE 
        WHEN p.id IS NOT NULL AND NOW() BETWEEN p.date_debut AND p.date_fin THEN 
            CASE 
                WHEN p.prix_force IS NOT NULL THEN p.prix_force
                WHEN p.rabais IS NOT NULL THEN a.prix - (a.prix * p.rabais / 100)
                ELSE a.prix
            END
        ELSE a.prix
    END AS prix
FROM 
    b_articles a
LEFT JOIN 
    b_promotion_articles pa ON a.id = pa.id_article
LEFT JOIN 
    b_promotions p ON pa.id_promotion = p.id
WHERE
    a.categorie = :categorie
ORDER BY 
    a.nom;
   ";

    $statment = $this->executerRequete($sql, [':categorie' => $categorie]);
    return $statment->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getInfo($action)
  {
    $sql = "SELECT * FROM b_articles WHERE lien = :action;";
    $statment = $this->executerRequete($sql, [':action' => $action]);
    $content = $statment->fetch(PDO::FETCH_ASSOC);

    if (!$content) {
      throw new Exception("404 Not Found : Article inconnu.");
    }

    return $content;
  }
}
