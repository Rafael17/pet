
window.mobilecheck = function() {
  var check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
  return check;
}







function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}






function today(){
    var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();

    var output =  ((''+month).length<2 ? '0' : '') + month + '/' +
        ((''+day).length<2 ? '0' : '') + day +'/'+d.getFullYear();

    return output;
}






var Foto = {
    remove:function(id){
        $.ajax({
            url:'/publicar/deletePhoto',
            type:'post',
            data:{id:id},
            success:function(response){
                $('#'+id).remove();
                $('.unsortable').show();
                
            }
        });
    }
}





var Preguntas = {
    focus: function(elem){
        //$(elem).closest('form').find('textarea').css('height','100px');
        $(elem).closest('form').find('button').show();
    },
    blur:function(elem){
        if($(elem).val()==''){
            //$(elem).closest('form').find('textarea').css('height','30px');
            $(elem).closest('form').find('button').hide();
        }
    }
}







var Ready = {
    init: function(){
        $("select.ciudad_barrio").select2({
            placeholder: "Elige Ciudad/Barrio",
            allowClear: true,
            enable:false,
            readonly:true
        });

        $("select.departamento").select2({
            placeholder: "Elige Departamento",
            allowClear: true,
        }).on('change', function(e){
            $('select.ciudad_barrio').html('');
            var data = Publicar.departamento[e.val];
            $('select.ciudad_barrio').append('<option></option>');
            for(var i in data){
                    $('select.ciudad_barrio').append('<option value="' + data[i]+ '">'+data[i]+'</option>');
            }
            $('.ciudad_barrio').show();
        });






        $("select.animal_detail").select2({
            placeholder: "Elige Animal/Raza",
            allowClear: false
        });
        $("select.refugio").select2({
            placeholder: "Elige Refugio",
            allowClear: false
        });
        $("select.moneda").select2({
            placeholder: "Moneda",
            allowClear: false,
            minimumResultsForSearch: -1
        });
        
        
        
        
        
        
        $("select.animal").select2({
            placeholder: "Elige Animal",
            allowClear: true
        }).on('change', function(e){
            $('select.tab').html('');
            var data = Publicar.producto[e.val];
            $('select.tab').append('<option></option>');
            for(var i in data){
                    $('select.tab').append('<option value="' + data[i]+ '">'+data[i]+'</option>');
            }
            $('select.tab').show();
        });
        $("select.tab").select2({
            placeholder: "Elige Producto",
            allowClear: true,
            enable:false,
            readonly:true
        });
        
        
        
        
        
        
        
        
        
        $("#fotos").dropzone({
            addRemoveLinks:true,
            maxFiles:6,
            dictRemoveFile:'Remover imagen',
            success:function(file,response){
                file.new_filename = response;
            },
            removedfile: function(file) {
                var name = file.new_filename;        
                $.ajax({
                    type: 'POST',
                    url: '/publicar/deletePhotoPrePublish',
                    data: "filename="+name,
                    dataType: 'html'
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
            }
        });
        
        
        
        
        $('.datepicker').datepicker({ 
            changeYear: true, 
            gotoCurrent:true,
            yearRange: "1990:2015",
            dateFormat: 'dd/mm/yy',
            altFormat: "yy-mm-dd",
            altField: "#fecha"
        });
        
        
        
        
        $('select').on('change',function(){Filter.submit()});
        if($('.dropzone').length>0){
            
            Ready.initTextarea();
            
            //nicEditors.allTextAreas({buttonList:['bold','italic','underline']});
        }
    },
    
    
    initTextarea: function(){
        
        tinymce.init({
                selector: "textarea",
                theme: "modern",
                language: "es",
                menubar : false,
                fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
                plugins: [
                    "advlist autolink lists link charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar1: "fontsizeselect |  bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | undo redo | print preview | forecolor backcolor emoticons",
                image_advtab: true,
                templates: [
                    {title: 'Test template 1', content: 'Test 1'},
                    {title: 'Test template 2', content: 'Test 2'}
                ]
            });
        
    },
    
    //styleselect
    
    initEdit: function(date,table,uri_key){
        
        
        Ready.initTextarea();
        //nicEditors.allTextAreas({buttonList:['bold','italic','underline']});
        
        var fecha = date;
        
        
        
        
        
        
        $("#fotos_edit").dropzone({
            maxFiles:1,
            success:function(file,response){
                $('#fotos_edit').css('background-image','none');
                location.reload();
            }
            
        });
        
        
        
        
        
        /*
        $('input[type=file]').change(function() {
            //location.reload();
            //$('#submit_photo').trigger("click",function(){location.reload();});
        });
        /*
        $('#fotos').on("click",function(){
            document.getElementById('selectedFile').click();
        });
*/
        $('.datepicker').datepicker({ 
            changeYear: true, 
            gotoCurrent:true,
            yearRange: "1990:2015",
            dateFormat: 'dd/mm/yy',
            altFormat: "yy-m-d",
            altField: "#fecha",
            onClose:function(dateText){
                if(dateText==''){
                    $(this).datepicker('setDate','');
                }
            }
        });

        function fechaSetDatepicker(f){
            var fecha = f.split('-');
            var ret = fecha[2]+'/'+fecha[1]+'/'+fecha[0];
            if(fecha[2]==='00'){
                return;
            }

            $(".datepicker").datepicker("setDate", ret);
        }
        fechaSetDatepicker(fecha);

        $(".sortable_photo").sortable({
            items: "li:not(.unsortable)",
            update: function( event, ui ) {
                var order = {};
                $('#photo_order li').each(function(index,elem){
                    order[$(elem).attr('id')] = index;
                });

                var data = {order:order,publication_id:$('#publication_id').val()};

                $.ajax({
                    url:'/publicar/updatePhoto/',
                    data:data,
                    type:'post',
                    success:function(response){
                        console.log(response);
                    }
                });
            }
        });

        $("select.tab_select").select2({
            placeholder: "Eligue donde publicar",
            allowClear: true,
            enable:false,
            readonly:true
        }).on('change', function(e){
            window.location = '/'+table+'/editar/'+$('#form_description').find('#publication_id').val()+'/?'+uri_key+'='+e.val;
        });
    }
    
    
    
    
}
$(document).ready(function(){Ready.init();});



var departamentos={'Artigas':['','Artigas','Bella Union','Tom&aacute;s Gomensoro','Baltasar Brum','Sequeira'],
                     'Canelones':['','Ciudad de la Costa','Las Piedras','Barros Blancos','Pando','La Paz','Canelones','Santa Lucia','Progreso','18 de Mayo',
    'Aguas Corrientes','Atl&aacute;ntida','Colonia Nicolich','Empalme Olmos','Joaqu&iacute;n Su&aacute;rez','La Floresta','Los Cerrillos','Migues','Montes',
    'Parque del Plata','Paso Carrasco','Salinas','San Antonio','San Bautista','San Jacinto','San Ram&oacute;n','Santa Rosa','Sauce','Soca','Tala','Toledo'],
                     'Cerro Largo':['','Acegu&aacute;','Fraile Muerto','Isidoro Nobl&iacute;a','Melo','Rio Branco','Tupamba&eacute;'],
                     'Colonia':['','Carmelo','Colonia del Sacramento','Florencio S&aacute;nchez','Juan Lacaze','Nueva Helvecia','Nueva Palmira','Omb&uacute;es de Lavalle','Rosario','Tarariras'],
                     'Durazno':['','Blanquillo','Carmen','Centenario','Durazno','La Paloma','Santa Bernardina','Sarand&iacute; del Yi'],
                     'Flores':['','Trinidad'],
                     'Florida':['','25 de Mayo','25 de Agosto','Cardal','Casup&aacute;','Cerro Colorado','Florida','Fray Marcos','Nico P&eacute;rez','Sarand&iacute; Grande'],
                     'Lavalleja':['','Jos&eacute; Pedro Varela','Sol&iacute;s de Mataojo','Jos&eacute; Batlle y Ord&oacute;&ntilde;ez','Mariscala','Minas'],
                     'Maldonado':['','Maldonado','San Carlos','Punta Del Este','Aigu&aacute;','Garz&oacute;n','Pan de Az&uacute;car','Piri&aacute;polis','Sol&iacute;s Grande'],
                     'Montevideo':['',"Aguada","Aires Puros","Arroyo Seco","Atahualpa","Barra de Carrasco","Bella Vista","Belvedere","Bolivar","Brazo Oriental","Buceo",
        "Capurro","Carrasco","Casabo","Centro","Cerrito","Cerro","Ciudad Vieja","Cno. Carrasco","Cno. Maldonado","Col&oacute;n","Cord&oacute;n","Goes","Golf","Ituzaing&oacute;",
        "Jacinto Vera","Jardines Hip&oacute;dromo","La Blanqueada","La Colorada","La Comercial","La Figurita","La Teja","Las Acacias","Lezica","Malvin",
	"Malvin Norte","Manga","Marconi","Maro&ntilde;as","Maro&ntilde;as, Curva","Melilla","Montevideo","Nuevo Par&iacute;s","Otras","Pajas Blancas","Palermo","Parque Batlle",
        "Parque Rod&oacute;","Paso Molino","Paso de la Arena","Pe&ntilde;arol","Piedras Blancas","Pocitos","Pocitos Nuevo","Prado","Puerto Buceo","Punta Carretas","Punta Gorda",
        "Punta Rieles","Reducto","Santiago V&aacutezquez","Sayago","Toledo Chico","Tres Cruces","Uni&oacute;n","Villa Biarritz","Villa Col&oacute;n","Villa Dolores","Villa Espa&ntilde;ola",
	"Villa Garc&iacute;a","Villa Mu&ntilde;oz","Villa del Cerro","Larra&ntilde;aga","Barrio Sur","Barros Blancos","Conciliaci&oacute;n","Paso de las Duranas","Las Canteras",
        "Playa Pascual","Libertad","Casavalle"],
                     'Paysandú':['','Paysandú','Nuevo Paysand&uacute;','Guich&oacute;n','Chacras de Paysand&uacute;','Quebracho','San F&eacute;lix','Porvenir','Tambores','Piedras Coloradas'],
                     'Río Negro':['','Fray Bentos','Young','Nuevo Berl&iacute;n','San Javier','Nuevo Berl&iacute;n','San Javier'],
                     'Rivera':['','Rivera','Tranqueras','Minas de Corrales','Vichadero'],
                     'Rocha':['','Rocha','Chuy','Lascano','Castillos','La Paloma','Cebollat&iacute;','La Aguada-Costa Azul','Vel&aacute;zquez','Punta del Diablo',
        'Aguas Dulces','Barra del Chuy','Barra de Valizas','Arachania','Cabo Polonio'],
                     'Salto':['','Salto','Constituci&oacute;n','Bel&eacute;n'],
                     'San José':['','San José de Mayo','Ciudad del Plata','Libertad','Rodr&iacute;guez','Ecilda Paullier','Puntas de Valdez','Rafael Perazza'],
                     'Soriano':['','Mercedes','Dolores','Cardona','Palmitas','Jos&eacute; Enrique Rod&oacute;','Chacras de Dolores','Villa Soriano'],
                     'Tacuarembó':['','Tacuarembó','Paso de los Toros','San Gregorio de Polanco','Villa Ansina','Tambores','Las Toscas','Curtina'],
                     'Treinta y Tres':['','Treinta y Tres','Vergara','Santa Clara de Olimar','Cerro Chato','Villa Sara','General Enrique Mart&iacute;nez']
                 };




var Publicar = {
    group:'',/* mascota,producto,anuncio */
    producto:{'perro':["accesorios","transporte","alimentos","camas","casillas","collarez","comederos","correas","jaulas","juguetes","ropa"],
                'gato':["accesorios","transporte","alimentos","camas","casillas","collarez","comederos","juguetes"],
                'ave':["accesorios","alimentos","jaulas","salud"],
                'repitl':["accesorios","alimentos","salud","terrarios","transporte"],
                'mamifero':["accesorios","alimentos","jaulas","juguetes","salud","transporte"],
                'pez':["accesorios","alimentos","parideras","peceras","salud"]},
    departamento:departamentos,
    
    loadDescription: function(cur,x){
        $.ajax({
            url:'/publicar/description',
            type:'post',
            data:{animal:Publicar.animal,tab:Publicar.tab},
            success:function(response){
                cur.next().html(response);
                Publicar.sliderHeight(cur,x);
            }
        });
    },
    cur_pos:0,
    
    
    slideRight: function(next_pos,forward_move){
        
        if(!forward_move && this.cur_pos < next_pos){
            return;
        }
        this.cur_pos=next_pos;
        
        var next_box = $($('.slides:eq('+(next_pos)+')'));
        
        //var next_box = cur_box.next();
        $('.slides').css('position','absolute');  
        $('.slides').css({left:'-1000px'});
        next_box.css({position:'relative',left:0});
        
        if(this.group=='producto'){
            $('.tienda').hide();
            $('.'+Publicar.animal).show();
        }
        
        
        
        
        
        if(this.group=='anuncio' && this.type=='paseador'){
            $('.direccion').hide();
        }
        if(this.group=='anuncio' && this.type!='evento'){
            $('.item_fecha').hide();
        }
        
        $('.step').attr('class','step');
        $('.step:eq('+(next_pos)+')').addClass('highlight');
        $('.publicar_header_arrow').removeClass('highlight_pink');
        
        
        
        //Skip for otros
        if(this.group=='producto' && Publicar.animal=='articulo' && next_pos==1){
            Publicar.tab='otro';
            Publicar.slideRight(2,true);
        }
        
        //$('.publicar_header_arrow:eq('+(next_pos-1)+')').addClass('highlight_pink');
        $('.tab_option').show();
        if(next_box.has('tab')){
            if(Publicar.animal=="ave" ||Publicar.animal=="reptil" ||Publicar.animal=="pez"){
                $('.tab_perdido').hide();
                $('.tab_encontrado').hide();
            }
            if(Publicar.animal=="pez"){
                $('.tab_adoptar').hide();
            }
            //alert(Publicar.animal);
        }
        
        
        if(next_box.hasClass('description')){
            $.ajax({
                url:'/publicar/description',
                type:'post',
                data:{animal:Publicar.animal,tab:Publicar.tab},
                success:function(response){
                    next_box.html(response);
                }
            });
        }
        
        
        /*
        var cur = $(elem).closest('.slides');
        
        if(typeof Publicar.animal==='undefined'){
            return;
        }
        
        
        
        
        $('.step').attr('class','step');
        $('.step:eq('+(x/-1000)+')').addClass('highlight');
        $('.publicar_header_arrow').removeClass('highlight_pink');
        $('.publicar_header_arrow:eq('+(x/-1000-1)+')').addClass('highlight_pink');
        
        if(cur.next().hasClass('description')){
            this.loadDescription(cur,x);
        }else if(cur.next().hasClass('tab')){
            
            if(Publicar.animal=='pez'){
                $('.tab_option').hide();
                $('.tab_comprar').show();
            }
            if(Publicar.animal=='ave'){
                $('.tab_perdido').hide();
                $('.tab_encontrado').hide();
            }
            if(Publicar.animal=='reptil'){
                $('.tab_perdido').hide();
                $('.tab_encontrado').hide();
            }
            
            
            this.sliderHeight(cur,x);
        }else{
            
            this.sliderHeight(cur,x);
        }
        */
        
    },
    
    sliderHeight: function(cur,x){
        var cur_h = cur.height();
        var next_h = cur.next().height();
        $('.slides').css('position','absolute');  
        cur.next().css({position:'relative',height:cur_h-12});
        $('#publicar_slider').animate({left:x},function(){
            $('.publicar').animate({'height':next_h+40});
        });
    },
    
    
    
    addslashes: function(string) {
        return string.replace(/\\/g, '\\\\').
            replace(/\u0008/g, '\\b').
            replace(/\t/g, '\\t').
            replace(/\n/g, '\\n').
            replace(/\f/g, '\\f').
            replace(/\r/g, '\\r').
            replace(/'/g, '\\\'').
            replace(/"/g, '\\\\"');
    },
    
    
    submit: function(elem,test){
        
        $('.input_error').html('');
        //Do not use niceedit plugin
        //var nicE = new nicEditors.findEditor('nicedit_text');
        //var description = nicE.getContent();
        var description='';
        if($('.mce-tinymce').length>0){
            
            
            
            //var nicE = new nicEditors.findEditor('nicedit_text');
            description = tinymce.activeEditor.getContent({format : 'raw'});
        }else{
            description = $('#nicedit_text').val();
        }
        
        
        var form =$('#form_description');
        var submit_ok = true;
        
        form.append('<input type="hidden" name="tipo" value="'+Publicar.type+'"/>');
        form.append('<input type="hidden" name="tab" value="'+Publicar.tab+'"/>');
        form.append('<input type="hidden" name="sub_tab" value="'+Publicar.sub_tab+'"/>');
        if(Publicar.group=='producto'){
            form.append('<input type="hidden" name="animal" value="'+Publicar.animal+'"/>');
        }
        
        var form_var = form.serializeArray();
        $('.publicar_sub_item').removeClass('missing_input');
        
        var submit_var = {};
        var blank_found = false;
        
        // Check all radio buttons are filled
        var radio_buttons = ['tamano','edad','sexo'];
        for(var i in radio_buttons){
            var r = radio_buttons[i];
            if($('input[name="'+r+'"]').size()>0){
                if($('input[name="'+r+'"]:checked').size()===0){
                    $('input[name="'+r+'"]').closest('.publicar_sub_item').addClass('missing_input');
                    blank_found = true;
                }
            }
        }
        for(var i in form_var){
            
            var key = form_var[i].name;
            var obj = {};
            if(form_var[i].value=="" && key!= 'vendedor_id' && key!='ciudad_barrio' && key!='horario' && key!='direccion' && key!='fecha' && key!='fecha_datepicker'){
                $('input[name="'+key+'"').closest('.publicar_sub_item').addClass('missing_input');
                $('select[name="'+key+'"').closest('.publicar_sub_item').addClass('missing_input');
                blank_found = true;
            }
            
            submit_var[key]=form_var[i].value;
        }
        // Check description
        /*
        if(description=='<br>' || description==''){
            $('#nicedit_text').closest('.publicar_item').addClass('missing_input');
            blank_found=true;
        }
        */
        if(blank_found===true){
            $('.publication_error').show();
            return;
        }
        
        $('.publication_error').hide();
        
        submit_var.descripcion=description;


        var url = '/publicar/'+test+'/';
        $.ajax({
            url:url,
            type:'POST',
            dataType:'json',
            data:submit_var,
            success:function(response){
                //console.log(response);
                window.location = response.link;
                
                //window.location='/publicar/publicado/?'+response;
            },
            error:function(e){
                console.log(e.responseText);
            }
        });
        
    },
    
    
    
    gotoMascota: function(){
        window.location = '/mascota/'+Publicar.lastinsert;
    }
}




var Carussel = {
    len:'',
    timeout:'',
    init: function(){
        $('.slidprev').on('click',function(){Carussel.slide(0)});
        $('.slidnext').on('click',function(){Carussel.slide(1)});
        this.len = $('#slider > div').length;
        this.width = $('.caroufredsel_wrapper').width();
        this.autoSlide();
    },
    slide: function(dir){
        clearTimeout(this.timeout);
        var cur = parseInt($('#slider').css('left').split('px')[0],10);
        if(dir){
            if(cur<=(this.len-1)*this.width*-1){
                $('#slider').animate({'left':0});
            }
            else{
                $('#slider').animate({'left':cur-Carussel.width});
            }
        }else{
            if(cur==0){
                $('#slider').animate({'left':(this.len-1)*this.width*-1});
            }
            else{
                $('#slider').animate({'left':cur+Carussel.width});
            }
        }
        this.autoSlide();
    },
    autoSlide: function(){
        this.timeout = setTimeout(function(){
            Carussel.slide(1);
        },7000);
    }
}


var Validation = {
    email: function(email) { 
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    } 
}


Filter = {
    toggle: function(){
        if($('.filter_sidebar').is(":visible")){
            $('.toggle_filters button').html('Mostrar filtros');
            $('.filter_sidebar').slideToggle();
        }else{
            $('.toggle_filters button').html('Esconder filtros');
            $('.filter_sidebar').slideToggle();
        }
        console.log($('.toggle_filters').is(":visible"));
    },
    sort:function(sort_by){
        $('form').find('.ordenar_filtro').val(sort_by);
        Filter.submit();
    },
    
    submit: function(page){
        
        if(typeof page!=='undefined'){
            $('form').append('<input type="hidden" value="'+page+'" name="page"/>');
        }
        console.log($('form#filter').html());
        $('form#filter').submit();
        //var tamano = $('input:radio[name=tamano]:checked').val();
        
    },
    unfilter: function(name){
        
        $('input[name='+name+']').each(function(){
            $(this).prop('checked', false);
            $(this).val('');
        });
        if(name=='tab'){
            $('.tab_checkbox').each(function(){
                $(this).prop('checked', false);
                $(this).val('');
            });
        }
        if(name=='departamento'){
            $("select").select2("val", '');
        }
        if(name=='animal_detail'){
            $("select").select2("val", '');
        }
        if(name=='refugio'){
            $("select").select2("val", '');
        }
        $('form#filter').submit();
    }
};




Register = {
    open: function(){
        $('.overlay').show();
        var w = $('body').width();
        var h = $('body').height();
        
        var register_h = $('#register').height();
        var to_h = (h-register_h)/2;
        
        if(h-100<register_h){
            to_h=50;
            $('#register').css({height:h-100});
        }
        
        $('#register').css({top:to_h,left:w/2,display:''});
        $('#register').show();
    },
    
    popup: function(){
        $('.overlay').show();
        var w = $(document).width();
        
        var h = $('body').height();
        
        var register_h = 540;
        var to_h = (h-register_h)/2;
        
        
        if(w>900){
            w=900;
        }
        
        $('#popup_registracion').css({width:w});
        
        if(h-100<register_h){
            to_h=50;
            $('#popup_registracion').css({height:h-100});
        }
        
        $('#popup_registracion').css({top:to_h,left:'50%',display:'',marginLeft:-1*w/2});
        $('#popup_registracion').show();
    }
    
};



Contactar = {
    show: function(contact_id){
        if(Publicar.user_logged_in){
            this.ajax(contact_id);
            $('.overlay').show();
        }else{
            window.location='/account/login/1';
        }
    },
    ajax: function(contact_id){
        var self = this;
        $.ajax({
            url:'/account/contactar/?user_id='+contact_id,
            type:'GET',
            dataType:'JSON',
            success:function(response){
                self.fillInfo(response);
            }
        });
    },
    fillInfo: function(obj){
        $('#empty_box .overlay_box_inner').html('<p>Nombre: '+obj.firstname+' '+obj.lastname+'</p><p>Email: '+obj.email+'</p><p>Telefono: '+obj.telefono);
        $('#empty_box').css({display:'block',left:$('body').width()/2,top:300});
        return;
        $('#contactar').remove();
        var clone = $('#empty_box').clone();
        clone.attr('id','contactar');
        clone.find('.publicar').html('<p>Nombre: '+obj.firstname+' '+obj.lastname+'</p><p>Email: '+obj.email+'</p><p>Telefono: '+obj.telefono);
        clone.css({display:'block',left:$('body').width()/2,top:300});
        $('body').append(clone);
    }
}


UpdateUser = {
    selectField: function(elem,column){
        $('.overlay').show();
        var box = $('#empty_box');
        var w = $('body').width();
        var h = $('body').height();
        var register_h = box.height();
        var to_h = (h-register_h)/2;
        
        if(h<register_h){
            to_h=0;
            box.css({height:h});
        }
        box.css({top:to_h-100,left:w/2,display:''});
        box.show();
        var box_content = box.find('.overlay_box_inner');
        box_content.html($('.update_user').html());
        
        var name = $(elem).find('.item_user_align:first').html();
        box_content.find('span:first').html(name);
        box_content.find('input.value').val($(elem).find('.item_user_align:last').html());
        box_content.find('input.column').val(column);
        if(name=='Clave'){
            box_content.find('input.value').val("");
            $('.clave').show();
        }else{
            $('.clave').hide();
        }
        box_content.show();
//<p style="font-size:16px;padding-bottom:20px;">Modificar</p><span>'+$(elem).find('.item_user_align:first').html()+'</span>&nbsp;<input name="'+column+'" type="text" value="'+$(elem).find('.item_user_align:last').html()+'">&nbsp;<button class="button">Guardar</button>');
    }
}









$(function($){
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
});