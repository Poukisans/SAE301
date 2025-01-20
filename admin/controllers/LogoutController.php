<?php

class LogoutController
{
    public function __construct() {
        session_destroy();
        header('Location: ./login');
    }
}
