<?php
require_once 'Model.php';

class PrestationModel extends Model
{
  // Liste prestations
  public function getList()
  {
    $sql = "SELECT nom, banner, client, type, short_description, lien, affichage FROM m_prestations ORDER BY annee DESC, id DESC";
    $statment = $this->executerRequete($sql);
    return $statment->fetchAll(PDO::FETCH_ASSOC);
  }

  // Dernieres prestations
  public function getLatest()
  {
    $sql = "SELECT nom, banner, client, type, short_description, lien, affichage FROM m_prestations WHERE affichage = 1 ORDER BY annee DESC, id DESC LIMIT 3";
    $statment = $this->executerRequete($sql);
    return $statment->fetchAll(PDO::FETCH_ASSOC);
  }

  // Informations sur une prestation spécifique
  public function getInfo($action)
{
    $sql = "SELECT * FROM m_prestations WHERE lien = :action";
    $statment = $this->executerRequete($sql, [':action' => $action]);
    
    $content = $statment->fetch(PDO::FETCH_ASSOC);

    if (!$content) {
        throw new Exception("Prestation non trouvé avec l'identifiant fourni.");
    }
    
    return $content;
}

public function getPicture($action)
{
    $sql = "SELECT img_projet FROM m_prestations_contenu WHERE id_projet = :action ORDER BY id";
    $statment = $this->executerRequete($sql, [':action' => $action]);
    return $statment->fetchAll(PDO::FETCH_ASSOC);
}
}
