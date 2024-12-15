<?php
require_once 'Model.php';

class NewsletterModel extends Model
{
    public function addSubscriber($mail)
    {
        $sql = "INSERT INTO m_newsletter (mail) VALUES (:mail)";
        return $this->executerRequete($sql, [':mail' => $mail]);
    }
}
