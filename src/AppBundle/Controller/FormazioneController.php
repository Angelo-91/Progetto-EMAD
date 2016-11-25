<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 08/11/2016
 * Time: 13:50
 */
namespace AppBundle\Controller;



use AppBundle\Manager\ManagerFormazione;

use AppBundle\Manager\ManagerGiocatore;
use AppBundle\Manager\ManagerPartita;
use AppBundle\Model\Formazione;
use AppBundle\Utility\Utility;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class FormazioneController
 * @package AppBundle\Controller
 */
class FormazioneController extends Controller
{


    /**
     * @Route("/formazione/insert",name="insertformazione")
     * @Method("POST")
     */
    public function insert(Request $re)
    {
        // DA TESTARE un po di info non le ho messo nella query perche in automatico settate a 0
        $f = new Formazione();
        $mF = new ManagerFormazione();
        $mP = new ManagerPartita();
        $mG= new ManagerGiocatore();
        $f=new Formazione();
        $giocatore=$mG->getGiocatoreById($re->request->get("gi"));
        $partita=$mP->getPartitaById($re->request->get("pa"));

        if ($giocatore!=null AND $partita!=false) {
            $f->setGiocatoriIdGiocatori($re->request->get("gi"));
            $f->setPartiteIdPartita($re->request->get("pa"));
            $f->setAmmonizioni($re->request->get("am"));
            $f->setAssist($re->request->get("as"));
            $f->setEspulsioni($re->request->get("es"));
            $f->setGolFatti($re->request->get("gF"));
            $f->setGolSubiti($re->request->get("gS"));
            $f->setRuolo($re->request->get("ru"));
            $f->setVotoPersonale($re->request->get("v"));
            $f->setMinutiGiocati($re->request->get("min"));
            $re=$mF->insert($f);
            if($re!=null)
                return new Response("dati giocatore per quella partita inserita");
             else
                 return new Response("dati giocatore per quella partita  non inseriti");

        } else
            return new Response("partita o giocatore non esiste");
    }

    /**
     * @Route("/formazione/partita/{id}",name="getPId")
     * @Method("GET")
     */
    public function getFormazioneByIdSquadra($id){
        $m=new ManagerFormazione();
        $toReturn="";
        $statistiche = $m->getFormazioneConDatiGiocatore($id);
        if($statistiche!=null){
            foreach ($statistiche as $s)
                $toReturn=$toReturn.$s;

            return new Response($toReturn);
        } else {
            return new Response("La partita con questo id: ".$id." non esiste");
        }
    }

    /**
     * @Route("/formazione/elimina/{id}",name="eliminaFormazioniByPartita")
     * @Method("GET")
     */
    public function deleteFormazioniByIdPartita($id){

        $m=new ManagerFormazione();
        $p=$m->deleteFormazioniById($id);
        if($p==null)
            return new Response("nessuna formazione da eliminare con id: ".$id);
        else
            return new Response("eliminate le formazioni  con id-partita: ".$id);
    }

    /**
     * @Route("/formazione/aggiorna",name="aggiornaFormazione")
     * @Method("POST")
     */
    public function aggiornaFormazione(Request $re){
        $mF = new ManagerFormazione();
        $mP=new ManagerPartita();
        $mG=new ManagerGiocatore();
        $f=new Formazione();
        $p=$mP->getPartitaById($re->request->get("part"));
        $g=$mG->getGiocatoreById($re->request->get("gio"));
        if($p!=null AND $g!=null ){
            $f->setGiocatoriIdGiocatori($re->request->get("gio"));
            $f->setPartiteIdPartita($re->request->get("part"));
            $f->setAmmonizioni($re->request->get("am"));
            $f->setAssist($re->request->get("as"));
            $f->setEspulsioni($re->request->get("es"));
            $f->setGolFatti($re->request->get("gF"));
            $f->setGolSubiti($re->request->get("gS"));
            $f->setRuolo($re->request->get("ru"));
            $f->setVotoPersonale($re->request->get("v"));
            $f->setMinutiGiocati($re->request->get("min"));
            $mF->aggiornaFormazione($f);
            return new Response("formazione  modificata");
        }
        else return new Response("non esiste la formazione che vuoi modificare");
    }

}