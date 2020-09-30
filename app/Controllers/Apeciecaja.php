<?php namespace App\Controllers;

use App\Helpers\Utilidades;
use App\Models\Ape_cierre_caja_model;
use App\Models\Cat_monto_model;
use App\Models\Cobro_model;
use App\Models\Cuotas_model;
use App\Models\Deudor_model;
use App\Models\Garante_model;
use App\Models\Prestamo_model;
use Exception;

class Apeciecaja extends BaseController
{

	//constructor
	public function __construct()
	{  
	 helper("form");
	}
	
	
	 

 
 

	public function apertura(){
		$model = new Ape_cierre_caja_model();

		if ($this->request->getMethod() === 'post' )
		{
			 //Datos del formulario 
			$DATOS= $this->request->getPost();
			$DATOS['SALDO_INI']=   preg_replace("/(\.+)|(,+)/", "",  $DATOS['SALDO_INI']);
			if( $model->save(  $DATOS )) 
			{
				$db = \Config\Database::connect();
				$APECAJA= $db->insertID();
				$session= \Config\Services::session();
				$session->set('APECAJA',   $APECAJA );
				return redirect()->to( base_url("prestamo/index"));
			}
			else 
			echo "Error al abrir caja";
		}
		else {  	  
			echo view('apeciecaja/apertura');  	
		}
	}


	public function  aviso_pedir_apertura(){
		echo view('apeciecaja/aviso', ['MENSAJE'=> "REALICE LA APERTURA DE CAJA ANTES DE PROCEDER AL COBRO"]); 
	}


 

	public function arqueo_cierre(){
		$model = new Ape_cierre_caja_model();

		if ($this->request->getMethod() === 'post' )
		{
			 //Datos del formulario 
			$DATOS= $this->request->getPost();
			$DATOS['T_EFECTIVO']=   preg_replace("/(\.+)|(,+)/", "",  $DATOS['T_EFECTIVO']);
			$DATOS['T_CHEQUE']=   preg_replace("/(\.+)|(,+)/", "",  $DATOS['T_CHEQUE']);
			$DATOS['T_TARJETA']=   preg_replace("/(\.+)|(,+)/", "",  $DATOS['T_TARJETA']);

			if( $model->update(  session("APECAJA"),  $DATOS )) 
			{ 
				$session= \Config\Services::session();
				$session->remove('APECAJA' );
				return redirect()->to( base_url());
			}
			else 
			echo "Error al cerrar caja";
		}
		else {  	  
			echo view('apeciecaja/arqueo_cierre');  	
		}
	}



	public function  aviso_cant_close(){
		echo view('apeciecaja/aviso_plain', ['MENSAJE'=> "OPERACION NO PERMITIDA. NO HA ABIERTO NINGUNA CAJA"]); 
	}



}
