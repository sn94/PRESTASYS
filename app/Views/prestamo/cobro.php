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
  <span style="font-style: italic;color:#680702;">(<?= Utilidades::number_f( $monto->MONTO )?> &nbsp;GS.)
  <?= $monto->CUOTA." X ".$monto->NRO_CUOTAS ?>
</span>
</h2>
<div class="clearfix"></div>
</div>


<!-- INI FORM -->
<?php 
echo form_open("prestamo/cobro", ['id'=> "cobro-form", 'onsubmit'=>'guardarCobro(event)' ])
?>
 <!-- *********************CABECERA COBRO *****************-->
 <!-- ID DE PRESTAMO --> 
 <input type="hidden" name="CABECERA[IDPRESTAMO]" value="<?=$prestamo_dato->IDNRO?>">
 <!-- FECHA --> 
 <input type="hidden" name="CABECERA[FECHA]" value="<?= date("Y-m-j")?>">
  <!-- CAJERO --> 
  <input type="hidden" name="CABECERA[CAJERO]" value="<?=session("ID")?>">
 <!-- ID DE DEUDOR --> 
<input type="hidden" name="CABECERA[DEUDOR]" value="<?=$deudor->IDNRO?>">
 <!-- CAJA --> 
 <input type="hidden" name="CABECERA[CAJA]" value="<?=session("APECAJA")?>">

<!-- ESTADO COBRO POR DEFECTO "A" --> 
<input type="hidden" name="CABECERA[ESTADO]" value="A">
 <!-- *********************CABECERA COBRO *****************-->


 <!-- *********************DATOS ACERCA DEL MONTO TOTAL PRESTADO *****************-->
 <input id="cate-monto"     type="hidden"     value="<?= Utilidades::number_f( $monto->MONTO )?>" >
 <input  id="cate-formato"   type="hidden" value="<?=!isset($monto) ? "" :  $monto->FORMATO?>"> 
 <input  id="cate-nro-cuo"   type="hidden"  value="<?= $monto->NRO_CUOTAS?>" >
 <input  id="cate-cuotas"  type="hidden"   value="<?= $monto->CUOTA?>" >
 
 

 <div class="row">

  <div class="col-xs-12 col-md-3">
    
      <div class="form-group"><label >TOTAL MARCADAS</label>
        <input readonly style="font-size: 12pt; color: blue;background-color: #f1f464;" class="form-control" type="text" id="TOTALCOBRO" value="0">
      </div> 
 
      <div class="form-group"><label >TOTAL IMPORTE</label>
        <input readonly style="font-size: 12pt; color: blue;background-color: #f1f464;" class="form-control" type="text" id="TOTALIMPORTE" value="0">
      </div> 
    
  </div>

  <div class="col-xs-12 col-md-9">

        <!-- *********************MODALIDADES DE COBRO VARIAS*****************-->
        <!-- *********************EFECTIVO*****************-->

        <div class="row">
            <div class="col-md-3">
            <div class="form-group"><label >IMPORTE EFECTIVO:</label>
            <input id="EFECTIVO" oninput="totalizar_importe(event)" maxlength="10" style="font-size: 12pt; color: blue;" class="form-control numero" type="text" name="CABECERA[EFECTIVO_T]" value="0">
            </div>
          <div class="form-group"><label >SALDO:</label> 
          <input readonly style="font-size: 12pt; color: blue;" class="form-control" type="text" id="SALDO" value="0">   </div>
         
            </div>
            
          <!-- *********************CHEQUE*****************-->
         

        <div class="col-md-3"> <div class="form-group"><label >IMPORTE CHEQUE:</label>
          <input id="CHEQUE" oninput="totalizar_importe(event)" maxlength="10" style="font-size: 12pt; color: blue;" class="form-control numero" type="text" name="CABECERA[CHEQUE_IMPO]" value="0">
        </div>
        <div class="form-group"><label >BANCO EMISOR DE CHEQUE:</label> 
          <input maxlength="30" style="font-size: 12pt; color: blue;" class="form-control" type="text" name="CABECERA[CHEQUE_BANC]" value=""> </div>
        
          <div class="form-group"><label >NÚMERO CHEQUE:</label>
          <input maxlength="20" style="font-size: 12pt; color: blue;" class="form-control" type="text" id="CABECERA[[CHEQUE_NRO]" value="0">
        </div></div>

    <!--TARJETA --> 
        <div class="col-md-3">
             <div class="form-group"><label >IMPORTE TARJETA:</label>
          <input id="TARJETA" oninput="totalizar_importe(event)" maxlength="10" style="font-size: 12pt; color: blue;" class="form-control numero" type="text" name="CABECERA[TARJE_IMPO]" value="0">
        </div>
        
            <div class="form-group"><label >TIPO TARJETA:</label>
              <div class="radio">
            <label><input type="radio" name="CABECERA[TARJE_TIPO]" value="C">Crédito</label>
            </div>
            <div class="radio">
            <label><input type="radio" name="CABECERA[TARJE_TIPO]" value="D">Débito</label>
            </div>
            </div>
            
        <div class="form-group"><label >N° Voucher:</label>
          <input maxlength="20" style="font-size: 12pt; color: blue;" class="form-control" type="text" name="CABECERA[TARJE_VOUCH]" value="0">
        </div></div>


        </div><!--End row-->

          
</div>

 </div><!--End master row-->





 
  




<table  id="cuotas" class="table table-hover">
    <thead> <tr>  <th>#</th>  <th>MONTO</th>  <th>VENCIMIENTO</th><th>SALDO</th>  <th>COBRAR</th> </tr>
    </thead>
    <tbody>
    <?php  
    $NRO_CUOTA= 1;
    foreach( $cuotas as $cuo): ?>     
      
      <tr   >  
      <td><?=$NRO_CUOTA?></td> 
       <td><?= Utilidades::number_f( $cuo->MONTO )?></td>  
       <td><?= Utilidades::fecha_f( $cuo->VENCIMIENTO )?></td> 
       <td><?= Utilidades::number_f( $cuo->SALDO ) ?> </td>
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



function totalizar_importe(ev){


  let efec= quitarSeparador( document.getElementById("EFECTIVO").value );
  let chequ= quitarSeparador( document.getElementById("CHEQUE").value );
  let tarj= quitarSeparador( document.getElementById("TARJETA").value  );
  let tot=  parseInt( efec ) + parseInt(chequ) + parseInt(tarj);
 
 $("#TOTALIMPORTE").val(  tot );
 input_number_millares(ev);
}


function totalizar(ev){

  let total= 0; 

  let checks= document.querySelectorAll("#cuotas input[type=checkbox]");
  let checks_marcados= Array.prototype.filter.call(   checks, function(ele){
    return ele.checked;
  }  );
   
  Array.prototype.forEach.call(  checks_marcados, function(elemento, indice){

    //sumar el Saldo de cada cuota
    let fila= elemento.parentNode.parentNode;
    let colSaldo= fila.children[3].firstChild;
    let Saldo=  quitarSeparador( colSaldo.textContent );
 

 //total+=  parseInt( quitarSeparador( $("#cate-cuotas").val())  );// REFERENCIA EL TOTAL DE LA CUOTA
 total+= parseInt( Saldo);//REFERENCIA EL SALDO DE LA CUOTA
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
        if( elemento.value == IDCUOTA ) { POSICION_ACTUAL=  indice;    }
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


 

 
async function guardarCobro(ev, permitir ){

ev.preventDefault(); 
if(permitir==undefined)  permitir= false;
console.log( $(ev.target).serializeArray() );
//Limpiar campos
let numeros= document.querySelectorAll(".numero");
Array.prototype.forEach.call( numeros, function(ar){
quitarSeparador(   ar  );
});

//if( permitir )

$.ajax({
url:  ev.target.action, 
data:   $(ev.target).serialize(), 
method: "post", 
success: function(res){  
    try{
      let respuesta= JSON.parse( res );
      if( "print" in respuesta)
      printBill(  respuesta.print);
    }catch(e){  }

 }
});
//ev.target.submit( );
 
}



async function printBill( ID_RECIBO){

let urlBill= "<?=base_url('prestamo/mostrarRecibo')?>/"+ID_RECIBO;
 
$.ajax({
  url: urlBill,
  success: function(html){
  //print
  let documentTitle="PAGOS" ;
var ventana = window.open( "", 'PRINT', 'height=400,width=600');
ventana.document.write( html ); 
  ventana.document.close(); 
  ventana.focus();
  ventana.print();
  ventana.close();
  }
})
}
 

 




 
</script>





<?= $this->endSection() ?>


