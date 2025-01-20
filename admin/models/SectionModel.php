<?php
require_once 'Model.php';

class SectionModel extends Model
{
    // ==================================== LISTE ====================================
    public function getList()
    {
        $sql = "SELECT * FROM `b_sections`;";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== UPDATE INFO ====================================
    public function update($data)
    {
        extract($data);

        try {
            $sql = "UPDATE `b_sections` SET nom = :nom, affichage_nav = :affichage_nav, affichage_footer = :affichage_footer WHERE id = :id";
            $this->executerRequete($sql, [
                ':nom' => $nom,
                ':affichage_nav' => $affichage_nav,
                ':affichage_footer' => $affichage_footer,
                ':id' => $id
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    public function updateBanner($id, $bannerPath)
    {
        try {
            $sql = "UPDATE `b_sections` SET banner = :banner WHERE id = :id";
            $this->executerRequete($sql, [
                ':banner' => $bannerPath,
                ':id' => $id
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }
}
