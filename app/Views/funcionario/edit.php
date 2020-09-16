<?= $this->extend("layouts/index") ?>

<?= $this->section("contenido") ?>


<a class="btn btn-sm btn-primary" href="<?= base_url("funcionario/index")?>">
<i class="fa fa-user" aria-hidden="true"></i> &nbsp; NÓMINA DE FUNCIONARIOS</a>


<div class="container p-2">
<h2 class="text-center">ACTUALIZAR DATOS DE FUNCIONARIO<small></small></h2>
<div class="clearfix"></div>
</div>

<!-- INI FORM -->
<form style="padding-left: 10px;" enctype="multipart/form-data" class="form-horizontal form-label-left container" method="post" action="/funcionario/edit">
 <input type="hidden" name="IDNRO" value="<?= $dato->IDNRO ?>">
<?php echo view('funcionario/form'); ?>

</form>

<?= $this->endSection() ?>


