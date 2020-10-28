

<div class="row">

  <div class="col-12 col-md-4">

  <div class="form-group">
  <label>CEDULA:</label>
  <input maxlength="8"   oninput="input_number(event)"  name="CEDULA" type="text" class="form-control"  value="<?= !isset($deudor_dato) ? "" :   $deudor_dato->CEDULA?>" >
</div>

<div class="form-group">
  <label >NOMBRES: </label>
  <input maxlength="50" name="NOMBRES" type="text" class="form-control"  value="<?= !isset($deudor_dato) ? "" :  $deudor_dato->NOMBRES?>"  >
</div>

<div class="form-group">
  <label >APELLIDOS:</label>
  <input maxlength="50" name="APELLIDOS" type="text" class="form-control"  value="<?= !isset($deudor_dato) ? "" :  $deudor_dato->APELLIDOS?>"  >
</div>

<div class="form-group">
  <label >FECHA DE NAC.:</label>
    <input  name="FECHA_NAC" type="date" class="form-control"   value="<?= !isset($deudor_dato) ? "" :  $deudor_dato->FECHA_NAC?>">
</div>


<div class="form-group">
  <label >DOMICILIO:  </label>
  <input  oninput="validarSpecialChars(event)" maxlength="60" name="DOMICILIO" type="text" class="form-control"  value='<?= !isset($deudor_dato) ? "" :  $deudor_dato->DOMICILIO?>'   >
</div>
<div class="form-group">
  <label >TELÉFONO </label> 
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
      
  <div class="form-group">
  <label >DOMICILIO LABORAL:</label>
  <input  oninput="validarSpecialChars(event)" maxlength="50"  name="DOMICILIO_LABO" type="text" class="form-control"   value='<?= !isset($deudor_dato) ? "" :  $deudor_dato->CELULAR?>'>
  </div>
 
<div class="form-group">
  <label >TELÉFONO LABORAL:</label>
  <input maxlength="16"  name="TELEFONO_LABO" type="text" class="form-control"   value="<?= !isset($deudor_dato) ? "" :  $deudor_dato->CELULAR?>">
  </div>
  <div class="form-group">
  <label >CELULAR</label>
  <input maxlength="16"  name="CELULAR" type="text" class="form-control"   value="<?= !isset($deudor_dato) ? "" :  $deudor_dato->CELULAR?>">
  </div>

  </div><!--END COLUMN-->


  <div class="col-12 col-md-4"> 

<div class="form-group">
  <label >CI° CÓNYUGE:</label>
  <input oninput="input_number(event)"   maxlength="8"  name="CEDULA_CONYU" type="text" class="form-control"   value="<?= !isset($deudor_dato) ? "" :  $deudor_dato->CEDULA_CONYU?>">
  </div>
 
<div class="form-group">
  <label >NOMBRE DE CÓNYUGE:</label>
  <input maxlength="50"  name="CONYUGE" type="text" class="form-control"   value="<?= !isset($deudor_dato) ? "" :  $deudor_dato->CONYUGE?>">
  </div>
 


<div class="form-group">
      <label >CEDULA ANVERSO: </label>
      <input  onchange="show_loaded_image(event)"  name="CEDU_ANVERSO" type="file" class="form-control"  >
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 "  id="CEDU_ANVERSO">
    <img   style="width: 100%;" src="<?= !isset($deudor_dato) ? "" :  $deudor_dato->CEDU_ANVERSO?>" alt="">
   
  </div>
    </div>

 
 

  <div class="form-group">
      <label >CEDULA REVERSO: </label>
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

