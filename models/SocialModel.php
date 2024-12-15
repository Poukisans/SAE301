<?php
require_once 'Model.php';

class SocialModel extends Model
{
  public function getList()
  {
    $sql = "SELECT nom,lien from m_socials";
    $statement = $this->executerRequete($sql);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
}
