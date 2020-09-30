 
 
<div class="container p-2">
<h2 class="text-center"> APERTURA DE CAJA <small></small></h2>
<div class="clearfix"></div>
</div>


<!-- INI FORM -->

<?php 
echo form_open("apeciecaja/apertura", ['id'=> "apertura-form" , 'style'=>'padding: 5px;'])
?>
 
<input type="hidden" name="CAJERO" value="<?=session("ID")?>">
<input type="hidden" name="APERTURA" value="<?=date("Y-m-d H:i:s")?>">



  
<div class="row">

  <div class="col-md-12">
    <div class="form-group  ">
        <label for="ex3">CAJERO:</label>
        <input name="CAJERO" readonly type="text" id="ex3" class="form-control" value="<?= session("NICK")?>">
      </div>
  </div>

    <div class="col-md-12">
    <div class="form-group">
      <label for="ex3">SALDO INICIAL:</label>
      <input name="SALDO_INI" oninput="input_number_millares(event)"   type="text" id="ex3" class="form-control" value="0">
      </div> 
    </div>
 
    <div class="col-md-12"  >
  <button type="submit" class="btn btn-danger">ABRIR</button>
  </div>


</div>
  
</form>

<script>
  function  aprobar(ev){
    ev.preventDefault(); 
    guardar(ev); 
  }
 
</script>
