<?php 


namespace App\Helpers;
use Exception;
use DateTime;
class Utilidades{



    public static function number_f( $ar){

        try{
          $v= floatval( $ar);
          return number_format($v, 0, '', '.');  
        }catch( Exception $err){
          return 0;
        }
        }

        /**From Timestamp */
      public static function  from_timestamp( $arg){
        // Fecha en formato yyyy/mm/dd
      $fecha = DateTime::createFromFormat('Y-m-d h:i:s',  $arg);
      // Fecha en formato dd/mm/yyyy
      $fecha_= $fecha->format('d/m/Y');
      return $fecha_;
      }


        /**Devuelde de yyyy-mm-dd a dd-mm-yyyy */
      public static function fecha_f( $fe){ 
        //convertir de d/m/Y a Y/m/d
       if( $fe==""  || $fe =="0000-00-00" ) return "";
      
        $fecha= explode("-",  $fe);
        if( sizeof( $fecha) > 1){
           return   $fecha[2]."/".$fecha[1]."/". $fecha[0]; 
        }else
        return  $fe;//la fecha esta en otro formato
      }

      
  //Formato numero decimal de coma  a punto
        public static function fromComaToDot( $ar){
          return str_replace( ",", ".", $ar);
        }



    public static function dropdown( $params){
        $resu=  array();
        foreach( $params as $ite):
             $nuevo=array_values( $ite);
                $resu[$nuevo[0]]= $nuevo[1];
             
        endforeach;
        return $resu;
    }

}


?>