<?php

abstract class Model {

  // Objet PDO d'accès à la BD
  private $bdd;

  // Exécute une requête SQL éventuellement paramétrée, avec ou sans ID
  protected function executerRequete($sql, $params = []) {
    if (empty($params)) {
      $resultat = $this->getBdd()->query($sql);    // Exécution directe
    } else {
      $resultat = $this->getBdd()->prepare($sql);  // Requête préparée
      $resultat->execute($params);
    }
    return $resultat;
  }

  // Renvoie un objet de connexion à la BD en initialisant la connexion au besoin
  private function getBdd() {
    if ($this->bdd == null) {
      $this->bdd = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',DB_USER,DB_PASS,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
      );
    }
    return $this->bdd;
  }
}
