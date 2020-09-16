<?php
                      $deudorForm=   $OPERACION=="A" ? "deudor/create" : "deudor/edit";
                      $garanteForm=   $OPERACION=="A" ? "garante/create" : "garante/edit";
                      $prestamoForm=   $OPERACION=="A" ? "prestamo/create" : "prestamo/edit";
                      ?>


<div id="wizard_verticle" class="form_wizard wizard_verticle">
                      <ul class="list-unstyled wizard_steps anchor">
                        <li>
                          <a href="#step-11" class="done selected" isdone="1" rel="1">
                            <span class="step_no">1</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-22" class="done" isdone="1" rel="2">
                            <span class="step_no">2</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-33" class="done" isdone="1" rel="3">
                            <span class="step_no">3</span>
                          </a>
                        </li>
                      
                      </ul>

                      
                      
                      
                      
                    <div class="stepContainer" style="height: 472px;"><div id="step-11" class="content" style="display: none;">
                        <h2 class="StepTitle">Datos personales</h2>
                        
                        <!-- INI FORM -->
                                    
                    <div class="input-group">
                    <span class="input-group-btn">
                    <button onclick="buscar_Cedula()" type="button" class="btn btn-primary">
                    <i class="fa fa-search" aria-hidden="true"></i></button></span>
                    <input   maxlength="8"   oninput="input_number(event)" id="CEDULABUSCAR" placeholder="BUSCAR CEDULA"   type="text" class="form-control"  >
                  </div>

                  <?php 
                  echo form_open_multipart( $deudorForm, 
                  ['id'=> "form-1", "style"=>"padding-left: 10px;", "onsubmit"=>"guardarform1(event)",
                  "class"=> "form-horizontal   container" ])
                  ?> 
                      <div id="vista-form-1">
                      <?php echo view('deudor/form'); ?>
                      </div>
                      
                      </form>
  

                      </div>
                      
                      <div id="step-22" class="content" style="display: block;">
                        <h2 class="StepTitle">Datos de Garante</h2>


                        <!--SEARCH --> 
              <div class="input-group">
                    <span class="input-group-btn">
                    <button onclick="buscar_Garante()" type="button" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button></span>
                    <input   maxlength="8"   oninput="input_number(event)" id="CEDULABUSCAR_2" placeholder="BUSCAR CEDULA"   type="text" class="form-control"  >
                  </div>

                            <!-- INI FORM -->
                  <?php 
                  echo form_open_multipart( $garanteForm, 
                  ['id'=> "form-2", "style"=>"padding-left: 10px;", "onsubmit"=>"guardarform2(event)",
                  "class"=> "form-horizontal   container" ])
                  ?>  
                      <div id="vista-form-2">
                      <?php echo view('garante/form'); ?> 
                      </div>      
                 

                    </form>
                            
                        

                      </div><div id="step-33" class="content" style="display: none;">
                        <h2 class="StepTitle">Crédito</h2>

                        <?php 
                  echo form_open( $prestamoForm, 
                  ['id'=> "form-3", "style"=>"padding-left: 10px;", "onsubmit"=>"guardarform3(event)",
                  "class"=> "form-horizontal   container" ])
                  ?>  
                 

                        <?php echo view("prestamo/form",array("montos"=> $montos)); ?> 
                        </form>

                      </div> </div>
                 <!--   <div class="actionBar">
                        <div class="msgBox"><div class="content"></div><a href="#" class="close">X</a></div>
                        <div class="loader">Loading</div>
                        <a href="#" class="buttonFinish buttonDisabled btn btn-default">Finish</a>
                        <a href="#" class="buttonNext btn btn-success">Next</a>
                        <a href="#" class="buttonPrevious btn btn-primary">Previous</a></div> -->
                      </div>




                      <script>



function guardarform1(e){

  guardar( e, function(res){ 
    
    let mensaje= JSON.parse(res); 

    $("#form-1 input[name=IDNRO]").val( mensaje.IDNRO );//En el formulario de datos personales
    $("#form-3 input[name=DEUDOR]").val( mensaje.IDNRO );//En el formulario de credito
    //nOMBRE Y CEDULA en form de credito
    $("#CI_TITULAR").val(   $("#form-1 input[name=CEDULA]").val() ); 
    $("#TITULAR_NOMBRES").val(   $("#form-1 input[name=NOMBRES]").val()+" "+ $("#form-1 input[name=APELLIDOS]").val() ); 

    new PNotify({  title: 'GUARDADO',        text: '',  type: 'success',  styling: 'bootstrap3'  });    } )
  
}

function guardarform2(e){

guardar( e, function(res){ 
  
  let mensaje= JSON.parse(res);  
  $("#form-2 input[name=IDNRO]").val( mensaje.IDNRO );//En el formulario de garante
    $("#form-3 input[name=GARANTE]").val( mensaje.IDNRO );//En el formulario de credito
     //nOMBRE Y CEDULA en form de credito
     $("#CI_GARANTE").val(   $("#form-2 input[name=CEDULA]").val() ); 
    $("#GARANTE_NOMBRES").val(   $("#form-2 input[name=NOMBRES]").val()+" "+ $("#form-2 input[name=APELLIDOS]").val() ); 

  new PNotify({  title: 'GARANTE GUARDADO',        text: '',  type: 'success',  styling: 'bootstrap3'  });    } )

}

function guardarform3(e){
  clean_numbers( "#form-3");
guardar( e, function(res){ 
  
  let mensaje= JSON.parse(res); 
  $("#form-3 input[name=IDNRO]").val( mensaje.IDNRO );
  rec_formato_numerico("#form-3");
  new PNotify({  title: 'PRESTAMO REGISTRADO',        text: '',  type: 'success',  styling: 'bootstrap3'  });    } )

}



function buscar_Cedula(){
  let cedu= $("#CEDULABUSCAR").val();
  if( cedu == "") return;
  $.ajax( {

    url: "<?= base_url("deudor/get")?>/"+cedu,
    beforeSend: function(){
      $("#vista-form-1").html( "<img src='<?= base_url("assets/img/loading.gif")?>'>" );
    },
    success: function(res){
      $("#vista-form-1").html( res );
      //Mostrar CEDULA en form de credito
      let idnro= $("#form-1 input[name=IDNRO]").val(); 
      let cedula =$("#form-1 input[name=CEDULA]").val();
      let nom= $("#form-1 input[name=NOMBRES]").val();
      let ape=$("#form-1 input[name=APELLIDOS]").val();
      $("#form-3 input[name=DEUDOR]").val( idnro);
      $("#CI_TITULAR").val( cedula );
      $("#TITULAR_NOMBRES").val(nom+" "+ape);
    }, 
    error: function(){
      $("#vista-form-1").html( "Error al recuperar datos" );
    }
  }   );
}

function buscar_Garante(){
  let cedu= $("#CEDULABUSCAR_2").val();
  if( cedu == "") return;
  $.ajax( {

    url: "<?= base_url("garante/get")?>/"+cedu,
    beforeSend: function(){
      $("#vista-form-2").html( "<img src='<?= base_url("assets/img/loading.gif")?>'>" );
    },
    success: function(res){
      $("#vista-form-2").html( res );
        //Mostrar CEDULA en form de credito
        let idnro= $("#form-2 input[name=IDNRO]").val(); 
        let cedula =$("#form-2 input[name=CEDULA]").val();
      let nom= $("#form-2 input[name=NOMBRES]").val();
      let ape=$("#form-2 input[name=APELLIDOS]").val();
      $("#CI_GARANTE").val( cedula );
      $("#GARANTE_NOMBRES").val(nom+" "+ape);
      $("#form-3 input[name=GARANTE]").val( idnro);
    }, 
    error: function(){
      $("#vista-form-2").html( "Error al recuperar datos" );
    }
  }   );
}
</script>