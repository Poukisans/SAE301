<?php
require_once 'Model.php';

class FilmTechnicienModel extends Model
{
    // Informations sur un film spécifique
    public function getList($action)
    {
        $sql = "SELECT role, nom FROM m_film_techniciens WHERE id_film = :action";
        $statment = $this->executerRequete($sql, [':action' => $action]);

        return  $statment->fetchAll(PDO::FETCH_ASSOC);
    }
}
