<?php
require_once 'Model.php';

class CommandeModel extends Model
{
    // ==================================== LISTE ====================================
    public function getList($archive)
    {
        $sql = "SELECT id, date, nom, prenom, statut, archive FROM b_commandes WHERE archive = :archive ORDER BY id DESC";
        $statment = $this->executerRequete($sql, [
            ':archive' => $archive,
        ]);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== LISTE FILTREE ====================================
    public function getFilteredList($action, $archive)
    {
        $sql = "SELECT id, date, nom, prenom, statut, archive FROM b_commandes WHERE statut = :action AND archive = :archive;";

        $statment = $this->executerRequete($sql, [
            ':action' => $action,
            ':archive' => $archive,
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

    // ==================================== UPDATE INFO ====================================
    public function update($data)
    {
        extract($data);

        try {
            $sql = "UPDATE b_commandes SET statut = :statut WHERE id = :id";
            $this->executerRequete($sql, [
                ':id' => $id_commande,
                ':statut' => $statut,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== UPDATE INFO ====================================
    public function archive($data)
    {
        extract($data);

        try {
            $sql = "UPDATE b_commandes SET archive = 1 WHERE id = :id";
            $this->executerRequete($sql, [
                ':id' => $id,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== UPDATE INFO ====================================
    public function unarchive($data)
    {
        extract($data);

        try {
            $sql = "UPDATE b_commandes SET archive = 0 WHERE id = :id";
            $this->executerRequete($sql, [
                ':id' => $id,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    // ==================================== SUPPRESSION ====================================
    public function delete($data)
    {
        try {
            $sql = "DELETE FROM b_commandes WHERE id = :id ";
            $this->executerRequete($sql, [
                ':id' => $data,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }
}
