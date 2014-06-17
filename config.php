<?php
//namespace pluralpet;
// Directories
$constant['ROOT'] =  dirname(__FILE__).'/';
//$constant['ROOT'] = "";

$constant['MEDIA'] = '/media/';

$constant['UPLOAD'] = $constant['ROOT'].'media/upload/';

$constant['PUBLIC_PATH'] = '/public/';

//$constant['MEDIA'] = '/public/media/';
// Database
$constant['DB_ADD'] = 'localhost:8889';

$constant['DB_NAME'] = 'pet';

$constant['DB_USER'] = 'root';

$constant['DB_PASSWORD'] = '';


$GLOBALS['nav_menu'] = array('publicar'=>array(
                                                            array('mascota'=>'Mascotas'),
                                                            array('producto'=>'Productos En Tienda'),
                                                            array('anuncio'=>'Anuncios')
                                ),'comprar'=>array(
                                                            array('perro'=>'Perros'),
                                                            array('gato'=>'Gatos'),
                                                            array('ave'=>'Aves'),
                                                            array('reptil'=>'Reptiles'),
                                                            array('pez'=>'Peces'),
                                                            array('mamifero'=>'Peque&ntilde;os mamiferos'),
                                                            array('otro'=>'Otros')
                                ),'tienda'=> array(
                                                            array('' => 'Ir a la tienda'),
                                                            array('ofertas' => 'Ofertas del dia')
                                ),'adoptar'=> array(
                                                            array('perro'=> 'Perros'),
                                                            array('gato'=> 'Gatos'),
                                                            array('otro'=> 'Otros')
                                ),'perdidos y encontrados'=> array(
                                                            array('perro'=> 'Perros'),
                                                            array('gato'=> 'Gatos'),
                                                            array('otro'=> 'Otros')
                                ),'cruzar'=> array(
                                                            array('perro'=> 'Perros'),
                                                            array('gato'=> 'Gatos'),
                                                            array('otro'=> 'Otros')
                                ),'anuncios'=> array(
                                                            array('veterinaria'=> 'veterinarias'),
                                                            array('paseador'=> 'paseadores'),
                                                            array('adiestrador'=> 'Adiestradores'),
                                                            array('pensionado'=> 'pensionado'),
                                                            array('peluqueria'=> 'peluqueria'),
                                                            array('alimento'=> 'alimento'),
                                                            array('servicio-medico-adicionales'=> 'Servicios m&eacute;dicos adicionales'),
                                                            array('otros'=> 'otros')
                                ),'consejos'=> array(
                                                            array('perro'=>'Perros'),
                                                            array('gato'=>'Gatos'),
                                                            array('ave'=>'Aves'),
                                                            array('reptil'=>'Reptiles'),
                                                            array('peces'=>'Peces'),
                                                            array('mamiferos'=>'Peque&ntilde;os mamiferos'),
                                                            array('otros'=>'Otros')
                                ),'blog'=> array()
                                
                                );



$GLOBALS['departamento'] = array('Artigas'=>array('Artigas','Bella Union'),
                     'Canelones'=>array('Ciudad de la Costa','Las Piedras','Barros Blancos','Pando','La Paz','Canelones','Santa Lucia','Progreso'),
                     'Cerro Largo'=>array('Melo','Rio Branco'),
                     'Colonia'=>array('Carmelo','Colonia del Sacramento','Juan Lacaze','Nueva Helvecia','Rosario'),
                     'Durazno'=>array('Durazno'),
                     'Flores'=>array('Trinidad'),
                     'Florida'=>array('Florida'),
                     'Lavalleja'=>array('Minas'),
                     'Maldonado'=>array('Maldonado','San Carlos','Punta Del Este'),
                     'Montevideo'=>array(''),
                     'Paysandu'=>array('Paysandu'),
                     'Rio Negro'=>array('Fray Bentos','Young'),
                     'Rivera'=>array('Rivera'),
                     'Rocha'=>array('Rocha'),
                     'Salto'=>array('Salto'),
                     'San Jose'=>array('San Jose de Mayo','Ciudad del Plata','Libertad'),
                     'Soriano'=>array('Mercedes','Dolores'),
                     'Tacuarembo'=>array('Tacuarembo','Paso de los Toros'),
                     'Treinta y Tres'=>array('Treinta y Trest'),
                         
    );





$raza=array();
$raza['perro'] = array('','Akita Inu', 'Alaskan Malamute', 'Barzoi', 
    'Basset Azul de Gascuña', 'Basset Hound', 'Beagle', 'Beagle Harrier', 'Beauceron', 'Bichón Maltés', 'Bobtail',
    'Border Collie', 'Boxer', 'Boyero de Berna', 'Braco Alemán', 'Braco Francés', 'Briard', 'Bull Terrier Inglés', 
    'Bulldog Francés', 'Bulldog Inglés', 'Bullmastiff', 'Cairn Terrier', 'Cane Corso', 'Caniche', 'Cavalier King Charles', 
    'Chihuahua', 'Cimarron', 'Chow Chow', 'Cocker Spaniel Americano', 'Cocker Spaniel Inglés', 'Collie Rough', 'Collie Smooth', 
    'Dálmata', 'Doberman', 'Dogo Argentino', 'Dogo de Burdeos', 'Epagneul Bretón', 'Epagneul Francés', 'Epagneul Japonés', 
    'Fox Terrier', 'Galgo Español', 'Galgo Irlandés', 'Golden Retriever', 'Gordon Setter', 'Gos d\'Atura', 'Gran Danés', 
    'Husky Siberiano', 'Komondor', 'Labrador Retriever', 'Lebrel Afgano', 'Lebrel Polaco', 'Mastiff', 'Mastín de los Pirineos', 
    'Mastín Español', 'Mastín Napolitano', 'Montaña de los Pirineos', 'Norfolk Terrier', 'Norwich Terrier', 'Papillon', 
    'Pastor Alemán', 'Pastor Australiano', 'Pastor Belga', 'Pastor Blanco Suizo', 'Pastor de los Pirineos', 'Pekinés', 
    'Pequeño Azul de Gascuña', 'Pequeño Basset Griffon', 'Pequeño Brabantino', 'Pequeño Perro León', 'Pequeño Perro Ruso', 
    'Pequeño Sabueso Suizo', 'Perdiguero de Burgos', 'Perdiguero Portugués', 'Perro de Agua Español', 'Perro Lobo de Checoslovaquia', 'Pinscher miniatura', 
    'Pit Bull', 'Podenco Canario', 'Podenco Ibicenco', 'Pointer Inglés', 'Presa Canario', 'Pug', 'Rafeiro do Alentejo', 
    'Rottweiler', 'Samoyedo', 'San Bernardo', 'Schnauzer gigante', 'Schnauzer mediano', 'Schnauzer miniatura', 'Scottish Terrier', 
    'Setter Inglés', 'Setter Irlandés', 'Shar Pei', 'Shih Tzu', 'Spitz', 'Springer Spaniel Galés', 'Springer Spaniel Inglés', 
    'Teckel', 'Terranova', 'Weimaraner', 'Westies', 'Whippet', 'Yorkshire Terrier','OTRO');

$raza['gato'] = array('','Abisinio','Aphrodite\'s Giants','Australian Mist','American Curl','Azul ruso','American shorthair','American wirehair',
    'Angora turco','Africano doméstico','Bengala','Bobtail japon&eacute;s','Bombay','Bosque de Noruega','Brazilian Shorthair','British Shorthair',
    'Burm&eacute;s','Burmilla','Cornish rex','California Spangled','Ceylon','Cymric','Chartreux','Deutsch Langhaar','Devon rex','Dorado africano','Don Sphynx',
    'Europeo com&uacute;n','German Rex','Habana brown','Himalayo','Korat','Khao Manee','Maine Coon','Manx','Mau egipcio','Munchkin','Ocicat','Oriental',
    'Oriental de pelo largo','Ojos azules','Persa','Peterbald','Pixi Bob','Ragdoll','Sagrado de Birmania','Scottish Fold','Selkirk rex','Serengeti',
    'Seychellois','Siam&eacute;s','Siam&eacute;s Moderno','Siam&eacute;s Tradicional','Siberiano','Snowshoe','Sphynx','Tonkin&eacute;s','Van Turco'
);

$raza['mamifero'] = array('','Conejo Enano','Cobaya','Ardilla de Corea','Chinchilla','Ardilla Richardson','Rata Canguro','H&aacute;mster Com&uacute;n',
    'H&aacute;mster Ruso','H&aacute;mster Ruso Albino','H&aacute;mster Ruso Blanco','H&aacute;mster Campbelli','H&aacute;mster Roborowski','Hur&oacute;n',
    'Erizo Enano','Jerbo');

$raza['ave'] = array('','Agapornis','Amazonas','Cacat&uacute;as','Caiques','Conuros','Eclectus','Forpus','Guacamayo','Loris','Ninfas','Periquitos',
    'Pionus','Poicephalus','Yacos','Canario','Diamante Mandarín','Loro Gris Africano','Ninfa','Periquito');

$raza['reptil'] = array('','Tortuga','Musurana Marr&oacute;n','Serpiente del ma&iacute;z','Serpiente Rey de California','Pit&oacute;n Birmana','Culebra',
    'Iguana','Musurana Marr&oacute;n','Gecko');

$raza['pez'] = array('','Calico','Burbuja','Carpa','Cometa','Telescopico','Fantail','Carasius','Ramiretzi','Besador','Betta','Gourami enano','Gourami Azul',
    'Oscar','Locha Payaso','Arlequ&iacute;n','Boca de Fuego','Espadas','Escalar','Discus','Corydora','Vieja del agua','Ne&oacute;n','Pez Hacha','Molly negro',
    'Labeo de cola roja','Barbo Tigre','Danio Zebra','Ballesta Payaso','Ballesta','Angel Rey','Angel Coral','Angel Zanclus','Leopardo','Escorpi&oacute;n','Cirujano',
    'Damicela','Payaso','Puffer','Mariposa','Labroides','Morena','Cangrejo Ermitaño','Hippocampo','Hippocampo Kuda');

$raza['otro'] = array('','Caballo');


$GLOBALS['raza']=$raza;
$GLOBALS['raza_o_animal']= array('perro'=>'Raza','gato'=>'Raza','mamifero'=>'Animal','pez'=>'Animal','mamifero'=>'Animal','ave'=>'Animal','reptil'=>'Animal','otro'=>'Animal');



// Define constants
foreach($constant as $key => $row){
    define($key,$row);
}

// Autoload classes
function __autoload($class_name) {
    //preg_match('/\\.*/', $class_name,$match);
    //$class_name = $match[0];
    //echo $class_name;
    $aName = explode('\\',$class_name);
    $nameSize = count($aName);
    $class_name = $aName[$nameSize-1];
    if( file_exists(ROOT . '/application/controller/' . $class_name.'.php')) {
            //require_once(ROOT . '/application/controller/' . $class_name . '.php');
    }
    if( file_exists(ROOT . 'application/model/' . $class_name.'.php')) {
            require_once(ROOT . 'application/model/' . $class_name . '.php');
    }
    if( file_exists(ROOT . '/framework/' . $class_name . '.php')) {
            require_once(ROOT . '/framework/' . $class_name . '.php');
    }
    
    
}

?>