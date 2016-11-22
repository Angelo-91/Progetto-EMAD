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
        $risultati = $manager->getAll();
        if($risultati!=null){
            $toRetutn = "";
            foreach ($risultati as $s){
                $toRetutn = $toRetutn.$s;
            }
            return new Response($toRetutn);
        }
        else {
            return new Response("Non ci sono elementi nella tabella partite");
        }
    }

    /**
     * @Route("/partite/{id}",name="allPartite")
     * @Method("GET")
     */
    public function getPartitaById($id){
        $managerPartite = new ManagerPartita();
        $risultato = $managerPartite->getPartitaById($id);
        if($risultato!=FALSE){
            return new Response($risultato);
        } else {
            return new Response("La partita con questo id: ".$id." non esiste");
        }
    }

    /**
     * @Route("/partite/getSquadraCasa/{sc}",name="allPartiteSquadraCasa")
     * @Method("GET")
     */
    public function getPartiteBySquadraCasa($sc){
        $managerPartite = new ManagerPartita();
        $risultato = $managerPartite->getPartitaBySquadraCasa($sc);
        if($risultato!=FALSE){
            $toRetutn = "";
            foreach ($risultato as $s){
                $toRetutn = $toRetutn.$s;
            }
            return new Response($toRetutn);
        } else {
            return new Response("Le partite con questa squadra: ".$sc." che gioca in casa non esiste");
        }
    }

    /**
     * @Route("/partite/getSquadraTrasferta/{st}",name="allPartiteSquadraTrasferta")
     * @Method("GET")
     */
    public function getPartiteBySquadraTrasferta($st){
        $managerPartite = new ManagerPartita();
        $risultato = $managerPartite->getPartitaBySquadraTrasferta($st);
        if($risultato!=FALSE){
            $toRetutn = "";
            foreach ($risultato as $s){
                $toRetutn = $toRetutn.$s;
            }
            return new Response($toRetutn);
        } else {
            return new Response("La partite con questa squadra: ".$st." che gioca in trasferta non esiste");
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
        if ($ris != FALSE) {
            return new Response("Inserimento avvenuto con successo");
        } else {
            return new Response("Problemi con l'inserimento");
        }
    }

    /**
     * @Route("/partite/cancellaPartita/{id}",name="cancellaPartita")
     * @Method("GET")
     */
    public function deletePartita($id){
        $managerPartite = new ManagerPartita();
        $ris = $managerPartite->deletePartita($id);
        if($ris!=FALSE){
            return new Response("Cancellazione di partita con questo id: ".$id." avvenuta con successo");
        } else {
            return new Response("La partita con questo id: ".$id." non esiste");
        }
    }

    /**
     * @Route("/partite/aggiornaPartita",name="aggiornaPartita")
     * @Method("POST")
     */
    public function aggiornaPartita(Request $req){
        $managerPartite = new ManagerPartita();
        $partita = new Partita();
        $id = $req->request->get("idPartita");
        $partita->setIdPartita($id);
        $partita->setSquadraCasa($req->request->get("squadraCasa"));
        $partita->setSquadraTrasferta($req->request->get("squadraTrasferta"));
        $partita->setRisultato($req->request->get("risultato"));
        $partita->setSquadreIdSquadre($req->request->get("squadraEsterna"));
        $ris = $managerPartite->aggiornaPartita($partita);
        if($ris!=null){
            return new Response("Aggiornamento della partita con questo id: ".$id." avvenuto con successo");
        } else {
            return new Response("La partita con questo id: ".$id." non esiste");
        }
    }
}