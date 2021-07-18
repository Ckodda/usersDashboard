<?php
/**
 * CLASE SessionController Hijo de clase padre Controller ///USAR extends SessionController en los controladores hijos si es que la seccion debe ser administrada por la sesion
 * DURANTE LA PETICION AJAX NO PUEDEN HABER 
 * PRUEBAS echo durante el proceso
 * no diferencia echo "hola" de echo json_encode("hola");
 * 
 * --- se recomienda que en todo el proceso de pruebas se haga uso de error_log("mensaje ... ??"); para hacer un seguimiento del flujo
 */
class SessionController extends Controller
{
    protected $session;
    protected $role;
    protected $sites;
    protected $defaultSites;

    protected $url;

    public function __construct()
    {
        parent::__construct();
        $this->start();
        
        if($this->session->existsUserSession()){ 
            $this->view->sessionValidate = true;
            //$this->view->userName = $this->session->getUserName();
        }else{
            $this->view->sessionValidate = false;
        }
        
    }

    function start(){

        //Instanciando clase Session ('libs/session.php')
        $this->session = new Session();

        // Obteniendo contenido del archivo access.json (config/access.json)
        $json = json_decode(file_get_contents("config/access.json"),true);

        $this->sites = $json["sites"];
        $this->defaultSites = $json["default-sites"];

        //Ubicando URL actual
        $this->url = trim("$_SERVER[REQUEST_URI]");
        $this->url = explode("/",$this->url);
        $this->url = $this->url[2]; // localhost/chinawok/url[2]
        $this->url = preg_replace("/\?.*/","",$this->url);

        //validar session existente $_SESSION['user']
        if(($this->session->existsUserSession())){
            
            $this->role = $this->session->getUserSessionName();

            $fechaActual = date("Y-n-j H:i:s");
            $fechaSession = $this->session->getUserSessiontemp();
            $tiempoTranscurrido = (strtotime($fechaActual)-strtotime($fechaSession));
            
            /**
             * Validacion por tiempó de inactividad
             */
            if($tiempoTranscurrido>=600){
                error_log("SESSIONCONTROLLER :: start() => Han pasado 3 minutos de inactividad");
                $this->session->closeSession();
                header("Location: ".URL);
            }else{
                //error_log("SESSIONCONTROLLER :: start() => Aun HAY actividad");
                $this->session->setUserSessiontemp($fechaActual);
            }



            //error_log("Rol actual es : ".$this->role);
            
            //Recorriendo archivo access.json 
            for($i=0;$i<sizeof($this->sites);$i++){

                //Validación página actual es publica
                if($this->sites[$i]["site"] == $this->url && $this->sites[$i]["access"]=='public'){


                    //Sitio actual es publico
                    //Validando si es usuario autenticado puede ingresar a página publica
                    if(($this->userIsAuthorized($this->role))==true){

                        //error_log("Dejando ingresar a url : ".$this->url);

                    }else{

                        //error_log("No autorizado ; Redirigiendo a Sitio por defecto no coincide el role ".$this->sites[$i]["role"]." con el role actual : ".$this->role);
                        $this->redirectSiteByRole($this->role);

                    }
                    
                }else if($this->sites[$i]["site"] == $this->url && $this->sites[$i]["access"]=='private'){
                    //Sitio actual es privado
                    //echo "Existe session sitio privado";
                    if(($this->userIsAuthorized($this->role))==true){
                        //Usuario correspondiente a la página
                        //Manteniendo flujo
                    }else{
                        //si no es autorizado redirigir a sitio por defecto
                        $this->redirectSiteByRole($this->role);
                    }
                }

            }

        }else{
            //echo "<br>No existe una session";
            //NO EXISTE $_SESSION['user']
            //recorriendo access.json
            
            for($i=0;$i<sizeof($this->sites);$i++){

                if($this->sites[$i]["site"] == $this->url && $this->sites[$i]["access"]=='public'){
                    //Sitio actual es publico
                    //Mantener flujo 
                    
                }else if($this->sites[$i]["site"] == $this->url && $this->sites[$i]["access"]=='private'){
                    //Sitio actual es privado
                    //Redirigiendo a index ya que la pagina a la que se quiere ir es privada
                    header("Location: ".URL);
                }

            }
        }
        
    }

    /**
     * 
     * 
     * Método para redirigir al usuario según su role correspondiente
     *
     */

    function redirectSiteByRole($role){

        //error_log("El parametro ingresado en redirectSiteByRole es : ".$role);
        
        $url="";
        
        for($i=0;$i<sizeof($this->defaultSites);$i++){
            
            if($this->defaultSites[$i]["role"] == $role){

                //error_log("El sitio encontrado depende del role : ".$this->defaultSites[$i]["role"]);

                $url = $this->defaultSites[$i]["site"];
                break;
            }
            
        }

        //error_log("Redirigiendo a ".$url);

        header("Location:".URL.$url);

    }

    
    /**
     * Método para verificar si el usuario esta autorizado para acceder a la pagina correspondiente
     */
    function userIsAuthorized($role){
        $return = false;

        for($i=0;$i<sizeof($this->sites);$i++){

            if($this->url == $this->sites[$i]["site"] && $this->sites[$i]["role"] == $role){
                $return=true;
            }

        } 
        return $return;
    }
}
?>