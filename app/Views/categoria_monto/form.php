<div class="row">

   
  <label >MONTO:</label>
  <input maxlength="10" oninput="input_number(event)" name="MONTO" type="text" class="form-control"  value="<?= !isset($dato) ? "" :   $dato->MONTO?>" >
  
  <label>NRO DE CUOTAS:</label>   
<input maxlength="10" oninput="input_number(event)" name="NRO_CUOTAS" type="text" class="form-control"  value="<?= !isset($dato) ? "" :   $dato->NRO_CUOTAS?>" >
 
 
  <label>CUOTA:</label>
  <input maxlength="10" oninput="input_number(event)" name="CUOTA" type="text" class="form-control"  value="<?= !isset($dato) ? "" :   $dato->CUOTA?>" >
  
  <label>FORMATO:</label>
  <select name="FORMATO" class="form-control">

    <option value="D">DIARIO</option>
    <option value="S">SEMANAL</option>
    <option value="Q">QUINCENAL</option>
    <option value="M">MENSUAL</option>
  </select>
 


<?php if( !isset($vista)  ): ?>
  
<button type="submit" class="btn btn-primary">GUARDAR</button>
 
<?php  endif;?>

 


</div>

 