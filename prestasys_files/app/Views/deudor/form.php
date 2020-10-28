

<?php 
if( isset($ADICIONAL) ):
  ?> 
  <div class="alert alert-warning alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><?= $ADICIONAL ?></strong>
</div>
<?php
endif;
?>


<input type="hidden" name="IDNRO"  value="<?= $OPERACION != "A" ?  $deudor_dato->IDNRO : "" ?>">
 
<div class="form-group">
  <label>TIPO PERSONA:</label>
  <p style="color: #525252;font-weight: 600;">
  FÍSICA<input  onclick="cambiar_tipo_persona('F')" type="radio"   name="TIPO_PERSONA" id="genderM" value="F"  <?= !isset($deudor_dato) ? "" :  ($deudor_dato->TIPO_PERSONA=="F" ? "checked": "")?>> &nbsp;
  JURÍDICA
  <input  onclick="cambiar_tipo_persona('J')"   type="radio"  name="TIPO_PERSONA" id="genderF" value="J"  <?= !isset($deudor_dato) ? "checked" :  ($deudor_dato->TIPO_PERSONA=="J" ? "checked": "")?>  >
 </p>
</div>


<div id="VISTA-FORM">

 <?php
 if( (!isset($deudor_dato) ?  true :  ($deudor_dato->TIPO_PERSONA=="F" ? false : true)) )
 echo view("deudor/persona_juridica");
 else 
 echo view("deudor/persona_fisica");
 ?>

</div>

<script>



function mostrar_ficha(ev){
    if(ev.keyCode == 13){
      let cedula= $("#CEDULA").val();
      $.ajax({
        url: "<?=base_url("deudor/view")?>/"+cedula,
        beforeSend: function(){     },
        success: function(resp){
          $("#form-1").html( resp);
        },
        error: function(){  
          new PNotify({
                                  title: 'ERROR',
                                  text: '',
                                  type: 'error',
                                  styling: 'bootstrap3'
                              }); 
        }
      });
    }
  }


function  cambiar_tipo_persona(tipo){

  $.ajax({
    url: "<?=base_url("deudor/get_empty_view")?>/"+tipo,
    beforeSend: function(){     $("#spinner_system").css("display", "block");  },
    success: function(resp){
      $("#spinner_system").css("display", "none");
      $("#VISTA-FORM").html(  resp );
    }, 
    error: function(){  $("#spinner_system").css("display", "none"); }
  })

}
 window.onload= function(){
   autocompletado();
    //FECHAS
    $("input[type=date]").each(  function(index, elemento){
        if(  this.value =="" )
            $(elemento).css("color", "white");
            $(elemento).bind("change", function(){
                if( this.value ==""  ||  this.value == undefined){
                    console.log( this.value );
                    $(  this  ).css("color", "white");
                    return;
                }
                $(  this  ).css("color", "black");
            })
        });/** end fechas */
 }
</script>
