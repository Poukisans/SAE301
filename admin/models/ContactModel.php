<?php
require_once 'Model.php';

class ContactModel extends Model
{
    // ==================================== LISTE ====================================
    public function getPrestationMessage()
    {
        $sql = "SELECT * FROM b_article ";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }
}
