<?php namespace App\Controllers;

use App\Models\Deudor_model;
use App\Models\funcionario_model; 
use Exception;

class Deudor extends BaseController
{

	//constructor
	public function __construct()
	{  
	 
	}
	
	
	public function index()
	{
		try{ 
		$Deudor= new Deudor_model();
		$lista =$Deudor->findAll(); //recoge todas las filas

		echo view("deudor/index", array("lista"=> $lista ));
		
		}catch (\Exception $e) { //mostrar mensaje de error
					//mostrar mensaje de operacion exitosa
					die( $e->getMessage() ) ;	 
			}
	}




public static function get($cedula){
		// Create a shared instance of the model
		$funcio= new Deudor_model();
		$registro= $funcio->where('CEDULA',  $cedula)->first();
		if( is_null($registro))
		echo view("deudor/form", [ "OPERACION"=> "A" , "ADICIONAL"=>"CI° NO REGISTRADO"] );
		else
			echo view("deudor/form", array("deudor_dato"=> $registro , "OPERACION"=>"M"));
}
 

private function gestionar_fotos(){
/*********** FOTO  *********************/
$datos= $this->request->getPost();
	$FOTO_ = $this->request->getFile('CEDU_ANVERSO');
	$FOTO2_ = $this->request->getFile('CEDU_REVERSO');
	if( $FOTO_->getPath() !=  "" ){//Solo si se ha proporcionado foto
		//Borrar archivo anterior
		$deudo_reg= new Deudor_model();
		$REG=$deudo_reg->find( $this->request->getPost("IDNRO") ); 
		try{
			$path_delete=  $REG->CEDU_ANVERSO ;
		if( $path_delete != "") unlink( substr( $path_delete, 1) );
		}catch (Exception $e) { }
		//fin borrado
	
	/** Substituir fotos */
	$Extension=$FOTO_->getClientExtension();
	if ($FOTO_->isValid() &&  !$FOTO_->hasMoved()){	
		$NombreFoto =$this->request->getPost("CEDULA")."-ANVERSO-".date("j-m-Y").".$Extension";
		$datos['CEDU_ANVERSO']= "/deudores/$NombreFoto" ;
		$FOTO_->move( 'deudores', $NombreFoto  ); 
		}// End reemplazo
	}


	if( $FOTO2_->getPath() !=  "" ){//Solo si se ha proporcionado foto
		//Borrar archivo anterior SEGUNDO
		try{
			$path_delete2= ! is_null( $REG)? $REG->CEDU_REVERSO : "";
			if( $path_delete2 != "") unlink( substr( $path_delete2, 1) );
		}catch (Exception $e) { }
		//fin borrado 2
		$Extension2=$FOTO2_->getClientExtension();
		if ($FOTO2_->isValid() &&  !$FOTO2_->hasMoved()){	 
			$NombreFoto2 =$this->request->getPost("CEDULA")."-REVERSO-".date("j-m-Y").".$Extension2";
			$datos['CEDU_REVERSO']= "/deudores/$NombreFoto2" ; 
			$FOTO2_->move( 'deudores', $NombreFoto2  );
			}// End reemplazo
		}
	return $datos;
}


	public function create(){
		$model = new Deudor_model();

		if ($this->request->getMethod() === 'post' )
		{
			 //Datos del formulario
			$datos=$this->gestionar_fotos(); 
			$model->save($datos );
			if($this->request->isAJAX())
			{
			$db = \Config\Database::connect();
			echo json_encode(array("IDNRO"=> $db->insertID() )  ) ;
			}
			else
			return redirect()->to( "index");
		}
		else {  	
			if($this->request->isAJAX())
			echo view('deudor/form',  ['OPERACION'=>"A"]);  
			else
			echo view('deudor/create', ['OPERACION'=>"A"]);  	}
	}




	public function edit( $id= NULL){
		$model = new Deudor_model();

		if ($this->request->getMethod() === 'post' )
		{
			 //Datos del formulario
			$datos=  $this->gestionar_fotos();
			/******** */ 
			if($model->update($datos["IDNRO"] , $datos ))
			{
				if( $this->request->isAJAX())
				echo json_encode( array( "IDNRO"=> $datos["IDNRO"] )  );
				else 
				return redirect()->to( "index");
			}
			else
			echo view('plantillas/error', ['titulo'=>"ERROR", 'mensaje'=> "NO SE PUDO ACTUALIZAR" ]);  		
					
		}
		else {  
			helper("form");
			// Create a shared instance of the model
			$funcio= new Deudor_model();
			$registro= $funcio->find( $id ); 
			echo view('deudor/edit', ['deudor_dato'=> $registro, "OPERACION"=> "M" ]);  	}
	}


	public function view( $id){
		$funcio= new Deudor_model();
		
		if( $this->request->isAJAX())
	{	$registro= $funcio->where("CEDULA",  $id )->first();
		echo view("deudor/form", array("dato"=> $registro)  );}
		else
	{	$registro= $funcio->find( $id );
		echo view("deudor/view", array("deudor_dato"=> $registro, "OPERACION"=> "V" )  );}
	}
	 


	public function delete( $id){
		$funcio= new Deudor_model(); 
		if( $funcio->delete( $id) )
		echo json_encode([ 'id'=> $id]   );
		else 
		echo json_encode( ['error' => "ERROR AL BORRAR"] );
	}

}
