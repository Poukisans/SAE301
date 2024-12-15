<?php
require_once 'Model.php';

class FilmFestivalModel extends Model
{
  // Liste festivals par film
  public function getList($action)
  {
    $sql = "SELECT selection,festival,annee FROM m_film_festivals WHERE id_film = :action ORDER BY id";
    $statment = $this->executerRequete($sql, [':action' => $action]);
    return $statment->fetchAll(PDO::FETCH_ASSOC);
  }
}
