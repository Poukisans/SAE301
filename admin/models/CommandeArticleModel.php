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
}
