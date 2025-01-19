<?php
require_once 'Model.php';

class CommandeArticleModel extends Model
{
    // ==================================== LISTE ====================================
    public function getInfo($action)
    {
        $sql = "SELECT commande.*, article.nom AS nom_article, coloris.nom AS nom_coloris FROM b_commande_article AS commande 
                LEFT JOIN b_article_coloris AS coloris ON coloris.id = commande.id_coloris
                LEFT JOIN b_articles AS article ON article.id = coloris.id_article
                WHERE commande.id_commande = :action";

        $statment = $this->executerRequete($sql, [
            ':action' => $action,
        ]);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== REMISE EN STOCK ====================================
    public function cancel($data)
    {

        extract($data);

        $sql = "UPDATE b_article_coloris ac
                JOIN b_commande_article ca ON ac.id = ca.id_coloris
                SET 
                    ac.quantite_xxs = ac.quantite_xxs + CASE WHEN ca.id_taille = 1 THEN ca.quantite ELSE 0 END,
                    ac.quantite_xs = ac.quantite_xs + CASE WHEN ca.id_taille = 2 THEN ca.quantite ELSE 0 END,
                    ac.quantite_s = ac.quantite_s + CASE WHEN ca.id_taille = 3 THEN ca.quantite ELSE 0 END,
                    ac.quantite_m = ac.quantite_m + CASE WHEN ca.id_taille = 4 THEN ca.quantite ELSE 0 END,
                    ac.quantite_l = ac.quantite_l + CASE WHEN ca.id_taille = 5 THEN ca.quantite ELSE 0 END,
                    ac.quantite_xl = ac.quantite_xl + CASE WHEN ca.id_taille = 6 THEN ca.quantite ELSE 0 END,
                    ac.quantite_xxl = ac.quantite_xxl + CASE WHEN ca.id_taille = 7 THEN ca.quantite ELSE 0 END
                WHERE ca.id_commande = :action;";

        $statment = $this->executerRequete($sql, [
            ':action' => $id_commande,
        ]);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }
}
