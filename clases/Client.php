<?php

class Client{
    
    public $con;
    public $success = '';
    public $error = '';
    
    public function __construct($pdo){
        $this->con = $pdo;    
    }

    public function list(){
        $query = $this->con->query("SELECT TOP(1000) CL_CODIGO,CL_NOMBRE,CL_DIREC1,CL_TELEF1,ZO_CODIGO,CL_LIMCRE FROM CCBDCLIE WHERE CL_ACTIVO <> 'D' AND COD_EMPR = 1 AND COD_SUCU = 1 ORDER BY CL_ID DESC ");
        $datos = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_registros = $query->rowCount();
        return [
            'datos'=>$datos,
            'total_registros'=>$total_registros
        ];
    }

    public function create(array $data){
        try {
            $this->con->beginTransaction();
            $insert = $this->con->prepare("INSERT INTO CCBDCLIE (CL_CODIGO,CL_NOMBRE,CL_DIREC1,CL_TELEF1,ZO_CODIGO,CL_LIMCRE,COD_SUCU) VALUES (:codigo,:nombre,:direccion,:telefono,:zona,:limite,1)");
            $insert->bindValue(':codigo',$data['codigo']);
            $insert->bindValue(':nombre',$data['nombre']);
            $insert->bindValue(':direccion',$data['direccion']);
            $insert->bindValue(':telefono',$data['telefono']);
            $insert->bindValue(':zona',$data['zona']);
            $insert->bindValue(':limite',$data['limite']);
    
            $insert->execute();
            $this->con->commit();

            return true;
            
        }catch(Exception $e){
            //An exception has occured, which means that one of our database queries
            //failed.
            //Print out the error message.
            //Rollback the transaction.
        
            if($this->con->inTransaction()){
                $this->con->rollBack();
            }

            $this->error = $e->getMessage();
            return false;
        }
    }

    public function edit(array $data){
        try {
            $this->con->beginTransaction();
            $update = $this->con->prepare("UPDATE CCBDCLIE SET CL_NOMBRE = :nombre,CL_DIREC1 = :direccion,CL_TELEF1 = :telefono,ZO_CODIGO = :zona,CL_LIMCRE = :limite WHERE CL_CODIGO = :codigo AND COD_EMPR = 1 AND COD_SUCU = 1");
            $update->bindValue(':nombre',$data['nombre']);
            $update->bindValue(':direccion',$data['direccion']);
            $update->bindValue(':telefono',$data['telefono']);
            $update->bindValue(':zona',$data['zona']);
            $update->bindValue(':limite',$data['limite']);
            $update->bindValue(':codigo',$data['codigo']);
            $update->execute();
        
            $this->con->commit();
            return true;

        }catch(Exception $e){
            //An exception has occured, which means that one of our database queries
            //failed.
            //Print out the error message.
            echo $e->getMessage();
            //Rollback the transaction.
        
            if($this->con->inTransaction()){
                $this->con->rollBack();
            }

            return false;
        }
    }

    public function delete($codigo){
        try {
            $this->con->beginTransaction();    
            $update = $this->con->prepare("UPDATE CCBDCLIE SET CL_ACTIVO = 'D' WHERE CL_CODIGO = :codigo");
            $update->bindValue(':codigo',$codigo);
            $update->execute();
            $this->con->commit();
            return true;
        }catch(Exception $e){
            //An exception has occured, which means that one of our database queries
            //failed.
            //Print out the error message.
            echo $e->getMessage();
            //Rollback the transaction.
        
            if($this->con->inTransaction()){
                $this->con->rollBack();
            }

            return false;
        }    
    }

}