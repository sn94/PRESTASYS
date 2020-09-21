<?= $this->extend("layouts/index") ?>

<?= $this->section("contenido") ?>


<a class="btn btn-sm btn-primary" href="<?= base_url("usuario/index")?>">
<i class="fa fa-user" aria-hidden="true"></i> &nbsp; LISTADO DE USUARIOS</a>


<div class="container p-2">
<h2 class="text-center">NUEVO USUARIO<small></small></h2>
<div class="clearfix"></div>
</div>


<!-- INI FORM -->
<?php 
echo form_open("usuario/create", 
['id'=> "edit-usuario-form", "style"=>"padding-left: 10px;",
 "class"=> "form-horizontal   container" ])
?>
<?php echo view('usuario/form'); ?>

</form>
 
 


<?= $this->endSection() ?>


