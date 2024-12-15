<?php
require_once 'Model.php';

class FilmModel extends Model
{
  // Liste films
  public function getList()
  {
    $sql = "SELECT film.nom, type.type, film.realisateur, film.annee, film.lien, film.miniature, film.affichage,
                (SELECT role.nom FROM m_film_roles role WHERE role.id_film = film.id ORDER BY role.id LIMIT 1 OFFSET 0) AS role_1,
                (SELECT role.nom FROM m_film_roles role WHERE role.id_film = film.id ORDER BY role.id LIMIT 1 OFFSET 1) AS role_2,
                (SELECT role.nom FROM m_film_roles role WHERE role.id_film = film.id ORDER BY role.id LIMIT 1 OFFSET 2) AS role_3
            FROM m_films film
            LEFT JOIN m_film_type type ON type.id = film.type
            WHERE film.affichage = 1
            ORDER BY film.annee DESC, film.id DESC;
";

    $statment = $this->executerRequete($sql);
    return $statment->fetchAll(PDO::FETCH_ASSOC);
  }

  // Derniers films
  public function getLatest()
  {
    $sql = "SELECT film.nom, type.type, film.realisateur, film.annee, film.lien, film.miniature, film.affichage,
                (SELECT role.nom FROM m_film_roles role WHERE role.id_film = film.id ORDER BY role.id LIMIT 1 OFFSET 0) AS role_1,
                (SELECT role.nom FROM m_film_roles role WHERE role.id_film = film.id ORDER BY role.id LIMIT 1 OFFSET 1) AS role_2,
                (SELECT role.nom FROM m_film_roles role WHERE role.id_film = film.id ORDER BY role.id LIMIT 1 OFFSET 2) AS role_3
            FROM m_films film
            LEFT JOIN m_film_type type ON type.id = film.type
            WHERE film.affichage = 1
            ORDER BY film.annee DESC, film.id DESC
            LIMIT 3";

    $statment = $this->executerRequete($sql);
    return $statment->fetchAll(PDO::FETCH_ASSOC);
  }

  // Informations sur un film spécifique
  public function getInfo($action)
  {
    $sql = "SELECT film.id, film.nom, film.realisateur, film.annee, film.date_sortie, film.miniature, film.banner, film.affiche, film.bande_annonce, film.genre, film.duree, film.synopsis, film.format, film.format_projection, film.pays, film.langue, film.sous_titre, film.dp, film.dp_photo, film.dp_bande_annonce, film.dp_extrait, film.dp_affiche, film.dp_english, film.contact, film.affichage_materiel_presse, film.affichage_festival, film.affichage_date_sortie, film.affichage, film.lien, 
          type.type AS type_film, type.genre AS type_genre
          FROM m_films film
          LEFT JOIN m_film_type type ON type.id = film.type 
          WHERE film.lien = :action;";
    $statment = $this->executerRequete($sql, [':action' => $action]);

    $content = $statment->fetch(PDO::FETCH_ASSOC);

    if (!$content) {
      throw new Exception("404 Not Found : Film inconnu.");
    }

    return $content;
  }

  // Informations sur un film spécifique
  public function search($query)
  {
    $sql = "SELECT DISTINCT 
            film.nom, 
            film.realisateur, 
            type.type,
            film.affichage,
            film.miniature,
            film.annee,
            film.lien,
            (SELECT role.nom FROM m_film_roles role WHERE role.id_film = film.id ORDER BY role.id LIMIT 1 OFFSET 0) AS role_1,
            (SELECT role.nom FROM m_film_roles role WHERE role.id_film = film.id ORDER BY role.id LIMIT 1 OFFSET 1) AS role_2,
            (SELECT role.nom FROM m_film_roles role WHERE role.id_film = film.id ORDER BY role.id LIMIT 1 OFFSET 2) AS role_3
        FROM m_films film
        LEFT JOIN m_film_roles role ON film.id = role.id_film
        LEFT JOIN m_film_type type ON film.type = type.id
        WHERE film.affichage = 1
        AND (
            REPLACE(LOWER(film.nom), ' ', '-') COLLATE utf8mb4_general_ci LIKE :query
            OR REPLACE(LOWER(film.realisateur), ' ', '-') COLLATE utf8mb4_general_ci LIKE :query
            OR REPLACE(LOWER(film.genre), ' ', '-') COLLATE utf8mb4_general_ci LIKE :query
            OR REPLACE(LOWER(role.nom), ' ', '-') COLLATE utf8mb4_general_ci LIKE :query
            OR REPLACE(LOWER(type.type), ' ', '-') COLLATE utf8mb4_general_ci LIKE :query
        )
        ORDER BY film.annee DESC, film.id DESC;";

    $statement = $this->executerRequete($sql, [':query' => $query]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
}
