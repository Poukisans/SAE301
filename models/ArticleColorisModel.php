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
}
