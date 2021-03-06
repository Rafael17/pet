<?php
namespace pluralpet;

class Pregunta extends Model{
    function __construct() {
        parent::__construct();
        
    }
    
    function publicarPregunta(){
        
        $sql = "SELECT usuario FROM ".$_POST['_table']." where id=? ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_POST['publication_id']));
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $respondent = $rows[0]['usuario'];
        
        $sql =  "INSERT INTO pregunta (question,publication_id,_table,asker,respondent,question_timestamp) VALUES(?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_POST['question'],$_POST['publication_id'],$_POST['_table'],$_SESSION['user']->id,$respondent,time()));
        $affected_rows = $stmt->rowCount();
        
        $publication_id = $_POST['publication_id'];
        $table = $_POST['_table'];
        
        $sql = "SELECT * FROM user where id=? ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($respondent));
        $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
        $user = $rows[0];
        require(ROOT.'application/module/email/nueva_pregunta.php');
        
        
        return $affected_rows;
    }
    
    function publicarRespuesta(){
        $sql =  "UPDATE pregunta set answer=?,answer_timestamp=? where id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_POST['answer'],time(),$_POST['pregunta_id']));
        $affected_rows = $stmt->rowCount();
        
        
        
        $sql =  "SELECT user.*,pregunta._table,pregunta.publication_id FROM pregunta INNER JOIN user on pregunta.asker=user.id where pregunta.id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_POST['pregunta_id']));
        $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
        $user = $rows[0];
        require(ROOT.'application/module/email/nueva_respuesta.php');
        
        
        return $affected_rows;
    }
    
    function getByRespondent(){
        $sql = "SELECT * FROM pregunta where respondent=? and answer is null";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_SESSION['user']->id));
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }
    
    function get($publication_id,$table){
        $sql = "SELECT * FROM pregunta where _table=? and publication_id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($table,$publication_id));
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }
}