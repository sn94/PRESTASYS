<?php namespace App\Controllers;

use App\Helpers\NumeroALetras;
use App\Helpers\Utilidades;
use App\Libraries\pdf_gen\PDF;
use App\Models\Cat_monto_model;
use App\Models\Cobro_model;
use App\Models\Cuotas_model;
use App\Models\Deudor_model;
use App\Models\Garante_model;
use App\Models\Prestamo_model;
use App\Models\Recibo_model;
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
		prestamo.IDNRO,FECHA_SOLICI,MONTO_APROBADO, ESTADO")
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



	private function generar_recibo( $id_cobro){

		$cobro= $this->request->getPost("CABECERA"); 
		$TOTAL_IMPORTE=  intval($cobro['EFECTIVO_T']) + intval($cobro['TARJE_IMPO']) + intval($cobro['CHEQUE_IMPO']);
		$DEUDOR= $cobro['DEUDOR'];
		//CAT MONTO
		$objPrestamo= (new Prestamo_model())->find( $cobro['IDPRESTAMO'] );
		$categoria= (new Cat_monto_model())->find( $objPrestamo->CAT_MONTO );

		$CONCEPTO= "PAGO DE CUOTA DEL CREDITO DE ".Utilidades::number_f($categoria->MONTO)."(".Utilidades::number_f($categoria->CUOTA)."X".$categoria->NRO_CUOTAS.")";
		$FECHA_L= Utilidades::fechaDescriptiva( $cobro['FECHA'] );
		$datos= ['IMPORTE'=> $TOTAL_IMPORTE, 'DEUDOR'=>$DEUDOR, 'IDCOBRO'=>$id_cobro,
		 'CONCEPTO'=>$CONCEPTO,'FECHA_L'=> $FECHA_L ];
		$recibo= new Recibo_model();
		$recibo->insert($datos);
		$db = \Config\Database::connect();
		$id_recibo= $db->insertID();
		return $id_recibo;
	}


	public function mostrarRecibo( $id_recibo){
		$ReciboObj= new Recibo_model();
        $recibo= $ReciboObj->find( $id_recibo);
      
			$IMPORTE=  $recibo->IMPORTE;
			$deudor= (new Deudor_model())->find( $recibo->DEUDOR );
            $TITULAR= $deudor->NOMBRES." ".$deudor->APELLIDOS;
            $IMPORTEL= (new NumeroALetras())->toWords( $IMPORTE);
            $CONCEPTO= $recibo->CONCEPTO;
            $FECHAL=  $recibo->FECHA_L;
            
			echo  view("prestamo/recibo",
			[ 'NRORECIBO'=> $id_recibo, 'IMPORTE'=> $IMPORTE, 'IMPORTE_LETRAS'=>$IMPORTEL, "CLIENTE"=> $TITULAR , 
           "FECHA_LETRAS"=>$FECHAL, "CONCEPTO"=>$CONCEPTO]);     
        
       
    }

	public function cobro( $id_prestamo =""){

		if ($this->request->getMethod() === 'post' )
		{
			$cobro= $this->request->getPost("CABECERA"); 
		
			//Actualizar estado de prestamo a Aprobado
			//Generar las cuotas
			$db = \Config\Database::connect();

			$cobr= new Cobro_model(); 
			$db->transStart();
			$id_cobro= $cobr->cobrar();
			$cobr->cobrar_cuotas();
		
			$db->transComplete();	
			 
			if(  $db->transStatus())
			{
				//generar recibo
				$id_recibo=  $this->generar_recibo( $id_cobro);
				echo json_encode( array("print"=> $id_recibo )  );
				//return redirect()->to(base_url("prestamo/index")); 
			}
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
			/***Cuotas */
			$cuotas= $prestamo_m->obtener_cuotas(  $id_prestamo); 
		 
			echo view("prestamo/cobro",
			 ["deudor"=>$deudor, "prestamo_dato"=>$prestamo, "monto"=> $catemonto, "cuotas"=>$cuotas]);	
		}
	}



	public function error_alert(){
		echo json_encode( ['error'=> "Ocurrió un error en el servidor, no se han concretado las transacciones"]);
	}



//COBROS REALIZADOS
	public function informes_cobros( $FORMATO= "HTML"){
		//HTML
		//JSON
		//PDF
		$cobro= NULL;

		if($FORMATO=="HTML")
		$cobro= new Cobro_model();

		if($FORMATO=="PDF" || $FORMATO=="JSON")
		{
			$db      = \Config\Database::connect();
			$cobro = $db->table('cobro');
		}

		$cobro= $cobro->select("FECHA, (EFECTIVO_T+CHEQUE_IMPO+TARJE_IMPO) AS TOTAL, CONCAT(deudor.NOMBRES,CONCAT(' ', deudor.APELLIDOS)) AS CLIENTE,
		CONCAT(funcionario.NOMBRES,CONCAT(' ', funcionario.APELLIDOS)) AS CAJERO,  
		EFECTIVO_T AS EFECTIVO, CHEQUE_IMPO AS CHEQUE,TARJE_IMPO AS TARJETA, CAJA")
		->join('deudor', 'deudor.IDNRO = cobro.DEUDOR')
		->join('funcionario', 'funcionario.IDNRO = cobro.CAJERO');

		if ($this->request->getMethod() === 'post' )
		{
			$desde= $this->request->getPost("Desde"); 
			$hasta= $this->request->getPost("Hasta"); 
			if( $desde !=""  &&  $hasta != "")
			$cobro->where("FECHA >=", $desde)->where("FECHA <=", $hasta);
			
 

			if( $this->request->isAJAX()) 
			{
				if( $FORMATO == "HTML")
				{$pager= $cobro->paginate(15); 
				echo view("prestamo/informes/informe_grilla", ['lista'=>  $pager, 'enlaces'=> $cobro->pager]);}
				if($FORMATO=="JSON")
				echo json_encode(  $cobro->get()->getResultArray() );
			}
			else
			{ 
				if( $FORMATO == "PDF")
				$this->generar_pdf( $cobro->get()->getResultObject() );
				if( $FORMATO == "HTML")
				{
					$pager= $cobro->paginate(15); 
					echo view("prestamo/informes/informes", ['lista'=>  $pager, 'enlaces'=> $cobro->pager]);
				}
				
			}
		}
		else{

			$pager= $cobro->paginate(15); 
			echo view("prestamo/informes/informes", ['lista'=>  $pager, 'enlaces'=> $cobro->pager]);
		}
	}





	//CUOTAS ATRASADAS
	public function informes_cuotas( $FORMATO= "HTML"){
		//HTML
		//JSON
		//PDF
		$cobro= NULL;

		if($FORMATO=="HTML")
		$cobro= new Cuotas_model();

		if($FORMATO=="PDF" || $FORMATO=="JSON")
		{
			$db      = \Config\Database::connect();
			$cobro = $db->table('cuotas_prestamo');
		}

		$cobro= $cobro->select("MONTO_APROBADO AS CAPITAL, NUMERO, MONTO AS CUOTA, VENCIMIENTO,
		 IF(  FECHA_PAGO IS NULL, '', FECHA_PAGO) AS FECHA_PAGO  , CONCAT(deudor.NOMBRES,CONCAT(' ', deudor.APELLIDOS)) AS CLIENTE,
		IF( DATEDIFF(VENCIMIENTO,NOW() )>0  , concat('Faltan ',  concat( DATEDIFF(VENCIMIENTO,NOW() )  , ' dia(s)')  )     ,  IF( DATEDIFF(VENCIMIENTO,NOW() ) = 0, 'VENCE HOY', concat( abs( DATEDIFF(VENCIMIENTO,NOW() )) ,  ' dias de atraso'))    )  AS ESTADO,
		(MONTO-(select IFNULL(sum(IMPORTE),0) from detalle_cobro where detalle_cobro.IDCUOTA=cuotas_prestamo.IDNRO)) AS SALDO")
		->join('cobro', 'cuotas_prestamo.IDPRESTAMO = cobro.IDNRO')
		->join('prestamo', 'prestamo.IDNRO = cuotas_prestamo.IDPRESTAMO')
		->join('deudor', 'deudor.IDNRO = cobro.DEUDOR')
		->join('funcionario', 'funcionario.IDNRO = cobro.CAJERO')
		->where("cuotas_prestamo.ESTADO", "P");

		if ($this->request->getMethod() === 'post' )
		{
			//por fecha
			$desde= $this->request->getPost("Desde"); 
			$hasta= $this->request->getPost("Hasta"); 
			if( $desde !=""  &&  $hasta != "")
			$cobro= $cobro->where("VENCIMIENTO >=", $desde)->where("VENCIMIENTO <=", $hasta);
			

			//por situacion de cuota: todas T, vencidas S, no vencidas N
			$modo= $this->request->getPost("vencidas"); 
			if( !($desde !=""  &&  $hasta != "") && $modo=="N")
			$cobro= $cobro->where("DATEDIFF(VENCIMIENTO, NOW()) >", 0);
			if( !($desde !=""  &&  $hasta != "") && $modo=="S")
			$cobro= $cobro->where("DATEDIFF(VENCIMIENTO, NOW()) <=", 0);

			if( $this->request->isAJAX()) 
			{
				if( $FORMATO == "HTML")
				{$pager= $cobro->paginate(15); 
				echo view("prestamo/informes/cuotas_grilla", ['lista'=>  $pager, 'enlaces'=> $cobro->pager]);}
				if($FORMATO=="JSON")
				echo json_encode(  $cobro->get()->getResultArray() );
			}
			else
			{ 
				if( $FORMATO == "PDF")
				$this->generar_pdf( $cobro->get()->getResultObject() , "CUOTAS ");
				if( $FORMATO == "HTML")
				{
					$pager= $cobro->paginate(15); 
					echo view("prestamo/informes/cuotas", ['lista'=>  $pager, 'enlaces'=> $cobro->pager]);
				}
				
			}
		}
		else{

			$pager= $cobro->paginate(15); 
			echo view("prestamo/informes/cuotas", ['lista'=>  $pager, 'enlaces'=> $cobro->pager]);
		}
	}




	public function generar_html( $lista ){
		$html= <<<EOF
		<style> 
			.numero{
				width: 60px;
			}
			.cuota, .capital,.saldo{
				width: 70px;
			}
			.vencimiento,.fecha_pago{
				width: 70px;
			}
			.fecha{
				width:55px;
			}
			.total{
				width:60px;
				text-align: right;
			}
			.cliente{ 
				width: 125px;
			} 
			.cajero{ 
				width: 125px;
			} 
			.caja{
				width: 40px;
			}
			tr.cabecera{
				font-size: 6pt;
				background-color: #c2fcca;
				font-weight: bold;
			} 
			tr.cuerpo{
				color: #363636;
				font-size: 6PT;
				font-weight: bold;
			}
		 
		</style>
		<h6>COBROS</h6>
		<table class="tabla">
		<thead>
		EOF;
		//CABECERA
		foreach( $lista as $ite){
			$html.="<tr class=\"cabecera\">";
			foreach( $ite as  $clave=> $valor)
			{ 
				$clav= strtolower($clave);
				$html.="<th class=\"$clav\">$clave</th>";
			}
			$html.="</tr></thead><tbody>";break;
		}

		foreach( $lista as $ite){
			$html.="<tr class=\"cuerpo\">";
			foreach( $ite as  $clave=> $valor)
			{ 
				$clav= strtolower($clave);
				$nuevo_valor= $valor;
				if( $clave=="SALDO"  || $clave=="EFECTIVO" || $clave=="CHEQUE" || $clave=="TARJETA" || $clave=="CUOTA"  || $clave=="CAPITAL")
				$nuevo_valor= Utilidades::number_f($valor);
				if($clave=="FECHA" || $clave=="VENCIMIENTO"  )
				$nuevo_valor= Utilidades::fecha_f($valor);

				$html.="<td class=\"$clav\">$nuevo_valor</td>";
			}
			$html.="</tr>";
		}
		$html.= "</tbody></table>";
		return $html;
	}



	public function generar_pdf( $lista, $TITULO="COBROS - " ){
			$html= $this->generar_html($lista );
			$tituloDocumento= $TITULO.(date("d")."-".date("m")."-".date("yy"))."-".rand();
			//echo $html;
			$pdf = new PDF();
			//$pdf = new PDF(); 
			$pdf->prepararPdf("$tituloDocumento.pdf", $tituloDocumento, ""); 
			$pdf->generarHtml( $html);
			$pdf->generar();
	}


	public function test(){

		var_dump( $this->request->getPost("nome"));
	}
}
