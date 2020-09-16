<?= $this->extend("layouts/index") ?>

<?= $this->section("contenido") ?>


<a class="btn btn-sm btn-primary" href="<?= base_url("garante/index")?>">
<i class="fa fa-user" aria-hidden="true"></i> &nbsp; LISTADO DE GARANTES</a>


<div class="container p-2">
<h2 class="text-center">GARANTES - ACTUALIZAR DATOS<small></small></h2>
<div class="clearfix"></div>
</div>

<!-- INI FORM -->
 
<?php 
echo form_open_multipart( "garante/edit",   [ "style"=>"padding-left: 10px;",  "class"=> "form-horizontal   container" ]);
?>  

<?php echo view('garante/form'); ?>

</form>



<?= $this->endSection() ?>


