<?php
namespace pluralpet;

class Mascota extends Model{
    function __construct() {
        parent::__construct();
        
    }
    
    function add(){
        
        
        
        $sql =  "INSERT INTO mascota (animal,animal_detail,sexo,edad,tamano,pedigree,criadero,precio,titulo,descripcion,tab,fecha,departamento,ciudad_barrio,usuario,status,moneda)"
                . " VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'activo',?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_POST['animal'],  htmlentities($_POST['animal_detail']),$_POST['sexo'],$_POST['edad'],
            $_POST['tamano'],$_POST['pedigree'],$_POST['criadero'],$_POST['precio'],$_POST['titulo'],
            ($_POST['descripcion']),$_POST['tab'],$_POST['fecha'],$_POST['departamento'],
            $_POST['ciudad_barrio'],$_SESSION['user']->id,$_POST['moneda']));
        $insert_id = $this->pdo->lastInsertId(); 
        
        
        //str_replace("&amp;nbsp;"," ",htmlentities(strip_tags($_POST['descripcion'])))
        
        
        // Update foto with the new added publication id
        $sql =  "UPDATE foto set publication_id=?,temp_hash=null where temp_hash=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($insert_id,$_POST['publication_hash']));
        
        //echo $_POST['animal_detail'];
        
        //$affected_rows = $stmt->rowCount();
        return $insert_id;
    }
    
    function delete(){
        $sql =  "DELETE FROM mascota WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_POST['id']));
        $affected_rows = $stmt->rowCount();
        return $affected_rows;
    }
    
    
    
    
    
    
    
    
    function getAll($type,$animal){
        
        $sql = "SELECT mascota.*, foto.name as foto_name, foto.usuario as foto_usuario  FROM mascota LEFT OUTER JOIN foto on foto.publication_id=mascota.id "
                . "WHERE tab=? and animal=? group by mascota.id";
        
        
        
        //$sql = "SELECT * FROM mascota WHERE tab=? and animal=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($type,$animal));
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }
    
    function getAllWhere($where_stmt,$where_vals){
        
        $sql = "SELECT mascota.*,foto.name as foto_name, foto.usuario as foto_usuario FROM mascota ".$where_stmt;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($where_vals);
        $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $rows;
    }
    
    function get($id){
        $sql = "SELECT * FROM mascota WHERE mascota.id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($id));
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows[0];
    }
    
    
    
    
    
    
    
    
    
    
    function filter($vals){
        if(isset($vals['sexo'])){//camada
            $sexo = $vals['sexo'];
            unset($vals['sexo']);
            $sexo_stmt = "and (sexo='camada' or sexo='".  mysql_escape_string($sexo)."')";
        }
        
        foreach($vals as $rows){
            $vals_decoded[]=urldecode($rows);
        }
        
        $stmt = implode("=? and ",array_keys($vals))."=? ";
        $sql =    "SELECT mascota.*, foto.name as foto_name, foto.usuario as foto_usuario  "
                . "FROM mascota LEFT OUTER JOIN foto on foto.publication_id=mascota.id WHERE ".$stmt." "
                . "$sexo_stmt group by mascota.id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($vals_decoded);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        
        return $rows;
    }
    
    
    
    
    
    function updateStatus($status){
        $sql =  "UPDATE mascota set status=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($status,$_POST['id']));
        $affected_rows = $stmt->rowCount();
        return $affected_rows;
    }
    
}