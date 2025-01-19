<?php
require_once 'Model.php';

class PromotionModel extends Model
{
    // ==================================== LISTE ====================================
    public function getListNext()
    {
        $sql = "SELECT id, nom, date_debut, date_fin, type
                FROM b_promotions p
                WHERE p.date_debut > NOW() AND p.date_fin > CURDATE();";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getListCurrent()
    {
        $sql = "SELECT id, nom, date_debut, date_fin, type
                FROM b_promotions p
                WHERE CURDATE() BETWEEN p.date_debut AND p.date_fin;";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getListArchived()
    {
        $sql = "SELECT id, nom, date_debut, date_fin, type
                FROM b_promotions p
                WHERE p.date_fin < CURDATE();";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== LISTE ====================================
    public function getInfo($id)
    {
        $sql = "SELECT 
                *
            FROM 
                b_promotions
            WHERE
                id = :id;";
        $statment = $this->executerRequete($sql, [':id' => $id]);

        $content = $statment->fetch(PDO::FETCH_ASSOC);

        if (!$content) {
            throw new Exception("404 Not Found : Promotion inconnue.");
        }

        return $content;
    }

    // ==================================== AJOUT ====================================
    public function add($data)
    {
        extract($data);

        try {
            $sql = "INSERT INTO b_promotions (nom, type, date_debut, date_fin) VALUES (:nom, :type, :date_debut, :date_fin)";
            $this->executerRequete($sql, [
                ':nom' => $nom,
                ':type' => $type,
                ':date_debut' => $date_debut,
                ':date_fin' => $date_fin,
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
            $sql = "UPDATE b_promotions SET nom = :nom, type = :type, promotion = :promotion, date_debut = :date_debut, date_fin = :date_fin WHERE id = :id";
            $this->executerRequete($sql, [
                ':id' => $id,
                ':nom' => $nom,
                ':type' => $type,
                ':promotion' => $promotion,
                ':date_debut' => $date_debut,
                ':date_fin' => $date_fin,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== SUPPRESSION ====================================
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM b_promotions WHERE id = :id ";
            $this->executerRequete($sql, [
                ':id' => $id,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }
}
