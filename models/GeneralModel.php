<?php
require_once 'Model.php';

class GeneralModel extends Model
{
  public function getInfo()
  {
    $sql = "SELECT meta_desc, couleur_site from m_general";
    $statement = $this->executerRequete($sql);
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getPresentation()
  {
    $sql = "SELECT presentation from m_general";
    $statement = $this->executerRequete($sql);
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getNewsletterInfo()
  {
    $sql = "SELECT newsletter_desc, newsletter_warn from m_general";
    $statement = $this->executerRequete($sql);
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getLegals()
  {
    $sql = "SELECT mentions_legales,politique_confidentialite from m_general";
    $statement = $this->executerRequete($sql);
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getFilmContact()
  {
    $sql = "SELECT film_contact from m_general";
    $statement = $this->executerRequete($sql);
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
}
