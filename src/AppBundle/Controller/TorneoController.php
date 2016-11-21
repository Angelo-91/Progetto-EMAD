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
    /**
     * @Route("/torneo/delete/{nome}",name="torneoDelete")
     * @Method("GET")
     */
    public function deleteTorneo ($nome){
        $managerTorneo = new ManagerTorneo();
        $daEliminare = $managerTorneo->getTorneoByNome($nome);
        if($daEliminare==null){
            return new Response("Non è possibile eliminare un torneo con questo nome ".$nome." perchè non esiste");
        } else {
            $managerTorneo->deleteTorneo($daEliminare);
            return new Response("Torneo: ".$nome." eliminato correttamente");
        }
    }


    /**
     * @Route("/torneo/update",name="torneoInsert")
     * @Method("POST")
     */
    public function updateTorneo(Request $req){
        $managerTorneo = new ManagerTorneo();
        $nomeOriginale = $req->request->get("nomeOriginale");
        $nomeNuovo = $req->request->get("nomeNuovo");
        $daUppare = $managerTorneo->getTorneoByNome($nomeOriginale);
        if($daUppare==null){
            return new Response("Non è possibile modificare un torneo con questo nome ".$nomeOriginale." perchè non esiste");
        } else {
            $managerTorneo->updateTorneo($nomeOriginale, $nomeNuovo);
            return new Response("Torneo: ".$nomeOriginale." aggiornato in: ".$nomeNuovo);
        }
    }

}