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
    // ==================================== CONTACT ====================================
    public function getContact()
    {
        $sql = "SELECT contact_title, contact FROM `b_general`;";
        $statment = $this->executerRequete($sql);
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function updateContact($data)
    {
        extract($data);

        try {
            $sql = "UPDATE b_general SET contact_title = :contact_title, contact = :contact";
            $this->executerRequete($sql, [
                ':contact_title' => $contact_title,
                ':contact' => $contact,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== MENTIONS LEGALES ====================================
    public function getLegal()
    {
        $sql = "SELECT mentions_legales FROM `b_general`;";
        $statment = $this->executerRequete($sql);
        return $statment->fetch(PDO::FETCH_ASSOC);
    }

    public function updateLegal($data)
    {
        extract($data);

        try {
            $sql = "UPDATE b_general SET mentions_legales = :mentions_legales";
            $this->executerRequete($sql, [
                ':mentions_legales' => $mentions_legales,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
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
