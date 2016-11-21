<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 19:59
 */

namespace AppBundle\Controller;


use AppBundle\Manager\ManagerPartita;
use AppBundle\Model\Partita;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PartitaController extends Controller
{

    /**
     * @Route("/partiteAll",name="tutteLePartite")
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

    /**
     * @Route("/partite/{id}",name="allPartite")
     * @Method("GET")
     */
    public function getPartitaById($id){
        $managerPartite = new ManagerPartita();
        $risultato = $managerPartite->getPartitaById($id);
        if($risultato!=null){
            return new Response($risultato);
        } else {
            return new Response("La partita con questo id: ".$id." non esiste");
        }
    }

    /**
     * @Route("/partite/getSquadraCasa/{id}",name="allPartiteSquadraCasa")
     * @Method("GET")
     */
    public function getPartiteBySquadraCasa($id){
        $managerPartite = new ManagerPartita();
        $risultato = $managerPartite->getPartitaBySquadraCasa($id);
        if($risultato!=null){
            $toRetutn = "";
            foreach ($risultato as $s){
                $toRetutn = $toRetutn.$s;
            }
            return new Response($toRetutn);
        } else {
            return new Response("La partita con questo id: ".$id." non esiste");
        }
    }

    /**
     * @Route("/partite/getSquadraTrasferta/{id}",name="allPartiteSquadraCasa")
     * @Method("GET")
     */
    public function getPartiteBySquadraTrasferta($id){
        $managerPartite = new ManagerPartita();
        $risultato = $managerPartite->getPartitaBySquadraTrasferta($id);
        if($risultato!=null){
            $toRetutn = "";
            foreach ($risultato as $s){
                $toRetutn = $toRetutn.$s;
            }
            return new Response($toRetutn);
        } else {
            return new Response("La partita con questo id: ".$id." non esiste");
        }
    }

    /**
     * @Route("/partite/inserisciPartita",name="inserisciPartita")
     * @Method("POST")
     */
    public function insertPartita(Request $req){
        $partita = new Partita();
        $managerPartita = new ManagerPartita();
        $squadraCasa = $req->request->get("squadraCasa");
        $squadraTrasferta = $req->request->get("squadraTrasferta");
        $partita->setSquadraCasa($squadraCasa);
        $partita->setSquadraTrasferta($squadraTrasferta);
        $partita->setRisultato($req->request->get("risultato"));
        $partita->setSquadreIdSquadre($req->request->get("squadraEsterna"));
        $ris = $managerPartita->insertPartita($partita);
        if ($ris != null) {
            return new Response("Inserimento avvenuto con successo");
        } else {
            return new Response("Problemi con l'inserimento");
        }
    }

    /**
     * @Route("/partite/cancellaPartita/{id}",name="inserisciPartita")
     * @Method("GET")
     */
    public function deletePartita($id){
        $managerPartite = new ManagerPartita();
        $ris = $managerPartite->deletePartita($id);
        if($ris!=null){
            return new Response("Cancellazione di partita con questo id: ".$id." avvenuta con successo");
        } else {
            return new Response("Problemi con la cancellazione");
        }
    }

    /**
     * @Route("/partite/aggiornaPartita",name="aggiornaPartita")
     * @Method("POST")
     */
    public function aggiornaPartita(Request $req){
        $managerPartite = new ManagerPartita();
        $partita = new Partita();
        $partita->setIdPartita($req->request->get("idPartita"));
        $partita->setSquadraCasa($req->request->get("squadraCasa"));
        $partita->setSquadraTrasferta($req->request->get("squadraTrasferta"));
        $partita->setRisultato($req->request->get("risultato"));
        $partita->setSquadreIdSquadre($req->request->get("squadraEsterna"));
        $ris = $managerPartite->aggiornaPartita($partita);
        if($ris!=null){
            return new Response("Aggiornamento avvenuto con successo");
        } else {
            return new Response("Problemi con l'aggiornamento");
        }
    }
}