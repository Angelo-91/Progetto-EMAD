<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 19:59
 */

namespace AppBundle\Controller;


use AppBundle\Manager\ManagerPartita;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class PartitaController extends Controller
{

    /**
     * @Route("/partite/all",name="allPartite")
     * @Method("GET")
     */
    public function getAllPartite(){
        $manager = new ManagerPartita();
        $risultati = $manager->get();
        if($risultati!=null){
            $toRetutn = "";
            foreach ($risultati as $s){
                $toRetutn = $toRetutn.$s;
            }
            return new Response($toRetutn);
        }
        else {
            return new Response("problemi");
        }
    }
}