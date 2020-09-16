<?php

use App\Helpers\Utilidades;
?>
<?= $this->extend("layouts/index") ?>

<?= $this->section("contenido") ?>





<style>
  tr{ margin: 0px}
  td{
    padding-bottom:  0px !important;
    margin-bottom: 2px !important;
    font-weight: 600;
    color:#1d1d1d;
    font-size: 18px;
  }
  th{ font-size: 18px;}
</style>




<a class="btn btn-sm btn-primary" href="<?= base_url("prestamo/index")?>">
<i class="fa fa-user" aria-hidden="true"></i> &nbsp;  LISTA DE COBROS</a>


<div class="container p-2">
<h2 class="text-center">COBROS: &nbsp;
  <span style="font-style: italic;"><?= $deudor->NOMBRES." ".$deudor->APELLIDOS ?></span>
  <span style="font-style: italic;color:#680702;">(<?= Utilidades::number_f( $monto->MONTO )?> &nbsp;GS.)</span>
</h2>
<div class="clearfix"></div>
</div>


<!-- INI FORM -->
<?php 
echo form_open("prestamo/cobro", ['id'=> "cobro-form" ])
?>
 <!-- *********************CABECERA COBRO *****************-->
 <!-- ID DE PRESTAMO --> 
 <input type="hidden" name="CABECERA[IDPRESTAMO]" value="<?=$prestamo_dato->IDNRO?>">
 <!-- FECHA --> 
 <input type="hidden" name="CABECERA[FECHA]" value="<?= date("Y-m-j")?>">
  <!-- CAJERO --> 
  <input type="hidden" name="CABECERA[CAJERO]" value="">
 <!-- ID DE DEUDOR --> 
<input type="hidden" name="CABECERA[DEUDOR]" value="<?=$deudor->IDNRO?>">
 <!-- CAJA --> 
 <input type="hidden" name="CABECERA[CAJA]" value="">
  <!-- TOTAL EFECTIVO --> 
  <input type="hidden" name="CABECERA[EFECTIVO_T]" value="0">
   <!-- TOTAL CHEQUE --> 
   <input type="hidden" name="CABECERA[CHEQUE_T]" value="0">
<!-- TOTAL TARJETA --> 
<input type="hidden" name="CABECERA[TARJETA_T]" value="0">
<!-- ESTADO COBRO POR DEFECTO "A" --> 
<input type="hidden" name="CABECERA[ESTADO]" value="A">
 <!-- *********************CABECERA COBRO *****************-->


 <!-- *********************DATOS ACERCA DEL MONTO TOTAL PRESTADO *****************-->
<div class="row">
  <div class="col-md-3"> <div class="form-group"><label >CATEGORÍA MONTO:</label> <?= form_dropdown( "", $montos, !isset($prestamo_dato) ? "" :  $prestamo_dato->CAT_MONTO,['class'=> "select2_single form-control" ] ) ?>   </div></div>
  <div class="col-md-2"><div class="form-group"><label for="ex4">MONTO:</label><input id="cate-monto"  readonly type="text" id="ex4" class="form-control"  value="<?= Utilidades::number_f( $monto->MONTO )?>" ></div></div>
  <div class="col-md-2"><div class="form-group"><label>FORMATO:</label><?= form_dropdown( "", ["D"=>"DIARIO", "S"=>"SEMANAL", "Q"=>"QUINCENAL","M"=>"MENSUAL"], !isset($monto) ? "" :  $monto->FORMATO,[ 'id'=>'cate-formato', 'class'=> "select2_single form-control"  ] ) ?>   </div></div>
  <div class="col-md-1"><div class="form-group"><label for="ex4">NRO.CUOTAS:</label><input  id="cate-nro-cuo"  readonly type="text" id="ex4" class="form-control"  value="<?= $monto->NRO_CUOTAS?>" ></div></div>
  <div  class="col-md-2"> <div class="form-group"><label for="ex4">CUOTA</label><input  id="cate-cuotas" readonly type="text" id="ex4" class="form-control"  value="<?= $monto->CUOTA?>" ></div></div>
</div><!--End row-->

 
  
<table  id="cuotas" class="table table-hover">
    <thead> <tr>  <th>#</th>  <th>MONTO</th>  <th>VENCIMIENTO</th>  <th>COBRAR</th> </tr>
    </thead>
    <tbody>
    <?php  
    $NRO_CUOTA= 1;
    foreach( $cuotas as $cuo): ?>     
      
      <tr   >  
      <td><?=$NRO_CUOTA?></td> 
       <td><?= Utilidades::number_f( $cuo->MONTO )?></td>  
       <td><?= Utilidades::fecha_f( $cuo->VENCIMIENTO )?></td> 
       <td style="padding: 0px;"> 
        <input style=" margin: 0px;width: 50px;height: 50px; transform: scale(2);" class="form-control" onchange="marcacion(event)" name="ESTADO[]" type="checkbox" value="<?=$cuo->IDNRO?>" >
       </td> 
      </tr>
      
    <?php 
    $NRO_CUOTA++;
   endforeach; ?>                     
    </tbody>
  </table>

<div class="container"><button type="submit" class="btn btn-danger">GUARDAR TODO</button></div>

</form>








<script>



function marcacion(ev){
  let IDCUOTA=ev.currentTarget.value;
  let POSICION_ACTUAL= -1;
  if( ev.currentTarget.checked)
   { 

    //MARCAR LOS CHECKBOX SUPERIORES
    let checks= document.querySelectorAll("#cuotas input[type=checkbox]");
    Array.prototype.forEach.call(   checks, function(elemento, indice){
        if( elemento.value == IDCUOTA )  POSICION_ACTUAL=  indice;
        if( POSICION_ACTUAL == -1){
          elemento.checked= true; 
        }
    });

    }else{//CUANDO DESMARCA 
       
    POSICION_ACTUAL=-1;
    //DESMARCAR LOS CHECKBOX INFERIORES
    let checks= document.querySelectorAll("#cuotas input[type=checkbox]");
        Array.prototype.forEach.call(   checks, function(elemento, indice){
            if( elemento.value == IDCUOTA ){     POSICION_ACTUAL=  indice;        }
            if( POSICION_ACTUAL != -1){    elemento.checked= false;    }
        });
    }
}

  

  function formato_cuotas( key){
    let num=1;
    switch(key){
      case "D": num=1;break;
      case "S": num=7;break;
      case "Q": num=15;break;
      case "M": num=30;break;
    } return num;
  }


  function es_bisiesto(nu) {
    if (parseInt(nu) % 4 == 0) {
        if (parseInt(nu) % 100 == 0) {
            if (parseInt(nu) % 400 == 0) {
                return true;
            } else return false;
        } else { return true; }
    } else return false;
}

 


 
</script>





<?= $this->endSection() ?>


