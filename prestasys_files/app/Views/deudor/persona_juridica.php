

<div class="row">

  <div class="col-12 col-md-4">

  <div class="form-group">
  <label>RUC:</label>
  <input maxlength="13"    name="RUC" type="text" class="form-control"  value="<?= !isset($deudor_dato) ? "" :   $deudor_dato->RUC?>" >
</div>

<div class="form-group">
  <label >RAZÓN SOCIAL: </label>
  <input oninput="validarSpecialChars(event)" maxlength="50" name="NOMBRES" type="text" class="form-control"  value='<?= !isset($deudor_dato) ? "" :   $deudor_dato->NOMBRES ?>'  >

</div>

<div class="form-group">
  <label >DOMICILIO COMERCIAL:  </label>
  <input  oninput="validarSpecialChars(event)" maxlength="60" name="DOMICILIO" type="text" class="form-control"  value='<?= !isset($deudor_dato) ? "" :  $deudor_dato->DOMICILIO?>'   >
</div>
<div class="form-group">
  <label >TELÉFONO: </label> 
    <input maxlength="16" name="TELEFONO" type="text" class="form-control"  value="<?= !isset($deudor_dato) ? "" :  $deudor_dato->TELEFONO?>" >
</div>
 
  </div><!--COLUMNA 1-->


  <div class="col-12 col-md-4">
      <div class="form-group">
      <label >CELULAR</label> 
        <input maxlength="16"  name="CELULAR" type="text" class="form-control"   value="<?= !isset($deudor_dato) ? "" :  $deudor_dato->CELULAR?>">
      </div>


    <div class="form-group">
      <label >CIUDAD:</label>
      <input type="text" maxlength="50" name="CIUDAD"   class="form-control col-md-10 ciudad" autocomplete="off">
      </div>
       

  </div><!--END COLUMN-->


  <div class="col-12 col-md-4"> 
 

<div class="form-group">
      <label >FOTO REFERENCIA 1: </label>
      <input  onchange="show_loaded_image(event)"  name="CEDU_ANVERSO" type="file" class="form-control"  >
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 "  id="CEDU_ANVERSO">
    <img   style="width: 100%;" src="<?= !isset($deudor_dato) ? "" :  $deudor_dato->CEDU_ANVERSO?>" alt="">
   
  </div>
    </div>

 

  <div class="form-group">
      <label >FOTO REFERENCIA 2: </label>
      <input  onchange="show_loaded_image(event)"  name="CEDU_REVERSO" type="file" class="form-control"  >
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 "  id="CEDU_REVERSO">
      <img   style="width: 100%;" src="<?= !isset($deudor_dato) ? "" :  $deudor_dato->CEDU_REVERSO?>" alt="">
    </div>
  </div>

<?php if( isset($OPERACION) && $OPERACION!="V"  ): ?>



  <div class="form-group mt-3">
  <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
    <button type="submit" class="btn btn-success">GUARDAR</button>
  </div>
</div> 
<?php  endif;?>

</div>

</div>

