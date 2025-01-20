<?php
require_once 'Model.php';

class GeneralModel extends Model
{
  public function getInfo()
  {
    $sql = "SELECT meta_desc from b_general";
    $statement = $this->executerRequete($sql);
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getLegals()
  {
    $sql = "SELECT mentions_legales from b_general";
    $statement = $this->executerRequete($sql);
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getContact()
  {
    $sql = "SELECT contact_title, contact from b_general";
    $statement = $this->executerRequete($sql);
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  
}
