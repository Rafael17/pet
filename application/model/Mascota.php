<?php
namespace pluralpet;

class Mascota extends Model{
    function __construct() {
        parent::__construct();
        
    }
    
    function add($image_name,$nombre_original){
        $sql =  "INSERT INTO mascota (animal,animal_detail,sexo,edad,tamano,pedigree,criadero,precio,titulo,descripcion,foto_1,tab,fecha,departamento,ciudad_barrio,usuario,status)"
                . " VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'activo')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_POST['animal'],$_POST['animal_detail'],$_POST['sexo'],$_POST['edad'],
            $_POST['tamano'],$_POST['pedigree'],$_POST['criadero'],$_POST['precio'],$_POST['titulo'],
            $_POST['descripcion'],$image_name,$_POST['tab'],$_POST['fecha'],$_POST['departamento'],$_POST['ciudad_barrio'],$_SESSION['user']->id));
        $affected_rows = $stmt->rowCount();
        return $affected_rows;
    }
    
    function delete(){
        $sql =  "DELETE FROM mascota WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_POST['id']));
        $affected_rows = $stmt->rowCount();
        return $affected_rows;
    }
    
    function getAll($type,$animal){
        $sql = "SELECT * FROM mascota WHERE tab=? and animal=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($type,$animal));
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }
    
    function get($id){
        $sql = "SELECT * FROM mascota WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($id));
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows[0];
    }
    
    function filter($vals){
        foreach($vals as $rows){
            $vals_decoded[]=urldecode($rows);
        }
        $stmt = implode("=? and ",array_keys($vals))."=? ";
        $sql = "SELECT * FROM mascota WHERE ".$stmt;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($vals_decoded);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }
    
}