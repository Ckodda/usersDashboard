<?php

/**
 *  CLASE CONTROLLER PADRE 
 */
class Controller
{
    function __construct()
    {
        /**Instanciando clase padre View() ***/
        $this->view = new View();

        
        //Intanciando clase padre Model()
        $this->model = new Model();
        
        //Validando método  HTTP
        $this->method = $_SERVER['REQUEST_METHOD'];

        //$this->view->isSpa = $this->isSpa();
        
    }


    /*****
    *   Validación si existe petición Ajax 
    */
    public function isAjax(){

    	// return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
   		// strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
           
           
           if(
            isset($_SERVER ['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'
            // !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            // strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
         ){
            # Ejecuta si la petición es a través de AJAX.
            return true;
         }else{
            # Ejecuta si la petición NO es a través de AJAX.
            return false;
        }
    
    }


    //Is Spa with Ajax
    public function isSpa(){
        if($this->isAjax()==true){
            return true;
        }else if($this->isAjax()==false){
            return false;
        }
    }

    //Métodos simplificados de $_POST['post'] y $_GET['get']
    
    public function getPost($valor){

        return $_POST[$valor];
    
    }

    public function getGet($valor){
    
        return $_GET[$valor];
    
    }

}
?>