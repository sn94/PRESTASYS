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
 <input id="cate-monto"     type="hidden"     value="<?= Utilidades::number_f( $monto->MONTO )?>" >
 <input  id="cate-formato"   type="hidden" value="<?=!isset($monto) ? "" :  $monto->FORMATO?>"> 
 <input  id="cate-nro-cuo"   type="hidden"  value="<?= $monto->NRO_CUOTAS?>" >
 <input  id="cate-cuotas"  type="hidden"   value="<?= $monto->CUOTA?>" >
 
 
<div class="row">
  <div class="col-md-3"> <div class="form-group"><label >CATEGORÍA MONTO:</label> <?= form_dropdown( "", $montos, !isset($prestamo_dato) ? "" :  $prestamo_dato->CAT_MONTO,['class'=> "select2_single form-control", "disabled"=>"true" ] ) ?>   </div></div>
  <div class="col-md-3"> <div class="form-group"><label >TOTAL A COBRAR</label>
  <input style="font-size: 12pt; color: blue;" class="form-control" type="text" id="TOTALCOBRO" value="0">
</div></div>

</div><!--End row-->


 
  

 <!-- *********************MODALIDADES DE COBRO VARIAS*****************-->
 <!-- *********************EFECTIVO*****************-->

  <!-- *********************CHEQUE*****************-->
  <div class="row">
  <div class="col-md-3"> <div class="form-group"><label >BANCO EMISOR DE CHEQUE:</label> 
  <input maxlength="30" style="font-size: 12pt; color: blue;" class="form-control" type="text" id="BANCO" value=""> </div></div>
  
  <div class="col-md-3"> <div class="form-group"><label >NÚMERO CHEQUE:</label>
  <input maxlength="30" style="font-size: 12pt; color: blue;" class="form-control" type="text" id="NRO_CHEQUE" value="0">
</div></div>

<div class="col-md-3"> <div class="form-group"><label >IMPORTE:</label>
  <input oninput="input_number_millares(event)" maxlength="10" style="font-size: 12pt; color: blue;" class="form-control" type="text" id="IMPORTE" value="0">
</div></div>

</div><!--End row-->

   <!-- *********************TARJETA*****************-->
   <div class="row">
  <div class="col-md-3"> <div class="form-group"><label >BANCO EMISOR TARJETA:</label> 
  <input maxlength="30" style="font-size: 12pt; color: blue;" class="form-control" type="text" id="BANCO" value=""> </div></div>
  
  <div class="col-md-3"> <div class="form-group"><label >TIPO TARJETA:</label>
  <input maxlength="30" style="font-size: 12pt; color: blue;" class="form-control" type="text" id="NRO_CHEQUE" value="0">
</div></div>

<div class="col-md-3"> <div class="form-group"><label >MARCA:</label>
  <input maxlength="30" style="font-size: 12pt; color: blue;" class="form-control" type="text" id="NRO_CHEQUE" value="0">
</div></div>
<div class="col-md-3"> <div class="form-group"><label >IMPORTE:</label>
  <input oninput="input_number_millares(event)" maxlength="10" style="font-size: 12pt; color: blue;" class="form-control" type="text" id="IMPORTE" value="0">
</div></div>

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
        <input style=" margin: 0px;width: 25px;height: 25px; transform: scale(2);" class="form-control" onchange="marcacion(event)" name="ESTADO[]" type="checkbox" value="<?=$cuo->IDNRO?>" >
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


function totalizar(ev){

  let total= 0; 

  let checks= document.querySelectorAll("#cuotas input[type=checkbox]");
  let checks_marcados= Array.prototype.filter.call(   checks, function(ele){
    return ele.checked;
  }  );
   
  Array.prototype.forEach.call(  checks_marcados, function(elemento, indice){
 total+=  parseInt( quitarSeparador( $("#cate-cuotas").val())  );
   });
    
  $("#TOTALCOBRO").val( numero_con_puntuacion( total)   );
}

function marcacion(ev){
  let IDCUOTA=ev.currentTarget.value;
  let POSICION_ACTUAL= -1;

  if( ev.currentTarget.checked)//MARCADO
   { 

    //MARCAR LOS CHECKBOX SUPERIORES
    let checks= document.querySelectorAll("#cuotas input[type=checkbox]");
    Array.prototype.forEach.call(   checks, function(elemento, indice){
        if( elemento.value == IDCUOTA ) { POSICION_ACTUAL=  indice;   console.log( "POSIC",  POSICION_ACTUAL); }
        if( POSICION_ACTUAL == -1){   elemento.checked= true;     }
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
    totalizar(ev);
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


 

 


 
</script>





<?= $this->endSection() ?>


