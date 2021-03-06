<?php

class Auth{
    // public $user;
    // public $pass;
    public $con;
    public $success = '';
    public $error = '';
    
    public function __construct($pdo){
        $this->con = $pdo;
    }

    public function login($user,$pass){
        $query = $this->con->prepare("SELECT  ID,COD_EMPR,COD_SUCU,USUARIO,CLAVE,NIVEL FROM CONTASEG WHERE USUARIO = :usuario AND CLAVE = :clave AND COD_EMPR = 1 AND COD_SUCU = 1");
        $query->bindParam(':usuario',$user);
        $query->bindParam(':clave',$pass);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_OBJ);
        if($query->rowCount() != 0){
            $_SESSION['login'] = true;
            $_SESSION['id'] = $data->ID;
            $_SESSION['nombre'] = $data->USUARIO;
            $_SESSION['nivel'] = $data->NIVEL;
            $this->success = 'Login succesfull';
            return true;
        }else{
            $this->error = 'Login error';
            return false;
        }       
    }

    public function logOut(){
        $_SESSION['login'] = false;
        session_destroy();
    }
}