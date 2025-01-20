<?php
require_once 'Model.php';

class FaqModel extends Model
{
    // ==================================== LISTE ====================================
    public function getInfo()
    {
        $sql = "SELECT * FROM `b_faq`;";
        $statment = $this->executerRequete($sql);
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }
}
