<?php namespace App\Controllers;

use App\Helpers\Utilidades;
use App\Models\Cat_monto_model;
use App\Models\Cobro_model;
use App\Models\Cuotas_model;
use App\Models\Deudor_model;
use App\Models\Garante_model;
use App\Models\Prestamo_model;
use Exception;

class Prestamo extends BaseController
{

	//constructor
	public function __construct()
	{  
	 helper("form");
	}
	
	
	public function index()
	{
		try{ 
		 
		$reg= new Prestamo_model();
		$builder = $reg->builder();
		$builder 
		->select("deudor.IDNRO as DEUDORID,CONCAT(deudor.NOMBRES,CONCAT(' ',deudor.APELLIDOS)) AS DEUDOR,
		(SELECT COUNT(cuotas_prestamo.IDNRO) FROM cuotas_prestamo WHERE IDPRESTAMO=prestamo.IDNRO) AS TOTCUOTAS,
		(SELECT COUNT(detalle_cobro.IDNRO) FROM cobro,detalle_cobro WHERE cobro.IDNRO=detalle_cobro.IDCOBRO 
		 AND cobro.IDPRESTAMO=prestamo.IDNRO) AS PAGADAS,
		prestamo.IDNRO,FECHA_SOLICI,MONTO_SOLICI, ESTADO")
		->join('deudor', 'deudor.IDNRO = prestamo.DEUDOR', "left") 
		->join('categoria_monto', 'categoria_monto.IDNRO = prestamo.CAT_MONTO')
		->orderBy("prestamo.created_at");
		$query = $builder->get();
		$lista= $query->getResult();  //recoge todas las filas
		 
		echo view("prestamo/index", array("lista"=> $lista ));
		
		}catch (\Exception $e) { //mostrar mensaje de error
					//mostrar mensaje de operacion exitosa
					die( $e->getMessage() ) ;	 
			}
	}


 
 

	public function create(){
		$model = new Prestamo_model();

		if ($this->request->getMethod() === 'post' )
		{
			 //Datos del formulario 
			$model->save(  $this->request->getPost());
			if( $this->request->isAJAX())
			{$db = \Config\Database::connect();
			echo json_encode( array("IDNRO"=> $db->insertID(),  "MENSAJE"=>"PRESTAMO REGISTRADO"    ));}
			else
			return redirect()->to( base_url("prestamo/index"));
		}
		else {  	
			helper("form");
				/***Montos */
		$catm= new Cat_monto_model();
		$montos= $catm->list_dropdown(); 
		/**** */
	 
			/**** */
			echo view('prestamo/create', ['montos'=> $montos , 'OPERACION'=> 'A']);  	
		}
	}




	public function edit( $id= NULL){
		$model = new Prestamo_model();

		if ($this->request->getMethod() === 'post' )
		{
			 //Datos del formulario 
			 $datos= $datos= $this->request->getPost();
			if($model->update($datos["IDNRO"] , $datos  ))
			{

				if( $this->request->isAJAX())
				echo json_encode( array( "IDNRO"=> $datos["IDNRO"], "MENSAJE"=>"INFORMACIÓN DE PRESTAMO ACTUALIZADO" )  );
				else 
				return redirect()->to( base_url("prestamo/index"));
			}
			else
			echo view('plantillas/error', ['titulo'=>"ERROR", 'mensaje'=> "NO SE PUDO ACTUALIZAR" ]);  		
					
		}
		else {  
			helper("form");
			$reg= new Prestamo_model();
			$builder = $reg->builder();
			$builder 
			->select("deudor.IDNRO as DEUDORID,deudor.CEDULA as DEUDORCI,CONCAT(deudor.NOMBRES,CONCAT(' ',deudor.APELLIDOS)) AS DEUDORNOM,
			 garante.IDNRO as GARANTEID, garante.CEDULA AS GARANTECI,CONCAT(garante.NOMBRES,CONCAT(' ',garante.APELLIDOS)) as GARANTENOM,
			prestamo.*")
			->join('deudor', 'deudor.IDNRO = prestamo.DEUDOR')
			->join('garante', 'garante.IDNRO = prestamo.GARANTE')
			->join('categoria_monto', 'categoria_monto.IDNRO = prestamo.CAT_MONTO')
			->where( "prestamo.IDNRO", $id);
			$query = $builder->get();
			$prestamo= $query->getRow(); 
			//Datos del deudor
			$deu= new Deudor_model();
			$deudor= $deu->find($prestamo->DEUDORID);
			//Datos del garante
			$garan= new Garante_model();
			$garante= $garan->find($prestamo->GARANTEID);
			/***Montos */ 
			$catm= new Cat_monto_model();
			$montos= $catm->list_dropdown(); 
			/**** */
		 

			echo view('prestamo/edit', [  "montos" => $montos,  'OPERACION'=> 'M', "prestamo_dato"=> $prestamo, 
			"deudor_dato"=> $deudor ,"garante_dato"=> $garante]);  	}
	}




	

	public function view( $id){
		helper("form");
		$reg= new Prestamo_model();
		$builder = $reg->builder();
		$builder 
		->select("deudor.IDNRO as DEUDORID,deudor.CEDULA as DEUDORCI,CONCAT(deudor.NOMBRES,CONCAT(' ',deudor.APELLIDOS)) AS DEUDORNOM,
		 garante.IDNRO as GARANTEID, garante.CEDULA AS GARANTECI,CONCAT(garante.NOMBRES,CONCAT(' ',garante.APELLIDOS)) as GARANTENOM,
		prestamo.*")
		->join('deudor', 'deudor.IDNRO = prestamo.DEUDOR')
		->join('garante', 'garante.IDNRO = prestamo.GARANTE')
		->join('categoria_monto', 'categoria_monto.IDNRO = prestamo.CAT_MONTO')
		->where( "prestamo.IDNRO", $id);
		$query = $builder->get();
		$prestamo= $query->getRow(); 
		//Datos del deudor
		$deu= new Deudor_model();
		$deudor= $deu->find($prestamo->DEUDORID);
		//Datos del garante
		$garan= new Garante_model();
		$garante= $garan->find($prestamo->GARANTEID);
		/***Montos */
		$catm= new Cat_monto_model();
		$montos= $catm->list_dropdown(); 
		/**** */
	 

		echo view("prestamo/view", array( "montos" => $montos, "prestamo_dato"=> $prestamo, "deudor_dato"=> $deudor ,
		"garante_dato"=> $garante,  "OPERACION"=> "V" )  );
	}
	 


	public function delete( $id){
		$funcio= new Prestamo_model(); 
		if( $funcio->delete( $id) )
		echo json_encode([ 'id'=> $id]   );
		else 
		echo json_encode( ['error' => "ERROR AL BORRAR"] );
	}




/**
 * 
 * APROBACION RECHAZO
 */
	public function aprobar( $id_prestamo =""){

		if ($this->request->getMethod() === 'post' )
		{

			//Actualizar estado de prestamo a Aprobado
				//Generar las cuotas
			$prestamo_m= new Prestamo_model(); 
			$id_prestamo= $this->request->getPost("IDNRO");
			$prestamo= $prestamo_m->find($id_prestamo);
			//Verificar si ya se aprobo
			if( $prestamo_m->ESTADO == "A" ){
				return redirect()->to(base_url("prestamo/index"));
			}else{
				$prestamo_m->aprobar(); 	 
				return redirect()->to( base_url("prestamo/index"));
			}
		}
		else{
			$prestamo_m= new Prestamo_model();
			//Prestamo
			$prestamo= $prestamo_m->find($id_prestamo);
			if( $prestamo->ESTADO == "A" ){
				return redirect()->to( base_url("prestamo/index") );
			}else{
				//Cliente deudor
				$ID_deudor= $prestamo->DEUDOR;
				$deudor_m= new Deudor_model();
				$deudor= $deudor_m->find( $ID_deudor); 
				//Categoria monto
				$catem= new Cat_monto_model();
				$catemonto= $catem->find(  $prestamo->CAT_MONTO);

				helper("form"); 
						/***Montos */
				$catm= new Cat_monto_model();
				$montos= $catm->list_dropdown(); 
				/**** */

				echo view("prestamo/aprobar",
				["deudor"=>$deudor, "prestamo"=>$prestamo, "monto"=> $catemonto, "montos"=> $montos]);	
			} 
		}
	}



	public function rechazar(  $id_prestamo){

		$prestamo= new Prestamo_model();
		if(  $prestamo->update(  $id_prestamo, ['ESTADO'=> 'R'] ) )
		echo json_encode( ['IDNRO'=> $id_prestamo, 'MENSAJE'=>'LA SOLICITUD DE PRESTAMO HA SIDO RECHAZADA']);
		else
		$this->error_alert();
	}

	public function cobro( $id_prestamo =""){

		if ($this->request->getMethod() === 'post' )
		{

			$cobro= $this->request->getPost("CABECERA");
			$id_prestamo= $cobro['IDPRESTAMO'];
 
			//Actualizar estado de prestamo a Aprobado
			//Generar las cuotas
			$cobr= new Cobro_model(); 
			if($cobr->cobrar_cuotas())
			return redirect()->to(base_url("prestamo/index")); 
			else 
			return redirect()->to( base_url('/prestamo/error_alert')); //algun mensaje de error
		}
		else{
			$prestamo_m= new Prestamo_model();
			//Prestamo
			$prestamo= $prestamo_m->find($id_prestamo);
			//Cliente deudor
			$ID_deudor= $prestamo->DEUDOR;
			$deudor_m= new Deudor_model();
			$deudor= $deudor_m->find( $ID_deudor); 
			//Categoria monto
			$catem= new Cat_monto_model();
			$catemonto= $catem->find(  $prestamo->CAT_MONTO);
	
			helper("form"); 
					/***Montos */
			$catm= new Cat_monto_model();
			$montos= $catm->list_dropdown(); 
			/**** */
			/***Cuotas */
			$cuotas= $prestamo_m->obtener_cuotas(  $id_prestamo); 
		 
			echo view("prestamo/cobro",
			 ["deudor"=>$deudor, "prestamo_dato"=>$prestamo, "monto"=> $catemonto, "montos"=> $montos, "cuotas"=>$cuotas]);	
		}
	}



	public function error_alert(){
		echo json_encode( ['error'=> "Ocurrió un error en el servidor, no se han concretado las transacciones"]);
	}

}
