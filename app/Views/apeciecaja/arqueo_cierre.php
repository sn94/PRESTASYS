 
 
<div class="container p-2">
<h2 class="text-center"> ARQUEO Y CIERRE DE CAJA<small></small></h2>
<div class="clearfix"></div>
</div>


<!-- INI FORM -->

<?php 
echo form_open("apeciecaja/cierre", ['id'=> "cierre-form" , 'style'=>'padding: 5px;'])
?>
 
<input type="hidden" name="IDNRO" value="<?=session("APECAJA")?>">
<input type="hidden" name="CIERRE" value="<?=date("Y-m-d H:i:s")?>">



  
<div class="row">

  <div class="col-md-12">
    <div class="form-group  ">
        <label for="ex3">CAJERO:</label>
        <input name="CAJERO" readonly type="text" id="ex3" class="form-control" value="<?= session("NICK")?>">
      </div>
  </div>

    <div class="col-md-12">
    <div class="form-group">
      <label for="ex3">TOTAL EFECTIVO:</label>
      <input name="T_EFECTIVO" oninput="input_number_millares(event)"   type="text" id="ex3" class="form-control" value="0">
      </div> 
    </div>
 
    <div class="col-md-12">
    <div class="form-group">
      <label for="ex3">TOTAL CHEQUE:</label>
      <input name="T_CHEQUE" oninput="input_number_millares(event)"   type="text" id="ex3" class="form-control" value="0">
      </div> 
    </div>

    <div class="col-md-12">
    <div class="form-group">
      <label for="ex3">TOTAL TARJETA:</label>
      <input name="T_TARJETA" oninput="input_number_millares(event)"   type="text" id="ex3" class="form-control" value="0">
      </div> 
    </div>


    <div class="col-md-12"  >
  <button type="submit" class="btn btn-danger">CERRAR CAJA</button>
  </div>


</div>
  
</form>

