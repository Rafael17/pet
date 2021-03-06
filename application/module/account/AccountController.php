<?php
namespace pluralpet;

class AccountController extends Controller{
    
    function index(){
        if(!isset($_SESSION['user'])){
            header('Location: /account/login/3');
            die;
        }
        $user = new User();
        $pregunta = new \pluralpet\Pregunta();
        $this->view->assign(array('publicaciones'=>$user->getPublicacionesStatus()));
        $this->view->assign(array('user' => $user->get($_SESSION['user']->id)));
        $this->view->assign(array('preguntas'=>$pregunta->getByRespondent()));
        $this->view->setFile('summary');
        $this->view->render();
    }
    
    
    function mobile(){
        $this->view->setMessage("En este momento no es posible publicar desde tu mobile. <br/><br/>Por favor publique desde una computadora desktop.");
        $this->view->render();
        die;
    }
    
    
    
    
    function nueva_contrasena(){
        //$user_obj->clearUserTempHash($_GET['key']);
        
        if(strcmp($_POST['password'],$_POST['password_repetir'])!==0){
            $this->view->assign(array('invalid'=>true));
            $this->view->setFile('recuperar_clave');
            $this->view->render();
            die;
        }
        
        $user = new \pluralpet\User();
        $user->updatePasswordFromHash($_POST['password'],$_POST['key']);
        
        $this->view->setFile('login');
        $this->view->render();
    }
    
    function recupere_contrasena(){
        $user_obj = new User();
        
        if(isset($_GET['key'])){
            $result = $user_obj->findKey($_GET['key']);
            if($result===false){
                $this->view->assign(array('invalid_email'=>true));
                $this->view->setMessage('No has podido resetear tu contrase&ntilde;a. Por favor intente de nuevo.');
                $this->view->render();
            }else{
                $this->view->assign(array('invalid_email'=>true));
                $this->view->setFile('recuperar_clave');
                $this->view->render();
            }
        }else{
            if(isset($_POST['email'])){
                
                $result = $user_obj->checkEmail();
                
                if($result===false){
                    $this->view->assign(array('invalid_email'=>true));
                    $this->view->setFile('forgot_password');
                    $this->view->render();
                }else{
                    $user = $result;
                    $hash = $user_obj->updateUserTempHash($user->id);
                    include(ROOT.'application/module/email/recuperar_clave.php');
                    
                    $this->view->setMessage('Chequea tu email para recuperar tu clave.');
                    $this->view->render();
                }
            }else{
                $this->view->setFile('forgot_password');
                $this->view->render();
            }
        }
    }
    
    function preguntas(){
        $user = new User();
        $this->view->assign(array('publicados'=>$user->getPublicacionesWithQuestions($_GET)));
        $this->view->setFile('preguntas');
        $this->view->render();
    }
    
    
    
    function publicados(){
        $user = new User();
        $this->view->assign(array('publicados'=>$user->getPublicaciones($_GET)));
        $this->view->setFile('publicados');
        $this->view->render();
    }
    
    function login(){
        $user = new User();
        if($result = ($user->valiateUser())){
            $_SESSION['user'] = $result;
            $referer = (explode("/",$_SERVER['HTTP_REFERER']));
            if(strcmp($referer[4],'nueva_contrasena')===0){
                header('Location: /account/');
            }else{
                if(isset($_SESSION['referrer'])){
                    $s = $_SESSION['referrer'];
                    unset($_SESSION['referrer']);
                    if(strcmp($s, '/account/login')===0){
                        $s = '/';
                    }
                    header('Location: '.$s);
                }else{
                    header('Location: '.$_SERVER['HTTP_REFERER']);
                }
            }
        }
        else{
            //echo '<pre>';print_r($_POST);
            $args = $this->request->getArgs();
            
            if(isset($_POST['user'])){// failed login
                $this->view->assign(array('invalid'=>true));
                if(!isset($_SESSION['referrer'])){ 
                    $_SESSION['referrer'] = $_SERVER['HTTP_REFERER'];
                }
            }else if($args[0]==='1'){
                $this->view->assign(array('contactar'=>true));
                $_SESSION['referrer']=$_SERVER['HTTP_REFERER'];
            }else if($args[0]==='2'){
                $_SESSION['referrer']='/';
            }else if($args[0]==='3'){
                $_SESSION['referrer']='/account/';
            }else{
                $_SESSION['referrer']=$_SERVER['HTTP_REFERER'];
            }
            $this->view->setFile('login');
            $this->view->render();
        }
    } 
    
    
    function logout(){
        $_SESSION = array();
        unset($_SESSION);
        header('Location: /');
    }
    
    function register(){
        $user = new User();
        $user->addUser();
        echo json_encode(array('success'=>true));
        die;
        new SessionController();
        header('Location: /');
    }
    
    
    
    
    function contactar(){
        $user = new User();
        $response = $user->get($_GET['user_id']);
        $json = array('id'=>$response->id,'email'=>$response->email,'telefono'=>$response->phone,'firstname'=>$response->firstname,'lastname'=>$response->lastname);
        echo json_encode($json);
    }
    
    
    function updateUser(){
        $user = new User();
        $response = $user->updateUser($_POST);
        //echo $response;
        header('Location: /account/');
    }
    
    
    
    
    
    
    
    
    
    
    
    
}