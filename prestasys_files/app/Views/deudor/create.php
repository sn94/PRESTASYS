<?= $this->extend("layouts/index") ?>

<?= $this->section("contenido") ?>


<a style="font-weight: 600;" href="<?= base_url("deudor/index")?>">
<i class="fa fa-user" aria-hidden="true"></i> &nbsp; LISTADO DE DEUDORES</a>


<div class="container p-2">
<h2 class="text-center prestyle">NUEVO DEUDOR<small></small></h2>
<div class="clearfix"></div>
</div>


<!-- INI FORM -->
<?php 
echo form_open_multipart("deudor/create", 
['id'=> "edit-deudor-form", "style"=>"padding-left: 10px;",
 "class"=> "form-horizontal   container prestyle" ])
?>
<?php echo view('deudor/form'); ?>

</form>
 
 


<?= $this->endSection() ?>


