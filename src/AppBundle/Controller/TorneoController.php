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
        $risultati = $manager->getAll();
        if($risultati!=FALSE){
            $toReturn = "{\"torneo\":[";
            foreach ($risultati as $s){
                $toReturn = $toReturn.$s.",";
            }
            $toReturn=$toReturn."]}";
            $re = new Response($toReturn);
            $re->headers->set('Content-Type', 'application/json');
            return $re;
        }
        else {
            return new Response("Non sono presenti elementi all'interno della tabella Tornei",404);
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
        if($risultati!=FALSE){
            return new Response("Inserito il torneo: ".$torneo->getNomeTorneo()." nella tabella Tornei");
        }
        else {
            return new Response("Problemi con l'inserimento",404);
        }
    }
    /**
     * @Route("/torneo/delete/{id}",name="torneoDelete")
     * @Method("GET")
     */
    public function deleteTorneo ($id){
        $managerTorneo = new ManagerTorneo();
        $daEliminare = $managerTorneo->getTorneoById($id);
        if($daEliminare==FALSE){
            return new Response("Non è possibile eliminare un torneo con questo nome ".$id." perchè non esiste");
        } else {
            $managerTorneo->deleteTorneo($id);
            return new Response("Torneo: ".$id." eliminato correttamente",404);
        }
    }


    /**
     * @Route("/torneo/update",name="torneoUpdate")
     * @Method("POST")
     */
    public function updateTorneo(Request $req){
        $managerTorneo = new ManagerTorneo();
        $nomeOriginale = $req->request->get("nomeOriginale");
        $nomeNuovo = $req->request->get("nomeNuovo");
        $risultato = $managerTorneo->updateTorneo($nomeOriginale, $nomeNuovo);
        if($risultato==FALSE){
            return new Response("Non è possibile modificare un torneo con questo nome ".$nomeOriginale." perchè non esiste");
        } else {
            return new Response("Torneo: ".$nomeOriginale." aggiornato in: ".$nomeNuovo,404);
        }
    }

    /**
     * @Route("/torneo/get/{id}",name="torneoGetById")
     * @Method("GET")
     */
    public function getTorneoById($id){
        $managerTorneo = new ManagerTorneo();
        $risultato = $managerTorneo->getTorneoById($id);
        if($risultato!=FALSE){
            $re = new Response($risultato);
            $re->headers->set('Content-type','application/json');
            return $re;
        } else {
            return new Response("Hai cercato un id ".$id." torneo non esistente",404);
        }
    }

    /**
     * @Route("/torneo/getByNome/{nome}",name="torneoGetByNome")
     * @Method("GET")
     */
    public function getTorneoByNome($nome){
        $managerTorneo = new ManagerTorneo();
        $risultato = $managerTorneo->getTorneoByNome($nome);
        if($risultato!=FALSE){
            $re = new Response($risultato);
            $re->headers->set('Content-type','application/json');
            return $re;
        } else {
            return new Response("Hai cercato torneo (".$nome.") non esistente",404);
        }
    }
}