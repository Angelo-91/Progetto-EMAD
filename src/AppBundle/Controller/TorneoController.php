<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 20:06
 */

namespace AppBundle\Controller;
use AppBundle\Manager\ManagerTorneo;
use AppBundle\Model\Torneo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TorneoController extends Controller
{

    /**
     * @Route("/tornei/all",name="allTornei")
     * @Method("GET")
     */
    public function getAllTornei(){
        $manager = new ManagerTorneo();
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

    /**
     * @Route("/torneo/insert",name="torneoInsert")
     * @Method("POST")
     */
    public function insertTorneo(Request $req){
        $torneo = new Torneo();
        $manager = new ManagerTorneo();
        $torneo->setNomeTorneo($req->request->get("nome"));
        $risultati = $manager->insertTorneo($torneo);
        if($risultati!=null){
            return new Response("Inserimento OK");
        }
        else {
            return new Response("problemi");
        }
    }
}