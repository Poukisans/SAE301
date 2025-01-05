<?php
require_once 'Model.php';

class ReseauxModel extends Model
{
    // ==================================== LISTE ====================================
    public function getList()
    {
        $sql = "SELECT * FROM `b_socials`;";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== AJOUT ====================================
    public function add($data)
    {
        extract($data);

        try {
            $sql = "INSERT INTO `b_socials` (nom, lien) VALUES (:nom, :lien)";
            $this->executerRequete($sql, [
                ':nom' => $nom,
                ':lien' => $lien
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== SUPPRESSION ====================================
    public function delete($data) {

        try {
            $sql = "DELETE FROM b_socials WHERE id = :id ";
            $this->executerRequete($sql, [
                ':id' => $data,
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
            $sql = "UPDATE `b_socials` SET nom = :nom, lien = :lien WHERE id = :id";
            $this->executerRequete($sql, [
                ':nom' => $nom,
                ':lien' => $lien,
                ':id' => $id
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }
}
