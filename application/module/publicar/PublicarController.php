<?php
namespace pluralpet;

class PublicarController extends \pluralpet\Controller{
    
    function index(){
        if(empty($_SESSION['user'])){
            $this->view->setFilePath(ROOT.'application/module/account/login.php');
            $this->view->render();
            die;
        }
        $this->view->setFile($this->request->getMethod());
        $this->view->render();
    }
    
    function description(){
        include ROOT.'application/module/publicar/description.php';
        //$this->view->setFile('description');
        //$this->view->render();
    }
    
    
    
    
    function delete(){
        $table = '\pluralpet\\'.ucfirst($_POST['table']);
        $model = new $table();
        $model->delete();
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    
    
    
    
    
    
    function addAnuncio(){
        /*
        if ($_FILES["file"][0]["error"] > 0)
        {
            echo "Error:<br/>";
            echo "<pre>";
            print_r($_FILES["file"]["error"]);
            die;
        }
        else
        {
            $counter=0;
            foreach($_FILES['file'] as $k=>$file){
                foreach($file as $key=>$row){
                    if(strcmp($k,'name')==0){
                        $name = $row;
                        $org_name = $name;
                    }
                    if(strcmp($k,'tmp_name')==0){
                        $ext = substr($name, strrpos($name, '.')+1);
                        $image_name = time().'.'.$ext;
                        move_uploaded_file($row, UPLOAD.time().'.'.$ext);
                    }
                    //echo "$k: " . $row . "<br>";
                }
            }
        }
        $mascota = new \pluralpet\Anuncio();
        $mascota->add($image_name,$org_name);
         */
        
        $anuncio = new \pluralpet\Anuncio();
        $id =  $anuncio->add();
        echo '/anuncio/'.$id;
        //header('Location: /anuncio/'.$id);
    }
    
    
    function addMascota(){
        
        $mascota = new \pluralpet\Mascota();
        $id =  $mascota->add();
        header('Location: /'.$_POST['tab'].'/'.$id);
        
    }
    
    
    
    
    
    function addPhoto(){
        $upload_dir = UPLOAD.$_SESSION['user']->id;
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $upload_entry_dir = $upload_dir.'/';//.'/'.$_POST['publication_id'];

        if ($_FILES["file"][0]["error"] > 0)
        {
            echo "Error:<br/>";
            echo "<pre>";
            print_r($_FILES["file"]["error"]);
            die;
        }
        else
        {
            if (file_exists($_FILES['file']['tmp_name']) || is_uploaded_file($_FILES['file']['tmp_name'])){
                $file_name = basename($_FILES['file']['name']);
                $ext = substr($_FILES["file"]['name'], strrpos($_FILES["file"]['name'], '.')+1);
                
                $image_name = time().'_'.substr(rand(),0,5).'.'.$ext;
                
                $foto = new \pluralpet\Foto();
                $foto->add($image_name,$file_name,$_POST['publication_hash'],$_POST['table']);
                
                move_uploaded_file($_FILES["file"]['tmp_name'],$upload_entry_dir.$image_name);
                
                $this->resize_crop_image(200, 200, $upload_entry_dir.$image_name,$upload_entry_dir.'thumb_'.$image_name);
                
                
                
                
                
                
                
            }
        }
        die;
    }
    
    
    
    
    
    function addProducto(){
        
        if ($_FILES["file"][0]["error"] > 0)
        {
            echo "Error:<br/>";
            echo "<pre>";
            print_r($_FILES["file"]["error"]);
            die;
        }
        else
        {
            $counter=0;
            foreach($_FILES['file'] as $k=>$file){
                foreach($file as $key=>$row){
                    if(strcmp($k,'name')==0){
                        $name = $row;
                        $org_name = $name;
                    }
                    if(strcmp($k,'tmp_name')==0){
                        $ext = substr($name, strrpos($name, '.')+1);
                        $image_name = time().'.'.$ext;
                        move_uploaded_file($row, UPLOAD.time().'.'.$ext);
                    }
                    //echo "$k: " . $row . "<br>";
                }
            }
        }
        $producto = new \pluralpet\Producto();
        $producto->add($image_name,$org_name);
        header('Location: /'.$_POST['tab'].'/'.$_POST['animal']);     
    }
    
    
    
    
    
    
    //http://localhost/account/publicados/?status=activo
    function modify(){
        switch($_POST['event']){
            case 'editar':
                header('Location: /'.$_POST['table'].'/'.$_POST['id']);
            break;
            case 'borrar':
                $this->delete();
            break;
            default:
                $table = '\pluralpet\\'.ucfirst($_POST['table']);
                $model = new $table();
                $model->updateStatus($_POST['event']);
                header('Location: /account');    
            break;
            
        }
    }
    
    
    
    
    
    
    
    
    
    function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
        $imgsize = getimagesize($source_file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];

        switch($mime){
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;

            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 7;
                break;

            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 80;
                break;

            default:
                return false;
                break;
        }

        $dst_img = imagecreatetruecolor($max_width, $max_height);
        $src_img = $image_create($source_file);

        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if($width_new > $width){
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        }else{
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }

        $image($dst_img, $dst_dir, $quality);

        if($dst_img)imagedestroy($dst_img);
        if($src_img)imagedestroy($src_img);
    }
    
    
}