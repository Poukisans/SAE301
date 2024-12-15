<?php
require_once 'Model.php';

class ContactModel extends Model
{
    public function saveMessage($nom, $prenom, $mail, $type_demande, $objet, $message)
    {
        $sql = "INSERT INTO m_contacts (nom, prenom, mail, type_demande, objet, message) VALUES (:nom, :prenom, :mail, :type_demande, :objet, :message)";
        $this->executerRequete($sql, [
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':mail' => $mail,
            ':type_demande' => $type_demande,
            ':objet' => $objet,
            ':message' => $message
        ]);
    }
}
