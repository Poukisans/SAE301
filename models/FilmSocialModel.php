<?php
require_once 'Model.php';

class FilmSocialModel extends Model
{
    // Informations sur un film spécifique
    public function getList($action)
    {
        $sql = "SELECT * FROM m_film_socials WHERE id_film = :action";
        $statment = $this->executerRequete($sql, [':action' => $action]);

        return  $statment->fetchAll(PDO::FETCH_ASSOC);
    }
}
