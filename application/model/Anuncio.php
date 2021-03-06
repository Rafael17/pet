<?php
namespace pluralpet;

class Anuncio extends Model{
    function __construct() {
        parent::__construct();
        
    }
    
    function add(){
        //header("Content-type: text/plain");
        //print_r($_POST);die;
        $sql =  "INSERT INTO anuncio (sub_tab,titulo,link,departamento,ciudad_barrio,direccion,descripcion,horario,telefono,usuario,status,fecha)"
                . " VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_POST['tipo'],$_POST['titulo'],$_POST['link'],$_POST['departamento'],
            $_POST['ciudad_barrio'],$_POST['direccion'],$_POST['descripcion'],
            $_POST['horario'],$_POST['telefono'],$_SESSION['user']->id,'activo',$_POST['fecha']));
        $insert_id = $this->pdo->lastInsertId(); 
        
        $sql =  "UPDATE foto set publication_id=?,temp_hash=null where temp_hash=? and usuario=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($insert_id,$_POST['publication_hash'],$_SESSION['user']->id));
        
        $affected_rows = $stmt->rowCount();
        return $insert_id;
    }
    
    function delete(){
        $sql =  "DELETE FROM anuncio WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_POST['id']));
        $affected_rows = $stmt->rowCount();
        return $affected_rows;
    }
    
    function get($type){
        $sql = "SELECT * FROM anuncio WHERE sub_tab=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($type));
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }
    
    function getByID($id){
        $sql = "SELECT * FROM anuncio WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($id));
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows[0];
    }
    
    
    
    
    
    function update($id){
        
        $sql =  "UPDATE anuncio set sub_tab=?,fecha=?,horario=?,departamento=?,ciudad_barrio=?,titulo=?,descripcion=? "
                . "WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_POST['tab_select'],$_POST['fecha'],$_POST['horario'],
            $_POST['departamento'],$_POST['ciudad_barrio'] ,$_POST['titulo'],$_POST['descripcion'],intval($id)));
        return $id;
    }
    
    
    
    
    
    
    function getAll($type){
        
        $sql = "SELECT anuncio.*, foto.name as foto_name, foto.usuario as foto_usuario  FROM anuncio LEFT OUTER JOIN foto on foto.publication_id=anuncio.id "
                . "WHERE sub_tab=? group by anuncio.id";
        
        
        //$sql = "SELECT * FROM mascota WHERE tab=? and animal=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($type));
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }
    
    
    
    
    
    
    
    
    
    function getAllWhere($where_stmt,$where_vals){
        $sql = "SELECT * FROM anuncio ".$where_stmt;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($where_vals);
        $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $rows;
    }
    
    function getAllJoinPhoto($where_stmt,$where_vals){
        $sql = "SELECT anuncio.*,foto.name as foto_name, foto.usuario as foto_usuario FROM anuncio LEFT OUTER JOIN (select * from foto order by photo_order) as foto on anuncio.id=foto.publication_id ".$where_stmt;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($where_vals);
        $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $rows;
    }
    
    
    
    
    function incrementViewCount($id){
        $sql =  "UPDATE anuncio set views=views+1 WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($id));
        $affected_rows = $stmt->rowCount();
        return $affected_rows;
    }
    
    function updateStatus($status){
        $sql =  "UPDATE anuncio set status=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($status,$_POST['id']));
        $affected_rows = $stmt->rowCount();
        return $affected_rows;
    }
    
    
    
    
    
    function filter($vals){
        
        
        $orden = $vals['orden'];
        unset($vals['orden']);
        $vals['status']='activo';
        switch($orden){
            case 'barato':
                $order_by = "ORDER BY precio_sum";
            break;
            case 'caro':
                $order_by = "ORDER BY precio_sum DESC";
            break;
            case 'visitas':
                $order_by = "ORDER BY views DESC";
            break;
            default:
                $order_by = "ORDER BY id DESC";
            break;
        }
        $order_by.=", foto.photo_order";
        
        $tabs = $vals['tab'];
        unset($vals['tab']);
        unset($vals['PHPSESSID']);// hot fix for prod
        foreach($vals as $rows){
            $vals_decoded[]=urldecode($rows);
        }
        
        if(!empty($vals)){
            $stmt = "WHERE ".implode("=? and ",array_keys($vals))."=? ";
        }
        
        if(count($tabs)>0){
            if(empty($stmt)){
                $stmt=" WHERE ";
            }else{
                $stmt.=" and ";
            }
            $stmt.= " (tab='".implode("' or tab='",$tabs)."') ";
        }
        
        //adjust _table accordingly 
        $sql =    "SELECT anuncio.*, foto.name as foto_name, foto.usuario as foto_usuario, foto.photo_order "
                . "FROM anuncio "
                . "LEFT OUTER JOIN (SELECT name, usuario,photo_order,publication_id FROM foto WHERE _table='anuncio' order by photo_order) "
                . "AS foto on foto.publication_id=anuncio.id "
                . "$stmt "
                . "group by anuncio.id "
                . "$order_by ";
        //echo $sql;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($vals_decoded);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
        
        
        
        
        
        
        
        /*
        foreach($vals as $rows){
            $vals_decoded[]=urldecode($rows);
        }
        $stmt = implode("=? and ",array_keys($vals))."=? ";
        $sql = "SELECT * FROM anuncio WHERE ".$stmt;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($vals_decoded);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
         * 
         */
    }
    
}