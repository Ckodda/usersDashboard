<?php
class UserController extends Controller{


    public function __construct()
    {
        parent::__construct();    
    }

    public function getUser($params){
        
        if($this->method=='POST'){
            $id=$params[0];
            $userModel = $this->model->loadModel("user");
            $res = $userModel->getById($id);
            
            echo json_encode($res);
        }
    }

    public function addUser(){
        
        if($this->method=='POST'){
            
            $userModel = $this->model->loadModel("user");

            $userModel->setUsername($this->getPost("nameUser"));
            $userModel->setUseremail($this->getPost("emailUser"));
            $userModel->setUserpassword($this->getPost("passwordUser"));
            $userModel->setIdRole($this->getPost("userRole"));

            $lastIdUser = $userModel->addUser();

            

            $personModel = $this->model->loadModel("person");

            $personModel->setPersonName($this->getPost("personName"));
            $personModel->setPersonLastname($this->getPost("personLastname"));
            //Imagen de avatar
            $avatar = uniqid(rand(), true) . '_' .$_FILES["personAvatar"]["name"];

            $avatar_tmp = $_FILES['personAvatar']['tmp_name'];

            $check = @getimagesize($avatar_tmp);

            if ($check !== false) {

                $destino = "resource/img/avatar/";
                $archivo_subir = $destino . $avatar;
                move_uploaded_file($avatar_tmp, $archivo_subir);
            }
            $personModel->setPersonAvatar($avatar);
            $personModel->setPersonIduser($lastIdUser);

            $personModel->addPerson();

            header("Location: ".URL."panel");
        }
    }

    public function editUser($params){
        
        $id = $params[0];  
        if($this->method == 'POST'){
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

            $userModel = $this->model->loadModel("user");
            $userModel->setUsername($this->getPost("nameUser"));
            $userModel->setUseremail($this->getPost("emailUser"));
            $userModel->setIdRole($this->getPost("userRole"));

            $userModel->updateUser($id);


            $personModel->setPersonName($this->getPost("personName"));
            $personModel->setPersonLastname($this->getPost("personLastname"));
            $personModel->setPersonAvatar($avatar);

            $personModel->updatePerson($person["id"]);

            header("Location: ".URL."panel");

        }
        
    }

    

    public function deleteUser($params){

        $id=$params[0];

        if($this->method=='POST'){
            $personModel = $this->model->loadModel("person");
            $idPerson = ($personModel->getByIdUser($id))["id"];
            $avatar = ($personModel->getByIdUser($id))["person_avatar"];

            $personModel->deletePerson($idPerson);
            unlink(DIRECTORY."/resource/img/avatar/".$avatar);
            $userModel = $this->model->loadModel("user");
            $userModel->deleteUser($id);

            
            
            header("Location: ".URL."panel");

        }
    }
}
?>