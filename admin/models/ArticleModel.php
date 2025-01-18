<?php
require_once 'Model.php';

class ArticleModel extends Model
{
    // ==================================== LISTE ====================================
    public function getList()
    {
        $sql = "SELECT id, nom, prix, miniature, affichage, lien FROM b_articles ORDER BY id DESC";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== INFO ====================================
    public function getInfo($content)
    {
        $sql = "SELECT 
                a.*,
                p.type,
                p.id AS id_promotion,
                CASE 
                    WHEN p.id IS NOT NULL AND NOW() BETWEEN p.date_debut AND p.date_fin THEN 
                        CASE 
                            WHEN p.type = 0 THEN a.prix - (a.prix * p.promotion / 100)
                            WHEN p.type = 1 THEN p.promotion
                            WHEN p.type = 2 THEN 'lot'
                            ELSE a.prix
                        END
                    ELSE null
                END AS 'promotion'
            FROM 
                b_articles a
            LEFT JOIN 
                b_promotion_articles pa ON a.id = pa.id_article
            LEFT JOIN 
                b_promotions p ON pa.id_promotion = p.id
            WHERE
                a.lien = :lien
            ORDER BY 
                a.nom;";
        $statment = $this->executerRequete($sql, [':lien' => $content]);

        $content = $statment->fetch(PDO::FETCH_ASSOC);

        if (!$content) {
            throw new Exception("404 Not Found : Article inconnu.");
        }

        return $content;
    }

    // ==================================== AJOUT ====================================
    public function add($data)
    {
        extract($data);

        try {
            $sql = "INSERT INTO b_articles (nom, categorie, lien) VALUES (:nom, :categorie, :lien)";
            $this->executerRequete($sql, [
                ':nom' => $nom,
                ':categorie' => $categorie,
                ':lien' => $lien,
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
            $sql = "UPDATE b_articles SET nom = :nom, prix = :prix, categorie = :categorie, description = :description, lien = :lien  WHERE id = :id";
            $this->executerRequete($sql, [
                ':id' => $id,
                ':nom' => $nom,
                ':prix' => $prix,
                ':categorie' => $categorie,
                ':description' => $description,
                ':lien' => $lien,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== UPDATE MINIATURE ====================================
    public function updateMiniature($id, $miniaturePath)
    {
        try {
            $sql = "UPDATE b_articles SET miniature = :miniature WHERE id = :id";
            $this->executerRequete($sql, [
                ':miniature' => $miniaturePath,
                ':id' => $id
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== SUPPRESSION ====================================
    public function delete($data)
    {
        try {
            $sql = "DELETE FROM b_articles WHERE id = :id ";
            $this->executerRequete($sql, [
                ':id' => $data,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== AFFICHER/MASQUER ====================================
    public function setDisplay($data)
    {
        extract($data);

        try {
            $sql = "UPDATE b_articles SET affichage = :affichage WHERE id = :id";
            $this->executerRequete($sql, [
                ':id' => $id,
                ':affichage' => $affichage,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }
}
