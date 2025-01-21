<?php
require_once 'Model.php';

class ArticleColorisModel extends Model
{
    // ==================================== LISTE ====================================
    public function getInfo($id_article)
    {
        $sql = "SELECT * FROM b_article_coloris WHERE id_article = :id_article";
        $statement = $this->executerRequete($sql, [':id_article' => $id_article]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== LISTE ====================================
    public function getBasket()
    {
        if (!isset($_SESSION['basket']) || empty($_SESSION['basket'])) {
            return []; // Retourne un tableau vide si le panier est vide
        }
        $ids = array_column($_SESSION['basket'], 'coloris');
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $sql = "SELECT * 
        FROM b_article_coloris
        WHERE id IN ($placeholders)";

        $params = array_merge($ids);
        $statement = $this->executerRequete($sql, $params);
        $coloris = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $coloris;
    }
}
