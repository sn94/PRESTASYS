<?= $this->extend("layouts/index") ?>
<?= $this->section("contenido") ?>

 

<div class="card">
                <div class="card-header card-header-primary"> 
                  <h2 class="text-center prestyle"> Copias de seguridad<small></small></h2>  
                </div>



<div class="card-body">

<p >BACKUP *Copia de Seguridad*</p>
<a href="<?= base_url("backup/db_action/backup") ?>" class="btn btn-sm btn-primary">GENERAR BACKUP</a>
  

</div><!-- END CARD BODY  -->



<div class="table-responsive">

<!-- ******************* CAJA  ***************** -->
<table class="table table-bordered table-stripped prestyle">
  <thead class="dark-head">
  <tr><th>Nombre archivo</th> <th></th><th></th></tr>
  </thead>
<tbody>
                       
<?php  foreach($lista as $i):?>

<tr>
<td><?=$i['archivo']?></td>  <td> <a href="<?=$i['href']?>">Descargar</a></td>
<td><a href="<?= base_url("backup/db_action/restore") ?>"  onclick="restaurar(event)">Restaurar</a>
<input type="hidden"   value="<?=$i['archivo']?>">
</td>
</tr>
<?php  endforeach;?>
                   
</tbody>
</table>
</div>


</div>


<script>

  
 function generarBackup( ev ){
    ev.preventDefault();
    get_custom( ev.currentTarget.href, function( res){
    });
 }

function restaurar(  ev ){
  ev.preventDefault();
  let obje=ev.currentTarget;
  let SETTING= {
        url:   obje.href,
        data: JSON.stringify( { backup_name:   obje.nextSibling.value }),
        method: "POST",
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        beforeSend: function(){ 
            $("#spinner_system").css("display", "block")
       
        },
        success: function(res){  $("#spinner_system").css("display", "none"); success(res);},
        error: function(res){
            $("#spinner_system").css("display", "none") 
            new PNotify({
                                  title: 'ERROR',
                                  text: '',
                                  type: 'danger',
                                  styling: 'bootstrap3'
                              });  
         }
    };
     
    $.ajax(  SETTING)
}
 
</script>
<?= $this->endSection() ?>


