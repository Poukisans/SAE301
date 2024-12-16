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
    $sql = "SELECT mentions_legales,politique_confidentialite from m_general";
    $statement = $this->executerRequete($sql);
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
  
}
