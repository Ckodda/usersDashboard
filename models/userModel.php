<?php
class UserModel extends Model
{
    private $id;
    private $username;
    private $userpassword;
    private $userrole;
    private $idrole;
    private $useremail;

    public function getId(){ return $this->id;}
    public function setId($id){ $this->id=$id;}

    public function getUsername(){ return $this->username;}
    public function setUsername($username){ $this->username=$username;}

    public function getUserpassword(){ return $this->userpassword;}
    public function setUserpassword($userpassword){ $this->userpassword=sha1($userpassword);}

    public function getUserrole(){ return $this->userrole;}
    public function setUserrole($userrole){ $this->userrole=$userrole;}

    public function getIdRole(){ return $this->idrole;}
    public function setIdRole($idrole){ $this->idrole=$idrole;}

    public function getUseremail(){ return $this->useremail;}
    public function setUseremail($useremail){ $this->useremail=$useremail;}

    function __construct()
    {
        parent::__construct();    
    }
    
    function authenticate()
    {
        $bd = new Database();

        $cnx = $bd->connect();

        $stmt = $cnx->prepare("SELECT u.id,u.user_name, u.user_email, u.user_pass, ur.user_role
        FROM user AS u
        INNER JOIN userRole AS ur
        ON u.id_role = ur.id
        WHERE user_email = :useremail AND user_pass = :userpassword;");
        
        $stmt->bindValue(":useremail",$this->useremail);
        $stmt->bindValue(":userpassword",$this->userpassword);
        $stmt->execute();

        $res = $stmt->fetch();
        //error_log("Estos son los resultados ".var_dump($res));

        return $res;
    }


/**
 *  
 *              CRUD
 * 
 */

    function addUser(){
        $bd = new Database();

        $cnx = $bd->connect();
        $stmt = $cnx->prepare("INSERT INTO user(user_name,user_email,user_pass,id_role) VALUES(:username,:useremail,:userpass,:idrole)");

        $stmt->bindValue(":username",$this->username);
        $stmt->bindValue(":useremail",$this->useremail);
        $stmt->bindValue(":userpass",$this->userpassword);
        $stmt->bindValue(":idrole",$this->idrole);

        $stmt->execute();
        return $this->lastId();
    }

    function getAll($id){
        $bd = new Database();

        $cnx = $bd->connect();
        $stmt = $cnx->prepare("SELECT u.id, u.user_name, u.user_email, p.person_name, p.person_lastname, p.person_avatar, ur.user_role
        FROM user AS u
        INNER JOIN userRole AS ur
        ON u.id_role = ur.id
        INNER JOIN person AS p
        ON p.id_user = u.id
        WHERE u.id != :id");

        $stmt->bindValue(":id",$id);

        $stmt->execute();

        $res = $stmt->fetchAll(); 

        return $res;
        
    }

    function getByUserName($name){
        $bd = new Database();

        $cnx = $bd->connect();
        $stmt = $cnx->prepare("SELECT*FROM user WHERE user_name = :username");

        $stmt->bindValue(":username",$name);
        $stmt->execute();

        $res = $stmt->fetch(); 

        return $res;
    }

    function getById($id){
        $bd = new Database();

        $cnx = $bd->connect();
        $stmt = $cnx->prepare("SELECT u.id, u.user_name,u.user_email,p.person_name, p.person_lastname, p.person_avatar FROM user AS u INNER JOIN person AS p ON p.id_user = u.id WHERE u.id = :id");

        $stmt->bindValue(":id",$id);
        $stmt->execute();

        $res = $stmt->fetch(); 

        return $res;
    }

    function deleteUser($id){

        $bd = new Database();

        $cnx = $bd->connect();
        $stmt = $cnx->prepare("DELETE FROM user WHERE id = :id");

        $stmt->bindValue(":id",$id);
        $stmt->execute();

    }
    
    function updateUser($id){

        $bd = new Database();

        $cnx = $bd->connect();
        $stmt = $cnx->prepare("UPDATE user SET user_name = :username, user_email = :useremail, id_role = :idrole WHERE id = :id");
        
        $stmt->bindValue(":id",$id);
        $stmt->bindValue(":username",$this->username);
        $stmt->bindValue(":useremail",$this->useremail);
        $stmt->bindValue(":idrole",$this->idrole);
        $stmt->execute();

    }

    function updateWithPass($id){

        $bd = new Database();

        $cnx = $bd->connect();
        $stmt = $cnx->prepare("UPDATE user SET user_name = :username, user_email = :useremail, user_pass = :userpassword, id_role = :idrole WHERE id = :id");
        
        $stmt->bindValue(":id",$id);
        $stmt->bindValue(":username",$this->username);
        $stmt->bindValue(":useremail",$this->useremail);
        $stmt->bindValue(":userpassword",$this->userpassword);
        $stmt->bindValue(":idrole",$this->idrole);
        $stmt->execute();

    }

    function lastId(){
        $bd = new Database();

        $cnx = $bd->connect();
        $stmt = $cnx->prepare("SELECT MAX(id) AS lastId FROM user");

        $stmt->execute();

        $res = $stmt->fetch();

        return $res["lastId"];
        
    }

    

}
?>