<?php
require_once 'Model.php';

class ArticleColorisModel extends Model
{
    // ==================================== LISTE ====================================
    public function getList($id_article)
    {
        $sql = "SELECT * FROM b_article_coloris WHERE id_article = :id_article";
        $statement = $this->executerRequete($sql, [':id_article' => $id_article]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== AJOUT ====================================
    public function add($data)
    {
        extract($data);

        try {
            $sql = "INSERT INTO b_article_coloris (id_article, nom, coloris) VALUES (:id_article, :nom, :coloris)";
            $this->executerRequete($sql, [
                ':id_article' => $id_article,
                ':nom' => $nom,
                ':coloris' => $coloris
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== SUPPRESSION ====================================
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM b_article_coloris WHERE id = :id ";
            $this->executerRequete($sql, [
                ':id' => $id,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }
}
