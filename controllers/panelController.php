<?php
class PanelController extends SessionController
{
    function __construct()
    {
        parent::__construct();
        //error_log("Se renderizó la vista de PANEL");
    }

    public function render()
    {
        $userModel = $this->model->loadModel("user");

        $this->view->currentUser =  $userModel->getById($this->session->getUserId());

        $idUser = $this->view->currentUser["id"];

        $this->view->allUsers = $userModel->getAll($idUser);

        $personModel = $this->model->loadModel("person");
        $this->view->currentPerson = $personModel->getByIdUser($idUser);


        //error_log("PANELCONTROLLER_render :::: Se a iniciado la vista y el estado de la session es >> ".session_status()."\n el rol es  >> ".$this->session->getUserSessionName());
        $this->view->renderView("panel/index");
    }

    public function close()
    {
        //error_log("PANELCONTROLLER_close :::: Se cerrará la session; actual estado es >> ".session_status()."\n actual rol es  >> ".$this->session->getUserSessionName());
        $this->session->closeSession();
        //error_log("PANELCONTROLLER_render :::: Se ha destruido la session; actual estado es >> ".session_status()."\nNO EXISTE UNA SESION,\nRedirigiendo a inicio del sitio web");
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

            // value 1 : administrador
            // value 2 : usuario
            $userModel->setIdRole(1);

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

            header("Location: " . URL . "panel");
        }
    }
}
