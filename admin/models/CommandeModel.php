<?php
require_once 'Model.php';

class CommandeModel extends Model
{
    // ==================================== LISTE ====================================
    public function getList()
    {
        $sql = "SELECT id, date, nom, prenom, statut FROM b_commandes ORDER BY id DESC";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== LISTE FILTREE ====================================
    public function getFilteredList($action)
    {
        $sql = "SELECT id, date, nom, prenom, statut FROM b_commandes WHERE statut = :action;";

        $statment = $this->executerRequete($sql, [
            ':action' => $action,
        ]);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== NB COMMANDE EN ATTENTES ====================================
    public function getLeft()
    {
        $sql = "SELECT id FROM b_commandes WHERE statut IN (0, 1);";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== INFO ====================================
    public function getInfo($action)
    {
        $sql = "SELECT * FROM b_commandes WHERE id = :action;";

        $statment = $this->executerRequete($sql, [
            ':action' => $action,
        ]);
        return $statment->fetch(PDO::FETCH_ASSOC);
    }
}
