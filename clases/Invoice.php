<?php

class Invoice{
    
    public $con;
    public $success = '';
    public $error = '';
    
    public function __construct($pdo){
        $this->con = $pdo;    
    }

    public function list($pagina){

        $query_total = $this->con->query("SELECT COUNT(CL_ID) as total FROM CCBDCLIE");
        $total_registros = $query_total->fetch(PDO::FETCH_ASSOC)['total'];

        $total = $total_registros;
        $muestra = 50;
        $total_por_pagina = ceil($total/$muestra);
        $desde = ($pagina-1) * $muestra;
        $hasta = $pagina * $muestra;

        $query = $this->con->query("WITH OrderedTable AS
                                (
                                    SELECT CL_CODIGO,CL_NOMBRE,CL_DIREC1,CL_TELEF1,ZO_CODIGO,CL_LIMCRE, ROW_NUMBER() OVER (ORDER BY CL_ID) as rowNumber
                                    FROM CCBDCLIE 
                                )
                            SELECT * FROM OrderedTable
                            WHERE rowNumber > {$desde} AND rowNumber <= {$hasta}
                        "); 

        $datos = $query->fetchAll(PDO::FETCH_ASSOC);

        return [
            'datos'=>$datos,
            'total_registros'=>10
        ];
    }

}