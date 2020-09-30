<?= $this->extend("layouts/index") ?>
<?= $this->section("contenido") ?>

 
 
<div class="card">
                <div class="card-header card-header-primary">
                  <h4   class="card-title ">PRÉSTAMOS</h4>
                 <a href="<?= base_url("prestamo/create") ?>" class="btn btn-sm btn-primary">NUEVO</a>
                </div>
<div class="card-body">
         
<div class="table-responsive">

<!-- ********************TABLA ***************** -->
<table id="tabla-funcionarios" class="table table-bordered table-stripped" >
  <thead>
  <tr>  <th></th> <th></th> <th></th> 

  <th> </th> <th></th>   <!--Aprobar  --Rechazar --(Solo si el estado esta Pendiente )-->
  <th>TITULAR</th><th>TOT.CUOTAS</th><th>PAGADAS</th><th>MONTO</th><th>SOLICITUD</th><th>ESTADO</th></tr>
  </thead>
<tbody>
                       
<?php

use App\Helpers\Utilidades;

foreach($lista as $i):?>
  <tr id="<?=$i->IDNRO?>"    class=" <?= $i->ESTADO=="P"  ? "table-secondary" : ( $i->ESTADO=="A" ? "table-success": ($i->ESTADO=="L" ? "table-primary" : "table-danger")  )  ?>"   >


  <td><a href="<?= base_url("prestamo/view/$i->IDNRO")?>"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a></td>
  
  
  <td>
  <?php if( $i->ESTADO != "L" && $i->ESTADO != "R" ): ?>
  <a href="<?= base_url("prestamo/edit/$i->IDNRO")?>"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
<?php endif; ?>
  </td>
  
  
  <td><a onclick="borrarFila(event)" href="<?= base_url("prestamo/delete/$i->IDNRO")?>"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>
 
    <?php if( $i->ESTADO == "P"):?>
      <td><a class="icon-success" href="<?=base_url("prestamo/aprobar/$i->IDNRO")?>"><i class="fa fa-check-circle fa-lg" aria-hidden="true"></i></a></td>
      <td><a  onclick="rechazarSolicitud(event)" class="icon-danger" href="<?=base_url("prestamo/rechazar/$i->IDNRO")?>"><i class="fa fa-ban fa-lg" aria-hidden="true"></i></a></td>
     
      <?php elseif($i->ESTADO == "A"):?>
        <td><a href="<?=base_url("prestamo/cobro/$i->IDNRO")?>"><i class="fa fa-money fa-lg" aria-hidden="true"></i></a></td>
        <td></td>
      <?php else:?>
        <td></td> <td></td>
      <?php endif;?>
   
  <td> <a href="<?=base_url("deudor/edit/$i->DEUDORID")?>"> <?=$i->DEUDOR?></a>  </td>

  <td>  <?=$i->TOTCUOTAS?>  </td>
  <td>  <?=$i->PAGADAS?>  </td>
  <td><?=$i->MONTO_APROBADO?></td>
  <td><?= Utilidades::from_timestamp( $i->FECHA_SOLICI  )?></td>
  <td><?=$i->ESTADO=="P" ? "PENDIENTE" : (  $i->ESTADO=="A" ? "APROBADO" : ( $i->ESTADO=="L" ? "LIQUIDADO" : "RECHAZADO"))  ?></td>
</tr>
<?php  endforeach;?>
                   
</tbody>
</table>
</div>
<!-- END TABLA --> 

</div>
</div>


<script>


function rechazarSolicitud(ev){

ev.preventDefault();
if(  ! confirm("Seguro que desea rechazar esta solicitud?")) return;
$.ajax( { url: ev.currentTarget.href,dataType: "json", success: function(resp){
 
    new PNotify({
                                  title: '',
                                  text: resp.MENSAJE,
                                  type: 'danger',
                                  styling: 'bootstrap3'
                              });  

  window.location= "<?=base_url("prestamo/index")?>";
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

  window.onload= function(){
 
    $("#tabla-funcionarios").DataTable(   {   
          "ordering": false,
          "language": {
            "url": "<?=base_url("assets/Spanish.json")?>"
          }
        }  );
  }


 
</script>
<?= $this->endSection() ?>