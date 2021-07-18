<?php
class Session
{
    private $userId = "userId";
    private $sessionname = "user";
    private $sessiontemp = "fechaSession";
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            ini_set("session.use_trans_sid", "1");
            ini_set("session.use_only_cookies", "0");
            session_set_cookie_params(0, "/", $_SERVER["HTTP_HOST"], 0);
            session_start();
        }
        //$this->init();

    }
    /*
    function init(){
        error_log("SESSION_init ::::  iniciando método init");
        error_log("SESSION_init :::: Incluyendo session_start(), generando session para el controlador\n");
        session_start();
        
        if(!isset($_SESSION[$this->sessionname])){
                 
            $this->setUserSessionName("default");
            
        }
    }*/
    function setUserId($id)
    {
        $_SESSION[$this->userId] = $id;
    }

    function getUserId()
    {
        return $_SESSION[$this->userId];
    }

    function setUserSessionName($user)
    {
        $_SESSION[$this->sessionname] = $user;
    }


    function getUserSessionName()
    {
        return $_SESSION[$this->sessionname];
    }

    function setUserSessiontemp($temp)
    {
        $_SESSION[$this->sessiontemp] = $temp;
    }

    function getUserSessiontemp()
    {
        return $_SESSION[$this->sessiontemp];
    }


    function closeSession()
    {
        //error_log("SESSION_closeSession :::: Destruyendo sessión actual >> ".$this->getUserSessionName()."\n");
        session_unset();
        session_destroy();
        //error_log("SESSION_closeSession :::: Session anterior destruida, no hay session inicializada\n");
    }


    public function existsUserSession()
    {
        return isset($_SESSION[$this->sessionname]);
    }
}
