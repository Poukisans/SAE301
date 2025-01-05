<?php
require_once 'Model.php';

class GeneralModel extends Model
{
    // ==================================== LISTE ====================================
    public function getInfo()
    {
        $sql = "SELECT meta_desc FROM `b_general`;";
        $statment = $this->executerRequete($sql);
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function updateMetaDesc($data)
    {
        extract($data);

        try {
            $sql = "UPDATE `b_general` SET meta_desc = :meta_desc";
            $this->executerRequete($sql, [
                ':meta_desc' => $meta_desc
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }
}
