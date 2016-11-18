<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 08/11/2016
 * Time: 13:50
 */
namespace AppBundle\Controller;



use AppBundle\Manager\ManagerSquadra;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class SquadraController extends Controller
{
    /**
 * @Route("/squadra/all",name="allSquadre")
 * @Method("GET")
 */
    public function getAllSquadre(){

        $g=new ManagerSquadra();
        $squadre=$g->get();
        if($squadre!=null) {
            $response = "";
            foreach ($squadre as $s)
                $response = $response . $s;

            return new Response($response);
        }
        else{
            return new Response("problemi");
        }
    }
    /**
     * @Route("/squadra/{id}",name="squadra")
     * @Method("GET")
     */
    public function getSquadraById($id){

        $g=new ManagerSquadra();
        $squadra=$g->getById($id);
        if($squadra!=null)
            return new Response($squadra);
        else
            return new Response("non esiste la squadra cercata");



    }

/*commento*/


}