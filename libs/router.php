<?php
require_once 'controllers/erroresController.php';
class Router
{
	
	function __construct()
	{
		$this->iniciar();
	}

	function iniciar()
	{
        
		//Recoger la variable URL enviado por GET
		//y darle FORMATO

		// condicion ? verdadero : falso
		$url = isset($_GET["url"]) ? $_GET["url"] : null;
	    //Controlador por defecto


		//Eliminar el "/" final
		$url = rtrim($url, "/");

		//Subdividir la URL
		$url = explode("/", $url);
		
		//Invocar a los CONTROLADORES
		if (empty($url[0])) {
			$fileName="controllers/loginController.php";
			require_once ($fileName);
			$controlador=new LoginController();
			
			$controlador->render();
			return false;
		}


		$fileName = "controllers/" . $url[0] . "Controller.php";


		if(file_exists($fileName))
		{
			//Incluir el archivo del controlador
			require_once($fileName);

			$nameControlador = $url[0]."Controller";
			//Instanciar el CONTROLADOR
			$controlador = new $nameControlador;

			//Invocar al METODO
			if(isset($url[1])){
				
				//si existe el metodo(funcion) en el controlador
				if(method_exists($controlador,$url[1]))
				{
					
					if(isset($url[2]))
					{

						$numeroParam = count($url) - 2;

						//array de parametros (estos se pueden pasar como variables en la url con get)
						$params = [];
						for($i=0;$i<$numeroParam;$i++)
						{
							array_push($params,$url[$i+2]);
						} 

						$controlador->{$url[1]}($params);


					}else{
						//Ejecutar el metodo
						//obj->metodo()
						$params = [" "];
						$controlador->{$url[1]}($params);
					}

				}else{

					//error no existe el metodo
					$controlador = new ErroresController();
					$controlador->render("");
				}

			}else{
				$controlador->render("");
			}
		}
		else
		{
			$controlador = new ErroresController();
			$controlador->render();
//			$controlador->mostrarVista();

		}
	}
}

?>