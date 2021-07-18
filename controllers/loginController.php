<?php
class LoginController extends SessionController
{


    function __construct()
    {
        parent::__construct();
        if(!isset($this->view->mensaje)){
            $this->view->mensaje="";
        };
        
        
    }

    public function render()
    {
        
        //error_log("Se renderizó la vista de LOGIN");
        
        
        //error_log("LOGINCONTROLLER_render :::: se a iniciado la vista y el estado de la session es >> ".session_status()."\nEl roll es >> ".$this->session->getUserSessionName()."\n");
        $this->view->renderView("login/index");
    }

    public function authentication()
    {
        if($this->method=='POST'){
            //error_log("Validando datos de usuario al inciar session");
            //error_log("LOGINCONTROLLER_authentication  :::: Ejecutando función de autenticacion en el metodo POST\nLOGINCONTROLLER_authentication :::: Estado de la sesion >> ".session_status()."\nEl roll es >> ".$this->session->getUserSessionName()."\n");
            
            
            //$username = $_POST["txtUsername"];
            //$userpassword = $_POST["txtUserpassword"];
            $useremail = $this->getPost("emailInput");
            $userpassword=$this->getPost("passwordInput");

            $user = $this->model->loadModel("user");
            
            $user->setUseremail($useremail);
            $user->setUserpassword($userpassword);

            $res = $user->authenticate();
            
            if($res>0){
                
                $this->session->setUserId($res["id"]);
                $this->session->setUserSessionName($res["user_role"]);
                $this->session->setUserSessiontemp(date("Y-n-j H:i:s"));
                
                //error_log("LOGINCONTROLLER_authentication :::: se agrego una sesion > ".session_status()."\n El usuario tiene el rol de >> ".$this->session->getUserSessionName()."\n");
                header("Location:".URL.'panel');
                
            }else if($res==0||$res>1){
                
                $this->view->mensaje = "Usuario y/o contraseña incorrectos";
                $this->render();
                header("Location: ".URL.'login');
               
            }
        }
    }
    
}
?>