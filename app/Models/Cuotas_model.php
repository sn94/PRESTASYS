<?php namespace App\Models;

use CodeIgniter\Model;

class Cuotas_model extends Model
{
    
    protected $table = 'cuotas_prestamo';

    protected $primaryKey = 'IDNRO';

    protected $returnType     = 'object';/** */

    protected $allowedFields = 
    [ 'IDPRESTAMO','MONTO','VENCIMIENTO','FECHA_PAGO','ESTADO'];
    


    public function __construct()
    {
        parent::__construct();
        $this->db= \Config\Database::connect();
    }



}