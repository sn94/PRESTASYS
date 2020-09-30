<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoggedUser implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        $session = \Config\Services::session();
        $request = \Config\Services::request();
         
        $uri = $request->uri;
        $no_accede_login= sizeof(  $uri->getSegments())>0  &&  $uri->getSegment(1) != "usuario" && $uri->getSegment(2)!= "sign_in";
        $accede_a_inicio=$uri->getSegment(0)=="/";
       if( !$session->has('NICK')  && ( $accede_a_inicio ||  $no_accede_login) )
       return redirect()->to(  base_url("usuario/sign_in")); 


       if(  !$session->has("APECAJA")  &&  (sizeof(  $uri->getSegments())>0  &&  $uri->getSegment(1) == "prestamo" && $uri->getSegment(2)== "cobro" ) )
       return redirect()->to(  base_url("apeciecaja/aviso_pedir_apertura"));

       if(  !$session->has("APECAJA")  &&  (sizeof(  $uri->getSegments())>0  &&  $uri->getSegment(1) == "apeciecaja" && $uri->getSegment(2)== "arqueo_cierre" ) )
       return redirect()->to(  base_url("apeciecaja/aviso_cant_close"));
   
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}