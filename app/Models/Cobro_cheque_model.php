<?php namespace App\Models;

use CodeIgniter\Model;

class  Cobro_cheque_model extends Model
{
    
    protected $table = 'cobro_cheque';

    protected $primaryKey = 'IDNRO';

    protected $returnType     = 'object';/** */

    protected $allowedFields = 
    [ 'IDCOBRO','BANCO','NRO_CHEQUE','IMPORTE','OBS'];
    


    public function __construct()
    {
        parent::__construct();
        $this->db= \Config\Database::connect();
    }



}