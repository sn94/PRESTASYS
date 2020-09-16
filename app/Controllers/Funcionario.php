<?php namespace App\Controllers;

use App\Helpers\Utilidades;
use App\Models\Cargo_model;
use App\Models\funcionario_model; 
use Exception;

class Funcionario extends BaseController
{

	//constructor
	public function __construct()
	{  
		//instanciar el modelo 
		$this->em= new Funcionario_model(); 
	}
	
	
	public function index()
	{
		try{ 
		$listafuncionario= $this->em->findAll(); //recoge todas las filas

		echo view("funcionario/index", array("lista"=> $listafuncionario ));
		
		}catch (\Exception $e) { //mostrar mensaje de error
					//mostrar mensaje de operacion exitosa
					die( $e->getMessage() ) ;	 
			}
	}


	public function list(){
		try{
			//un template de tabla
		$table = new \CodeIgniter\View\Table();

		$template = [
				'table_open' => '<table cellpadding="2" cellspacing="1" class="table table-bordered table-striped">'
		];
		
		$table->setTemplate($template);
		//cabecera de la tabla
		$table->setHeading('ID','Sucursal','Cargo', 'Zona', 'Ciudad', 'Turno','Nombre','Apellido','Cedula','Direccion','Email');
		$listafuncionario= $this->em->findAll();
		$tabla= $table->generate($listafuncionario);
		echo view("funcionario/list", array("lista"=> $tabla ));

	}catch (\Exception $e) { //mostrar mensaje de error
				//mostrar mensaje de operacion exitosa
				die( $e->getMessage() ) ;	 
		}
	}


	public function create(){
		$model = new funcionario_model();
		helper("form");
		if ($this->request->getMethod() === 'post' )
		{
			 //Datos del formulario
			$datos= $this->request->getPost();
			/** FOTO  */
			$FOTO_ = $this->request->getFile('FOTO');
			$Extension=$FOTO_->getClientExtension();
			if ($FOTO_->isValid() &&  !$FOTO_->hasMoved()){	
				$NombreFoto =$this->request->getPost("CEDULA").date("j-m-Y").".$Extension";
				$datos['FOTO']= "/funcionarios/$NombreFoto" ;
				$FOTO_->move( 'funcionarios', $NombreFoto  );
			}
			/******** */ 
			$model->save($datos);
			return redirect()->to( "index");
		}
		else {  
			$db = \Config\Database::connect();
			$reg= $db->query('select * from cargo');
			$cargos= $reg->getResultArray();//getResultArray(); 
			$resu=   Utilidades::dropdown($cargos);
 
			echo view('funcionario/create', ['cargos'=> $resu]);  	}
	}




	public function edit( $id= NULL){
		$model = new funcionario_model();

		if ($this->request->getMethod() === 'post' )
		{
			 //Datos del formulario
			$datos= $this->request->getPost();
			
			/*********** FOTO  *********************/
			
				$FOTO_ = $this->request->getFile('FOTO');
				if( $FOTO_->getPath() !=  "" ){//Solo si se ha proporcionado foto
					//Borrar archivo anterior
					$funcio_reg= new funcionario_model();
					$path_delete=$funcio_reg->find( $this->request->getPost("IDNRO") )->FOTO;
					try{
					if( $path_delete != "") unlink( substr( $path_delete, 1) );
					}catch (Exception $e) {
						
					}
					//fin borrado
					$Extension=$FOTO_->getClientExtension();//Obtener extension de archivo
					//Ubicar el nuevo archivo
					if ($FOTO_->isValid() &&  !$FOTO_->hasMoved()){	
						$NombreFoto =$this->request->getPost("CEDULA").date("j-m-Y").".$Extension";
						$datos['FOTO']= "/funcionarios/$NombreFoto";
						$FOTO_->move(  'funcionarios', $NombreFoto  );//WRITEPATH
					}
				}
				/******** */ 
				if($model->update($datos["IDNRO"] , $datos ))
				return redirect()->to( "index");
				else
				echo view('plantillas/error', ['titulo'=>"ERROR", 'mensaje'=> $e->getMessage() ]);  
					
		}
		else {  
			// Create a shared instance of the model
			$funcio= new funcionario_model();
			$registro= $funcio->find( $id );
			echo view('funcionario/edit', ['dato'=> $registro ]);  	}
	}


	public function view( $id){
		$funcio= new funcionario_model();
		$registro= $funcio->find( $id );
		echo view("funcionario/view", array("dato"=> $registro, "vista"=> true )  );
	}
	 


	public function delete( $id){
		$funcio= new funcionario_model(); 
		if( $funcio->delete( $id) )
		echo json_encode([ 'id'=> $id]   );
		else 
		echo json_encode( ['error' => "ERROR AL BORRAR"] );
	}

}
