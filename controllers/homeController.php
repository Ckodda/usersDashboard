<?php
class HomeController extends SessionController
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

        $userModel = $this->model->loadModel("user");

        $this->view->currentUser =  $userModel->getById($this->session->getUserId());

        $idUser = $this->view->currentUser["id"];

        $this->view->allUsers = $userModel->getAll($idUser);

        $personModel = $this->model->loadModel("person");
        $this->view->currentPerson = $personModel->getByIdUser($idUser);

        $this->view->renderView("home/index");
    }

    public function close()
    {
        $this->session->closeSession();
        header("Location:" . URL);
    }

    public function update($data)
    {
        if ($this->method == 'POST') {
            $id = $data[0];
            $userModel = $this->model->loadModel("user");

            $userModel->setUsername($this->getPost("nameUser"));
            $userModel->setUseremail($this->getPost("emailUser"));
            $userModel->setUserpassword($this->getPost("passwordUser"));

            // Id role 1 : admin
            // Id role 2 : user
            $userModel->setIdRole(2);

            $userModel->updateWithPass($id);


            //Obteniendo el id person a partir del id user
            $personModel = $this->model->loadModel("person");
            $idPersona = ($personModel->getByIdUser($id))["id"];
            error_log("id de la persona ".$id);
            $personModel = $this->model->loadModel("person");
            $person = $personModel->getByIdUser($id);
            //Validate if img file is empty
            if($_FILES["personAvatar"]["name"]==null){
                $avatar = $person["person_avatar"];
            }else{
                $avatar = uniqid(rand(), true) . '_' .$_FILES["personAvatar"]["name"];
                $avatar_tmp = $_FILES['personAvatar']['tmp_name'];

                $check = @getimagesize($avatar_tmp);

                if ($check !== false) {

                    $destino = "resource/img/avatar/";
                    $archivo_subir = $destino . $avatar;
                    move_uploaded_file($avatar_tmp, $archivo_subir);
                }
            }
            
            $personModel->setPersonName($this->getPost("personName"));
            $personModel->setPersonLastname($this->getPost("personLastname"));
            $personModel->setPersonAvatar($avatar);

            $personModel->updatePerson($idPersona);

            header("Location: " . URL . "home");
        }
    }
    
}
?>