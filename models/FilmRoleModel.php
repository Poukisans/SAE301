<?php
require_once 'Model.php';

class FilmRoleModel extends Model
{
    // Liste des roles
    public function getList($action)
    {
        $sql = "SELECT role,nom FROM m_film_roles WHERE id_film = :action";
        $statment = $this->executerRequete($sql, [':action' => $action]);

        return  $statment->fetchAll(PDO::FETCH_ASSOC);
    }
}
