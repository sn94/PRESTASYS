<?= $this->extend("layouts/index") ?>

<?= $this->section("contenido") ?>


<a class="btn btn-sm btn-primary" href="<?= base_url("deudor/index")?>">
<i class="fa fa-user" aria-hidden="true"></i> &nbsp; LISTADO DE DEUDORES</a>


<div class="container p-2">
<h2 class="text-center">FICHA DE DEUDOR<small></small></h2>
<div class="clearfix"></div>
</div>

<!-- INI FORM -->
<form style="padding-left: 10px;"  id="viewdeudor" enctype="multipart/form-data" class="form-horizontal form-label-left container" method="post" action="/deudor/edit">

<?php echo view('deudor/form'); ?>

</form>
<script>
    
    window.onload= function(){
        habilitarCampos( "viewdeudor" , false);
    }
</script>
<?= $this->endSection() ?>


