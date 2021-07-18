<?php

class View
{
    
    function __construct()
    {
        
    }

    function renderView($nombre)
    {
        $this->renderHeader();

        //require_once('views/header.php');
        require('views/'.$nombre.'.php');
        //require_once('views/footer.php');
        
        $this->renderFooter();
    }

    function renderHeader(){
      
            require_once('views/header.php');
       
    }
    
    function renderFooter(){
        
            require_once('views/footer.php');
        
    }
    
}
?>