<?php
class PersonModel extends Model{

    private $id;
    private $personName="";
    private $personLastname="";
    private $personAvatar="";
    private $personIdUser;
    
    public function __construct()
    {
        
    }

    public function setId($id){
        $this->id=$id;
    }

    public function getId(){
        return $this->id;
    }

    public function setPersonName($name){
        $this->personName=$name;
    }

    public function getPersonName(){
        return $this->personName;
    }

    public function setPersonLastname($lastname){
        $this->personLastname=$lastname;
    }

    public function getPersonLastname(){
        return $this->personLastname;
    }
    public function setPersonAvatar($avatar){
        $this->personAvatar=$avatar;
    }

    public function getPersonAvatar(){
        return $this->personAvatar;
    }

    public function setPersonIduser($id){
        $this->personIdUser=$id;
    }

    public function getPersonIduser(){
        return $this->personIdUser;
    }




    /**
     * 
     *                  CRUD
     * 
     */

    
    public function getAll(){
        $bd = new Database();

        $cnx = $bd->connect();
        $stmt = $cnx->prepare("SELECT*FROM person;");

        $stmt->execute();

        $res = $stmt->fetchAll(); 

        return $res;
    }

    public function getById($id){
        $bd = new Database();

        $cnx = $bd->connect();
        $stmt = $cnx->prepare("SELECT*FROM person WHERE id=:id;");

        $stmt->bindValue(":id",$id);
        $stmt->execute();

        $res = $stmt->fetchAll(); 

        return $res;
    }
    
    public function getByIdUser($id){
        $bd = new Database();

        $cnx = $bd->connect();
        $stmt = $cnx->prepare("SELECT*FROM person WHERE id_user=:id;");

        $stmt->bindValue(":id",$id);
        $stmt->execute();

        $res = $stmt->fetch(); 

        return $res;
    }

    public function addPerson(){
        $bd = new Database();

        $cnx = $bd->connect();
        $stmt = $cnx->prepare("INSERT INTO person(person_name,person_lastname,person_avatar,id_user) VALUES(:personName,:personLastname,:personAvatar,:iduser)");

        $stmt->bindValue(":personName",$this->personName);
        $stmt->bindValue(":personLastname",$this->personLastname);
        $stmt->bindValue(":personAvatar",$this->personAvatar);
        $stmt->bindValue(":iduser",$this->personIdUser);
        
        $stmt->execute();
    }

    public function deletePerson($id){
        $bd = new Database();

        $cnx = $bd->connect();
        $stmt = $cnx->prepare("DELETE FROM person WHERE id= :id");

        $stmt->bindValue(":id",$id);
        
        $stmt->execute();
    }

    public function updatePerson($id){
        $bd = new Database();

        $cnx = $bd->connect();
        $stmt = $cnx->prepare("UPDATE person SET person_name = :personName , person_lastname = :personLastname, person_avatar = :personAvatar WHERE id = :id");
        
        $stmt->bindValue(":id",$id);
        $stmt->bindValue(":personName",$this->personName);
        $stmt->bindValue(":personLastname",$this->personLastname);
        $stmt->bindValue(":personAvatar",$this->personAvatar);
        
        $stmt->execute();
    }
}
?>