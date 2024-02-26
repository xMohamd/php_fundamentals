<?php
require_once "vendor/autoload.php";

class Visitor
{
    private $isCounted;
    private $sessionKey;

    public function __construct($sessionKey)
    {
        $this->sessionKey = $sessionKey;
        $this->checkSession();
    }

    private function checkSession()
    {
        if (isset($_SESSION[$this->sessionKey]) && $_SESSION[$this->sessionKey] === true) {
            $this->isCounted = true;
        } else {
            $this->isCounted = false;
        }
    }

    public function getIsCounted()
    {
        return $this->isCounted;
    }

    public function getSessionKey()
    {
        return $this->sessionKey;
    }

    public function setIsCounted($isCounted)
    {
        $this->isCounted = $isCounted;
    }

    public function saveCountStatusInUserSession()
    {
        $_SESSION[$this->sessionKey] = $this->isCounted;
    }
}
