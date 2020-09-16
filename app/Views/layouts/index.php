<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>PRESTASYS </title>


    <!-- Custom Theme Style -->
    <link href="<?= base_url("assets/merged.css")?>" rel="stylesheet">
    <link href="<?= base_url("assets/pnotify.css")?>" rel="stylesheet">
    <link href="<?= base_url("assets/pnotify.buttons.css")?>" rel="stylesheet">
   

    <style>
        
        h2{
            color: #2e2e2e;
            font-weight: 600;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        tr,a,label, input[type=text],select{
            font-size: 10pt;
            color: #2a2a2a;
            font-weight: 600;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }  
        input[type=text],select{
            color: #444444;
        }
        thead tr{ background-color: #7dc0f7;  }
        tbody tr{    background-color: #b4b9fe;   }


    .table-primary{
    background-color: #7ca9fc !important;
  }    
  .table-success{
    background-color: #64f55c !important;
  }
  .table-danger{
    background-color: #fb614a !important;
  }
  .table-secondary{
    background-color: #909090 !important;
  }

  .icon-success{
    color: #0f8c09 !important;
  }
  .icon-danger{
    color: #fa2405 !important;
  }
  
    </style>

</head>

<body class="nav-md">

<img   id='spinner_system'   style='display:none;left: 50%;right: 50%; position: absolute; z-index: 180000000;' src='<?=base_url("assets/img/spinner.gif") ?>'' >
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?=base_url()?>" class="site_title"><i class="fa fa-money"></i> <span>Prestasys</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?=base_url("assets/images/img.jpg")?>" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Bienvenido,</span>
                            <h2>John Doe</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Cr&eacute;ditos <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?=base_url("deudor/index")?>">Datos de cliente</a></li>
                                        <li><a href="<?=base_url("garante/index")?>">Garantes</a></li>
                                        <li><a href="<?=base_url("prestamo/index")?>">Préstamos</a></li>
                                        <li><a href="index3.html">Ofrecimientos</a></li>
                                        <li><a href="index3.html">Referencias comerciales</a></li>
                                        <li><a href="index3.html">Datos de c&eacute;dula</a></li>
                                        <li><a href="index3.html">Informes</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-edit"></i> Caja <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="form.html">Cobranzas</a></li>
                                        <li><a href="form_advanced.html">Liquidaci&oacute;n</a></li>
                                        <li><a href="form_validation.html">Pago de clientes</a></li>
                                        <li><a href="form_wizards.html">Caja chica</a></li>
                                        <li><a href="form_upload.html">Impresi&oacute;n de documentos</a></li>
                                        <li><a href="form_buttons.html">Ficha de control</a></li>
                                        <li><a href="form_buttons.html">Cierre de caja</a></li>
                                        <li><a href="form_buttons.html">Informes</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-desktop"></i> Auxiliares <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?=base_url("funcionario/index")?>">Funcionarios</a></li>
                                        <li><a href="<?=base_url("caja/index")?>">Caja</a></li>
                                        <li><a href="<?=base_url("cargo/index")?>">Cargos de funcionario</a></li>
                                        <li><a href="<?=base_url("categoria_monto/index")?>">Categoría de monto</a></li>
                                        <li><a href="glyphicons.html">Edici&oacute;n fecha judicial</a></li>
                                        <li><a href="widgets.html">Informes</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-table"></i> Estadistica <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="tables.html">Saldos a cobrar</a></li>
                                        <li><a href="tables_dynamic.html">Cuotas vencidas</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-bar-chart-o"></i> Informes <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="chartjs.html">Cuaderno de pr&eacute;stamo</a></li>
                                        <li><a href="chartjs2.html">Cuaderno de inversi&oacute;n</a></li>
                                        <li><a href="morisjs.html">Capital & inter&eacute;s</a></li>
                                        <li><a href="echarts.html">A recaudar</a></li>
                                        <li><a href="other_charts.html">Cancelaci&oacute;n por adelantado</a></li>
                                        <li><a href="other_charts.html">Cancelaci&oacute;n del mes</a></li>
                                        <li><a href="other_charts.html">Operaciones con saldos</a></li>
                                        <li><a href="other_charts.html">Cumplea&ntilde;os</a></li>
                                        <li><a href="other_charts.html">Clientes por empresa</a></li>
                                        <li><a href="other_charts.html">Operaci&oacute;n sin renovar </a></li>
                                        <li><a href="other_charts.html">Operaciones canceladas</a></li>
                                        <li><a href="other_charts.html">Control de operaciones</a></li>
                                        <li><a href="other_charts.html">Saldos de cuentas</a></li>
                                        <li><a href="other_charts.html">36 meses sin pagar</a></li>
                                        <li><a href="other_charts.html">Recalculo de saldos</a></li>
                                    </ul>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="menu_section">
                            <h3>Live On</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-bug"></i> Varios <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="e_commerce.html">Plan cta. caja chica</a></li>
                                        <li><a href="projects.html">C&oacute;digo de letras</a></li>
                                        <li><a href="project_detail.html">Nombres de dict&aacute;menes</a></li>
                                        <li><a href="contacts.html">Asociaciones</a></li>
                                        <li><a href="profile.html">Porcentajes</a></li>
                                        <li><a href="project_detail.html">Re-proceso de datos</a></li>
                                        <li><a href="contacts.html">Modificar vencimientos</a></li>
                                        <li><a href="profile.html">Cambio c&oacute;d. de operaci&oacute;n</a></li>
                                        <li><a href="profile.html">Tabla de gastos-cobranza</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-windows"></i> &Uacute;tiles <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="page_403.html">Organizar datos</a></li>
                                        <li><a href="page_404.html">Copia de seguridad</a></li>
                                        <li><a href="page_500.html">Restaurar copias</a></li>
                                        <li><a href="plain_page.html">Mensajes iniciales</a></li>
                                        <li><a href="login.html">Configurar impresora</a></li>
                                        <li><a href="pricing_tables.html">Borrar lista de impresi&oacute;n</a></li>
                                        <li><a href="pricing_tables.html">Actualizar datos de operaci&oacute;n</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="#level1_1">Level One</a>
                                            <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                                                <ul class="nav child_menu">
                                                    <li class="sub_menu"><a href="level2.html">Level Two</a>
                                                    </li>
                                                    <li><a href="#level2_1">Level Two</a>
                                                    </li>
                                                    <li><a href="#level2_2">Level Two</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="#level1_2">Level One</a>
                                            </li>
                                    </ul>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= base_url("assets/images/img.jpg")?>" alt="">John Doe
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="javascript:;"> Profile</a></li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li><a href="javascript:;">Help</a></li>
                                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                    <li>
                                        <a>
                                            <span class="image"><img src="<?= base_url("assets/images/img.jpg")?>" alt="Profile Image" /></span>
                                            <span>
                          <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image"><img src="<?= base_url("assets/images/img.jpg")?>" alt="Profile Image" /></span>
                                            <span>
                          <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image"><img  src="<?= base_url("assets/images/img.jpg")?>"  alt="Profile Image" /></span>
                                            <span>
                          <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image"><img  src="<?= base_url("assets/images/img.jpg")?>" alt="Profile Image" /></span>
                                            <span>
                          <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main" style="min-height: 3627px;">
          <div class="">
            
            <div class="clearfix"></div>

            
            <div class="row">
              

              <div class="col-12"><!-- col-md-12 col-xs-12 -->
                
                  
                  
            <?= $this->renderSection("contenido") ?>

                 
            
              </div>

 
            </div>

          

            

 
          </div>
        </div>


            
         
           
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>


    <!-- Custom Theme Scripts -->
    <script src="<?=base_url("assets/merged.js")?>"></script>

    <!--AUTOCOMPLETADO --> 
    <script src="<?=base_url("assets/jquery.autocomplete.min.js")?>"></script>
    <script src="<?=base_url("assets/jquery.dataTables.min.js")?>"></script>
    <!--Wizard--> 
    <script src="<?=base_url("assets/jquery.smartWizard.js")?>"></script>
    <!--Notificacion-->
    <script src="<?=base_url("assets/pnotify.js")?>"></script>

    <script src="<?=base_url("assets/pnotify.buttons.js")?>"></script>
    
    <script>



function hoy(){
    let fechaBase= new Date();
    let anio=   fechaBase.getFullYear(); 
      let mes= (fechaBase.getMonth()+1) < 10 ? "0"+(fechaBase.getMonth()+1) : (fechaBase.getMonth()+1);
      let diaa= (fechaBase.getDate()) < 10 ? "0"+(fechaBase.getDate()) : (fechaBase.getDate());
      let FECHA=  anio+"-"+ mes+"-"+ diaa;
      return FECHA;
  }



//DESHABILITAR HABILITAR CAMPOS DE FORM
function habilitarCampos( targetId, hab){
   
    let target= document.getElementById(targetId);
    let context= target.elements;
    Array.prototype.forEach.call( context, function(ar){ar.disabled=!hab;   });
  }



//Autocomplete
function autocompletado(){
    $.ajax( {
    url: "<?=base_url("assets/ciudades.json")?>",
    dataType: "json",
    success:function( res){
        var dataArray = res.map(function(value) {
        return {
            value: value.nombre,
            data: value.id_ciu
        };
        });
        // initialize autocomplete with custom appendTo
       /* $(id).autocomplete({
        lookup: dataArray
        });*/
        /**test */
        let elementosCoincidentes= document.querySelectorAll(".ciudad");
        console.log( elementosCoincidentes);
        Array.prototype.forEach.call(  elementosCoincidentes,  function(entrada){
            $(entrada).autocomplete({ lookup: dataArray    });
        });
        /**end test */
    }//End Success
});
 
}



/***Autocomplete end  */


 //mostrar imagen seleccionada
 function show_loaded_image(  ev){
        let entrada=  ev.srcElement;
        console.log( entrada);
        let reader = new FileReader();
        reader.onload=    function(e){
        var filePreview = document.createElement('img');
        filePreview.className= "img-thumbnail";
        filePreview.src = e.target.result;
        filePreview.style.width =  "100%";
        filePreview.style.maxHeight="200px";
        let tagDestination= "#"+ev.target.name;
        var previewZone = document.querySelector( tagDestination);
        previewZone.innerHTML="";
        previewZone.appendChild(filePreview); 
        };
        reader.readAsDataURL(   entrada.files[0]);
}// show_loaded_image( event, "#idid")



//Limpia campos numericos del separador de miles
function quitarSeparador( obj){ 
let w=  obj.value.replaceAll("[.]", "");
obj.value= w;
}


//lIMPIA todos los campos numericos de un formulario
function clean_numbers(formid){
    $(formid+" .number-format").each( function( indice, obj){    quitarSeparador( obj); } );

}

//Recuperar formato numerico de los campos
function rec_formato_numerico(formid){ 
  $(formid+" .number-format").each( function( indice, obj){    numero_con_puntuacion( obj); } );
}


//Permite solo entrada numerica
//A la vez, da formato de millares al valor del campo que se esta controlando
function input_number_millares(ev){
    if( ev.data == undefined) return; 
    if( ev.data.charCodeAt() < 48 || ev.data.charCodeAt() > 57){ 
      ev.target.value= 
      ev.target.value.substr( 0, ev.target.selectionStart-1) + 
      ev.target.value.substr( ev.target.selectionStart );
    }
     //Formato de millares
    let val_Act= ev.target.value;  
  val_Act= val_Act.replaceAll( new RegExp(/[\.]*[,]*/g), ""); 
    let enpuntos= new Intl.NumberFormat("de-DE").format( val_Act);
		$( ev.target).val(  enpuntos);
    } 
    


    //convertir una cadena numerica a formato de millares
function numero_con_puntuacion( ev){
    let val_Act= ev;
    if( typeof ev == "object")  val_Act= ev.target.value;
    let enpuntos= new Intl.NumberFormat("de-DE").format( val_Act);
    if( typeof ev == "object") $( ev.target).val(  enpuntos);
    else return enpuntos;
}
    //Exclusivamente numeros
        function input_number( ev){
            if( ev.data == undefined) return; 
            if( ev.data.charCodeAt() < 48 || ev.data.charCodeAt() > 57){ 
            ev.target.value= 
            ev.target.value.substr( 0, ev.target.selectionStart-1) + 
            ev.target.value.substr( ev.target.selectionStart );
            }
        }


        function guardar(ev, success){
    ev.preventDefault();
    let ENCTYPE= 'application/x-www-form-urlencoded';
    if( ev.target.enctype ==  "multipart/form-data")  ENCTYPE=  "multipart/form-data";

    let DATA= ( ev.target.enctype ==  "multipart/form-data")? new FormData(  ev.target ): $(ev.target).serialize(); 

    let SETTING= {
        url:  ev.target.action,
        enctype: ENCTYPE,
        data: DATA,
        method: "POST",
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        beforeSend: function(){ 
            $("#spinner_system").css("display", "block")
       
        },
        success: function(res){  $("#spinner_system").css("display", "none"); success(res);},
        error: function(res){
            $("#spinner_system").css("display", "none") 
            new PNotify({
                                  title: 'ERROR',
                                  text: '',
                                  type: 'danger',
                                  styling: 'bootstrap3'
                              });  
         }
    };
    if ( ev.target.enctype ==  "multipart/form-data"){
        SETTING.processData= false; SETTING.contentType= false;
    }
    $.ajax(  SETTING)
  }

  

function get_custom( url, success){
   $.ajax( {
        url:  url,  
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        beforeSend: function(){ 
            $("#spinner_system").css("display", "block")
       
        },
        success: function(res){  $("#spinner_system").css("display", "none"); success(res);},
        error: function(res){
            $("#spinner_system").css("display", "none") 
            new PNotify({
                                  title: 'ERROR',
                                  text: '',
                                  type: 'danger',
                                  styling: 'bootstrap3'
                              });  
         }
    });
}


  window.onload= function(){
      autocompletado();
      $("div.stepContainer.content").css("width", "100%");
      $("div.stepContainer.content").css("height", "100%");
      //FECHAS
    $("input[type=date]").each(  function(index, elemento){
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

</body>

</html>