<?php namespace App\Models;

use CodeIgniter\Model;

class  Deudor_model extends Model
{
    
    protected $table = 'deudor';

    protected $primaryKey = 'IDNRO';

    protected $returnType     = 'object';/** */

    protected $allowedFields = 
    ['CEDULA','NOMBRES','APELLIDOS','DOMICILIO','TELEFONO','CELULAR','CIUDAD','CEDU_ANVERSO','CEDU_REVERSO',
    'OCUPACION','DOMICILIO_LABO','TELEFONO_LABO','CEDULA_CONYU','CONYUGE','FECHA_NAC','created_at','updated_at'];
    


    public function __construct()
    {
        parent::__construct();
        $this->db= \Config\Database::connect();
    }





    public function  info_creditos_de_deudores(){
     $data=  $this->db->table("deudor")
     ->select("deudor.IDNRO, deudor.CEDULA, concat(deudor.NOMBRES, concat(' ',deudor.APELLIDOS)) as NOMBRES, deudor.CIUDAD,deudor.TELEFONO, (select count(prestamo.IDNRO) from prestamo where DEUDOR=deudor.IDNRO) as CREDITOS,deudor.created_at as REGISTRO")
     ->orderBy("created_at", "DESC")
    ->get()->getResultObject();
     return $data;
    }
}