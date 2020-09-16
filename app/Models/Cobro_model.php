<?php namespace App\Models;

use CodeIgniter\Model;

class  Cobro_model extends Model
{
    
    protected $table = 'cobro';

    protected $primaryKey = 'IDNRO';

    protected $returnType     = 'object';/** */

    protected $allowedFields = 
    ['FECHA','CAJERO','DEUDOR','CAJA','EFECTIVO_T','CHEQUE_T','TARJETA_T','ESTADO','IDPRESTAMO'];
    


    public function __construct()
    {
        parent::__construct();
        $this->db= \Config\Database::connect();
        $this->request = \Config\Services::request();
    }



    public function  cobrar_cuotas(){
        $cobro= $this->request->getPost("CABECERA");
        $id_prestamo= $cobro['IDPRESTAMO'];
        $this->transStart();
        //Cabecera
        $this->insert(  $cobro  );
        //Detalles
        $id_cobro= $this->insertID();
        $id_cuotas_marcadas= $this->request->getPost("ESTADO");
        //Actualizar estado de cuotas
        foreach( $id_cuotas_marcadas as $cuota){
            $LA_CUOTA=$this->db->table('cuotas_prestamo')
            ->set("ESTADO", "C")
            ->where("IDPRESTAMO", $id_prestamo)
            ->where("IDNRO", $cuota);
           $LA_CUOTA->update();

             //guardar detalle de cobro
            $monto_cuota= $LA_CUOTA->get()->getFirstRow()->MONTO;
            $this->db->table('detalle_cobro')->insert([ 'IDCOBRO'=>$id_cobro, 'IDCUOTA'=> $cuota, 'IMPORTE'=> $monto_cuota]);
       }
       //YA SE HA COBRADO LA TOTALIDAD DE CUOTAS?
       $cuotas_model= new Cuotas_model();
       $BuilderCuota=$cuotas_model->builder();
       $TotalCuotas=  $BuilderCuota->where("IDPRESTAMO", $id_prestamo)->countAllResults();//NUMERO DE CUOTAS
       $TotalCuotasCobradas=  $BuilderCuota->where("IDPRESTAMO", $id_prestamo)->where("ESTADO", "C")->countAllResults();//NUMERO DE CUOTAS
       if( $TotalCuotas == $TotalCuotasCobradas )
            $this->db->table("prestamo")->set("ESTADO" , "L")->where("IDNRO", $id_prestamo)->update();
        $this->transComplete();	
        return $this->transStatus();

         
            
    }

}