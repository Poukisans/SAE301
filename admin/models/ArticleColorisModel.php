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

    // ==================================== UPDATE INFO ====================================
    public function update($data)
    {
        extract($data);

        try {
            $sql = "UPDATE b_article_coloris SET nom = :nom, coloris = :coloris WHERE id = :id";
            $this->executerRequete($sql, [
                ':id' => $id,
                ':nom' => $nom,
                ':coloris' => $coloris,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== UPDATE STOCK ====================================
    public function updateStock($data)
    {
        try {
            // Préparer la requête SQL pour mettre à jour les quantités
            $sql = "UPDATE b_article_coloris 
                SET quantite_xxs = :quantite_xxs, 
                    quantite_xs = :quantite_xs, 
                    quantite_s = :quantite_s, 
                    quantite_m = :quantite_m, 
                    quantite_l = :quantite_l, 
                    quantite_xl = :quantite_xl, 
                    quantite_xxl = :quantite_xxl 
                WHERE id = :id";

            // Boucler sur chaque entrée à mettre à jour
            foreach ($data as $id => $quantites) {
                $this->executerRequete($sql, [
                    ':id' => $id,
                    ':quantite_xxs' => $quantites['xxs'],
                    ':quantite_xs' => $quantites['xs'],
                    ':quantite_s' => $quantites['s'],
                    ':quantite_m' => $quantites['m'],
                    ':quantite_l' => $quantites['l'],
                    ':quantite_xl' => $quantites['xl'],
                    ':quantite_xxl' => $quantites['xxl'],
                ]);
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour des stocks en BDD: " . $e->getMessage());
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
