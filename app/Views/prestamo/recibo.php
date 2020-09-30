<?php

use App\Helpers\Utilidades;
?>
<!DOCTYPE html> 
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>

 
@page 
    {
        color: black;
        size:  auto;   /* auto es el valor inicial */
        margin: 0mm;  /* afecta el margen en la configuración de impresión */
    }

    
 


#cabecera, #cuerpo{
            width: 100%;;
            color:black;
            }
            tr{
                color:black;
            }
        </style>
    </head>
    <body>
        

    <div id="cabecera">
   <table style="width: 100%;">
       <tr ><td style="padding:0px;margin:0px;"><h2 style="margin:0px;">RECIBO N° <?=$NRORECIBO?></h2></td>
       <td style="width: 150px;"></td>
       <td style="border: 1px solid black; font-size: 20px;padding:0px;margin:0px;">G. <?=  Utilidades::number_f($IMPORTE)?></td></tr>
   </table>

    </div>

    <div id="cuerpo">
        <p>Recibí de <span style="text-decoration: underline;text-align: right;"><?=$CLIENTE?></span> </p>
        <p>la cantidad de guaraníes <?=$IMPORTE_LETRAS?> </p>
        <p>por concepto de <?=$CONCEPTO?>  </p>
        <p style="text-align: right;"> <?=$FECHA_LETRAS?></p>
    </div>
       
 
    </body>
</html>