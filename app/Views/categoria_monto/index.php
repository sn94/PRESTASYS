<?= $this->extend("layouts/index") ?>
<?= $this->section("contenido") ?>


<div class="card">
<div class="card-header card-header-primary">
<h4 style="color: #130257; font-weight: bold;" class="card-title ">CATEGORÍAS DE MONTO</h4>
                  
</div>

<div class="card-body">
 
 

<!--form --> 
<div id="formView">
<?php  echo view("categoria_monto/create"); ?>
</div>
<!--End form--> 

<div class="table-responsive">

<!-- ******************* CAJA  ***************** -->
<table id="tabla-auxi" class="table table-bordered table-stripped">
  <thead class="dark-head">
  <tr>  <th></th><th></th> <th>MONTO</th><th>NRO CUOTAS</th> <th>CUOTA</th><th>FORMATO</th></tr>
  </thead>
<tbody>
                       
<?php  foreach($lista as $i):?>

<tr id="<?=$i->IDNRO?>">  
<td><a onclick="editarFila(event)" href="<?= base_url("categoria_monto/edit/".$i->IDNRO)?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
<td><a onclick="borrarFila(event)" href="<?= base_url("categoria_monto/delete/".$i->IDNRO)?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
<td> <?= $i->MONTO?></td>
<td> <?= $i->NRO_CUOTAS?></td>
<td> <?= $i->CUOTA?></td>
<td> <?= $i->FORMATO=="D" ? "DIARIO" : ($i->FORMATO=="S" ? "SEMANAL" : ($i->FORMATO=="Q" ? "QUINCENAL" : "MENSUAL")  )   ?></td>
 </tr>

<?php  endforeach;?>
                   
</tbody>
</table>
</div><!--End table responsive --> 

</div>


</div>


<script>


function editarFila(ev){
  ev.preventDefault();
$.ajax( { url: ev.currentTarget.href,  success: function(resp){
 $("#formView").html( resp);
}});
}

 
function borrarFila( ev){

ev.preventDefault();
if( !confirm("BORRAR?")) return;
$.ajax( { url: ev.currentTarget.href,dataType: "json", success: function(resp){
  console.log( typeof resp, resp );
    if( ! ("error" in resp) ) //Ojo los parentesis internos
    $("#"+resp.id).remove();
}});
 
}

   
</script>
<?= $this->endSection() ?>