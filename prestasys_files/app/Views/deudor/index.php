<?= $this->extend("layouts/index") ?>
<?= $this->section("contenido") ?>

 

<div class="card">
                <div class="card-header card-header-primary"> 
                  <h2 class="text-center prestyle"> DEUDORES<small></small></h2>  
                </div>



<div class="card-body">
<a href="<?= base_url("deudor/create") ?>" class="btn btn-sm btn-primary">NUEVO</a>
<a  onclick="callToXlsGen(event, 'CLIENTES')" href="<?=base_url("deudor/list/json")?>"><img src="<?=base_url("assets/img/excel_icon.png")?>" alt="">XLS</a>
<a  href="<?=base_url("deudor/list/pdf")?>"><img src="<?=base_url("assets/img/pdf_icon.png")?>" alt="">PDF</a>

<div class="table-responsive">

<!-- ********************TABLA ***************** -->
<table id="tabla-funcionarios" class="table table-bordered table-stripped prestyle">
  <thead class="dark-head">
  <tr>
  <th></th><th></th><th></th>
  <th>CI°/RUC</th><th>NOMBRES/RAZÓN SOCIAL</th><th>CIUDAD</th><th>TELÉFONO</th>
  <th>CRÉDITOS</th>  <th>REGISTRADO EL</th></tr>
  </thead>
<tbody>
                       
<?php

                                                        use App\Helpers\Utilidades;

foreach($lista as $i):?>
<tr id="<?=$i->IDNRO?>">

<td><a href="<?= base_url("deudor/get/IDNRO/$i->IDNRO")?>"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
<td><a href="<?= base_url("deudor/edit/$i->IDNRO")?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
<td><a onclick="borrarFila(event)" href="<?= base_url("deudor/delete/$i->IDNRO")?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>

<td><?=$i->CEDULA?></td>
<td><?=$i->NOMBRES?></td>
<td><?=$i->CIUDAD?></td>
<td><?=$i->TELEFONO?></td>
<td><?=$i->CREDITOS?></td>
<td><?=Utilidades::fecha_f( $i->REGISTRO )?></td>
</tr>

<?php  endforeach;?>
                   
</tbody>
</table>
</div>

</div><!-- END CARD BODY  -->



</div>


<script>



function xls(){


}
function pdf(){
  $('#myTable').tableExport(
    { type: 'pdf', pdfFontSize:10,   escape: 'false' });
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
  $("#tabla-funcionarios").DataTable(  {   
          "ordering": false,
          "language": {
            "url": "<?=base_url("assets/Spanish.json")?>"
          }
        }  );


        
};


 
</script>
<?= $this->endSection() ?>


