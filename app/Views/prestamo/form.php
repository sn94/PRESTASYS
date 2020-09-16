<!--CAMPOS OCULTOS --> 

<input type="hidden" name="IDNRO" value="<?= !isset($prestamo_dato) ? "" : $prestamo_dato->IDNRO?>">
<input type="hidden" name="DEUDOR" value="<?= !isset($prestamo_dato) ? "" : $prestamo_dato->DEUDORID?>">
<input type="hidden" name="GARANTE" value="<?= !isset($prestamo_dato) ? "" : $prestamo_dato->GARANTEID?>">
<input type="hidden" name="FUNCIONARIO" >

<div class="row">

  <div class="col-12 col-md-2">
  <div class="form-group">
  <label>CI° TITULAR:</label>
  <input id="CI_TITULAR"  oninput="input_number(event)"     type="text" class="form-control"  value="<?= !isset($prestamo_dato) ? "" :   $prestamo_dato->DEUDORCI?>" >
</div>
  </div>


  <div class="col-12 col-md-4">
      <div class="form-group">
      <label >NOMBRE COMPLETO: </label>
      <input id="TITULAR_NOMBRES" type="text" class="form-control"  value="<?= !isset($prestamo_dato) ? "" :  $prestamo_dato->DEUDORNOM?>"  >
    </div>
  </div>

 
  <div class="col-12 col-md-2">
  <div class="form-group">
  <label>CI° GARANTE:</label>
  <input id="CI_GARANTE"  oninput="input_number(event)"     type="text" class="form-control"  value="<?= !isset($prestamo_dato) ? "" :   $prestamo_dato->GARANTECI?>" >
</div>
  </div>


  <div class="col-12 col-md-4">
      <div class="form-group">
      <label >NOMBRE COMPLETO: </label>
      <input id="GARANTE_NOMBRES" type="text" class="form-control"  value="<?= !isset($prestamo_dato) ? "" :  $prestamo_dato->GARANTENOM?>"  >
    </div>
  </div>
</div><!--END ROW --> 


<div class="row">
    <div class="col-12 col-md-4">

    <div class="form-group">
    <label >CATEGORÍA MONTO:</label> 
      <?= form_dropdown( "CAT_MONTO", $montos, !isset($prestamo_dato) ? "" :  $prestamo_dato->CAT_MONTO,['class'=> "select2_single form-control" ] ) ?>   
    </div>
    </div>

  <div class="col-12 col-md-3">

  <div class="form-group">
      <label >MONTO SOLICITADO:</label>
      <input maxlength="10"  oninput="input_number_millares(event)"  name="MONTO_SOLICI" type="text" class="form-control number-format"  value="<?= !isset($prestamo_dato) ? "" :  $prestamo_dato->MONTO_SOLICI?>"  >
    </div>
</div>


</div><!-- END ROW -->


<?php if( isset($OPERACION) && ($OPERACION=="V" || $OPERACION=="M")  ): ?>
    <div class="row">

      <div class="col-12 col-md-4">
        <div class="form-group">
          <label >FECHA SOLICITUD:</label>
          <input readonly   type="date" class="form-control"  value="<?= !isset($prestamo_dato) ? "" :  $prestamo_dato->FECHA_SOLICI?>"  >
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="form-group">
          <label >FECHA ENTREGA:</label>
          <input    <?= $OPERACION=="V" ? "readonly": ($prestamo_dato->ESTADO != "P" ? "readonly" : "") ?>    type="date" class="form-control"  value="<?= !isset($prestamo_dato) ? "" :  $prestamo_dato->FECHA_ENTREGA?>"  >
        </div>
      </div>

    </div><!-- END ROW -->

    <?php endif; ?>

    
    <div class="row">
        <div class="col-12 col-md-5">

        <div class="form-group">
            <label >OBSERVACIÓN:</label>
            <textarea  <?= $OPERACION=="V" ? "readonly": ""?>  name="OBSERVACION" type="text" class="form-control"  value="<?= !isset($prestamo_dato) ? "" :  $prestamo_dato->OBSERVACION?>"  >
            </textarea>
          </div>
        </div>
        
        <?php if( isset($OPERACION)  && $OPERACION!="V" ): ?>
      <div class="col-12 col-md-4">
      <div class="form-group mt-3">
      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
        <button type="submit" class="btn btn-success">GUARDAR</button>
      </div>
    </div> </div>
    <?php  endif;?>

    </div>






 
 
 
 


<script>

window.onload= function(){
autocompletado( "#CIUDAD");
  };








</script>
