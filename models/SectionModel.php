<?php
require_once 'Model.php';

class SectionModel extends Model
{
  public function getList()
  {
    $sql = "SELECT nom, lien, affichage_nav, affichage_footer from b_sections ORDER BY id";
    $statement = $this->executerRequete($sql);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getInfo($url)
  {
    $sql = "SELECT nom, affichage_nav, affichage_footer, banner FROM b_sections WHERE lien = :url";
    $statement = $this->executerRequete($sql, [':url' => $url]);
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
}
