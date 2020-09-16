<?= $this->extend("layouts/index") ?>

<?= $this->section("contenido") ?>


<a class="btn btn-sm btn-primary" href="<?= base_url("garante/index")?>">
<i class="fa fa-user" aria-hidden="true"></i> &nbsp; LISTADO DE GARANTES</a>


<div class="container p-2">
<h2 class="text-center">NUEVO GARANTE<small></small></h2>
<div class="clearfix"></div>
</div>


<!-- INI FORM -->
<form style="padding-left: 10px;" enctype="multipart/form-data" class="form-horizontal container" method="post" action="/garante/create">
 
<?php echo view('garante/form'); ?>

</form>
 
 


<?= $this->endSection() ?>


