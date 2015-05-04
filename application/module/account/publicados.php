<?php
?>
<div class="main-content_container">
    <div class="account">
    <ul>
        
    <?php 
        foreach($publicados as $key=>$table){
            $counter=0;
        foreach($table as $row){
            if(strcmp($row->status,$_GET['status'])!==0){
                continue;
            }
            $counter++;
            if($counter==1){
                echo '<h3 style="padding-top:10px;">'.ucfirst($key).'s</h3>';
            }
    ?>
        <li style="position:relative;padding-bottom:5px;">
            <div style="width:100px;height:100px" class="thumb">
                <a title="<?php echo $row->titulo;?>" href="/<?php echo $key;?>/<?php echo $row->id;?>">
                    <img alt="<?php echo $row->nombre_original;?>" src="<?php echo MEDIA.'upload/'.$row->usuario.'/thumb_'.$row->foto_name; ?>" style="width:100%;height:100%;" >
                </a>
            </div>
            <div style="margin:10px;display:inline-block;position:absolute;top:0px;font-size:15px;">
                <span><?php echo $row->titulo;?></span><br/>
                <span style="font-size:12px;">$<?php echo $row->precio;?></span>
            </div>
            <div style="position:absolute;right:0px;top:0px;">
                <!--<button style="margin-left:10px;height:25px;"><i class="icon-wrench"></i></button>-->
                
                <form style="display:inline;" method="POST" action="/publicar/modify/">
                   <input type="hidden" name="id" value="<?php echo $row->id;?>"/>
                   <input type="hidden" name="table" value="<?php echo $key;?>"/>
                   <select name="event" style="width:100px;">
                        <option></option>
                        <option value="activo">Activar</option>
                        <option value="pausado">Pausar</option>
                        <option value="finalizado">Finalizar</option>
                        <option value="editar">Editar</option>
                        <option value="borrar">Borrar</option>
                    </select>
                </form>
            </div>
        </li>
        <?php }
        }
        ?>
    </ul>
    </div>
</div>
<style>
    li + h3{
        border-top:1px solid lightgrey;
        margin-top:30px;
    }
</style>
<script>
    $('select').select2({
        minimumResultsForSearch: -1,
        placeholder:'Opciones',
        onChange:function(){
            alert('here');
        }
    });
    $('select').on('change',function(){$(this).closest('form').submit()});
</script>