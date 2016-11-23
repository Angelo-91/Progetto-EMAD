<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 19:22
 */

namespace AppBundle\Controller;

use AppBundle\Model\Partecipazione;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Manager\ManagerPartecipazione;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PartecipazioneController extends Controller
{

    /**
     * @Route("/partecipazioni/all",name="allPartecipazioni")
     * @Method("GET")
     */
    public function getAllPartecipazioni(){
        $manager = new ManagerPartecipazione();
        $risultati = $manager->getAll();
        if($risultati!=FALSE){
            $toRetutn = "";
            foreach ($risultati as $s){
                $toRetutn = $toRetutn.$s;
            }
            return new Response($toRetutn);
        }
        else {
            return new Response("Non ci sono elementi nella tabella partecipazioni");
        }
    }

    /**
     * @Route("/partecipazioni/bySquadra/{id}",name="getPartecipazioniBySquadra")
     * @Method("GET")
     */
    public function getPartecipazioniBySquadra($id){
        $manager = new ManagerPartecipazione();
        $risultato = $manager->getPartecipazioniBySquadra($id);
        if($risultato!=FALSE){
            $toRetutn = "";
            foreach ($risultato as $s){
                $toRetutn = $toRetutn.$s;
            }
            return new Response($toRetutn);
        } else {
            return new Response("La partecipazione con questo id squadra: ".$id." non esiste");
        }
    }


    /**
     * @Route("/partecipazioni/byTorneo/{id}",name="getPartecipazioniByTorneo")
     * @Method("GET")
     */
    public function getPartecipazioniByTorneo($id){
        $manager = new ManagerPartecipazione();
        $risultato = $manager->getPartecipazioniByTorneo($id);
        if($risultato!=FALSE){
            $toRetutn = "";
            foreach ($risultato as $s){
                $toRetutn = $toRetutn.$s;
            }
            return new Response($toRetutn);
        } else {
            return new Response("La partecipazione con questo id torneo: ".$id." non esiste");
        }
    }

    /**
     * @Route("/partecipazioni/inserisci",name="inserisciPart")
     * @Method("POST")
     */
    public function inserisciPartecipazione(Request $req){
        $manager = new ManagerPartecipazione();
        $part = new Partecipazione();
        $part->setIdSquadre($req->request->get("idSquadra"));
        $part->setIdTornei($req->request->get("idTorneo"));
        $part->setPunteggio($req->request->get("punteggio"));
        $part->setVittorie($req->request->get("vittorie"));
        $part->setPareggi($req->request->get("pareggi"));
        $part->setSconfitte($req->request->get("sconfitte"));
        $risultato = $manager->inserisciPartecipazione($part);
        if($risultato!=FALSE){
            return new Response("Partecipazione inserita correttamente");
        } else {
            return new Response("La partecipazione con questo id torneo: ".$part->getIdTornei()." o con questo id squadra: ".$part->getIdSquadre()." non esiste");
        }
    }


    /**
     * @Route("/partecipazioni/aggiorna",name="aggiornaPart")
     * @Method("POST")
     */
    public function aggiornaPartecipazione(Request $req){
        $manager = new ManagerPartecipazione();
        $part = new Partecipazione();
        $part->setIdSquadre($req->request->get("idSquadra"));
        $part->setIdTornei($req->request->get("idTorneo"));
        $part->setPunteggio($req->request->get("punteggio"));
        $part->setVittorie($req->request->get("vittorie"));
        $part->setPareggi($req->request->get("pareggi"));
        $part->setSconfitte($req->request->get("sconfitte"));
        $risultato = $manager->aggiornaPartecipazione($part);
        if($risultato!=FALSE){
            return new Response("Partecipazione modificata correttamente");
        } else {
            return new Response("La partecipazione con questo id torneo: ".$part->getIdTornei()." o con questo id squadra: ".$part->getIdSquadre()." non esiste");
        }
    }


    /**
     * @Route("/partecipazioni/elimina",name="eliminaPart")
     * @Method("POST")
     */
    public function eliminaPartecipazione(Request $req){
        $manager = new ManagerPartecipazione();
        $part = new Partecipazione();
        $part->setIdSquadre($req->request->get("idSquadra"));
        $part->setIdTornei($req->request->get("idTorneo"));
        $risultato = $manager->eliminaPartecipazione($part);
        if($risultato!=FALSE){
            return new Response("Partecipazione eliminata correttamente");
        } else {
            return new Response("La partecipazione con questo id torneo: ".$part->getIdTornei()." o con questo id squadra: ".$part->getIdSquadre()." non esiste");
        }
    }



}