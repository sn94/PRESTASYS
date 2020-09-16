<?php namespace App\Models;

use CodeIgniter\Model;

class  Cobro_tarjeta_model extends Model
{
    
    protected $table = 'cobro_tarjeta';

    protected $primaryKey = 'IDNRO';

    protected $returnType     = 'object';/** */

    protected $allowedFields = 
    [ 'IDCOBRO','TIPO','OBS','IMPORTE'];
    


    public function __construct()
    {
        parent::__construct();
        $this->db= \Config\Database::connect();
    }



}