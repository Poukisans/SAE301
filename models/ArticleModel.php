<?php
require_once 'Model.php';

class ArticleModel extends Model
{
  // Liste 
  public function getList()
  {
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
}
