<?php
require_once 'Model.php';

class FaqModel extends Model
{
    // ==================================== LISTE ====================================
    public function getList()
    {
        $sql = "SELECT * FROM `b_faq`;";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==================================== AJOUT ====================================
    public function add($data)
    {
        extract($data);

        try {
            $sql = "INSERT INTO b_faq (question, reponse) VALUES (:question, :reponse)";
            $this->executerRequete($sql, [
                ':question' => $question,
                ':reponse' => $reponse,
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
            $sql = "UPDATE b_faq SET question = :question, reponse = :reponse WHERE id = :id";
            $this->executerRequete($sql, [
                ':question' => $question,
                ':reponse' => $reponse,
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
            $sql = "DELETE FROM b_faq WHERE id = :id ";
            $this->executerRequete($sql, [
                ':id' => $data,
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }
}
