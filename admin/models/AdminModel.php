<?php
require_once 'Model.php';

class AdminModel extends Model
{
    // Récupère les informations d'un administrateur en fonction de l'email uniquement
    public function getAdmin($pseudo)
    {
        $sql = "SELECT * FROM `b_admin` WHERE pseudo = :pseudo";
        $statement = $this->executerRequete($sql, [':pseudo' => $pseudo]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function setPassword($pseudo, $password)
    {
        try {
            $sql = "UPDATE `b_admin` SET password = :password WHERE pseudo = :pseudo";
            $this->executerRequete($sql, [
                ':password' => $password,
                ':pseudo' => $pseudo
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }

    public function updateUser($data)
    {
        extract($data);

        try {
            $sql = "UPDATE `b_admin` SET pseudo = :pseudo, nom = :nom, prenom = :prenom WHERE id = :id";
            $this->executerRequete($sql, [
                ':pseudo' => $pseudo,
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':id' => $id
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour en BDD: " . $e->getMessage());
        }
    }
}
