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
use AppBundle\Manager\ManagerUser;
use AppBundle\Model\Formazione;
use AppBundle\Model\User;
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
    //PROTETTO
    public function insert(Request $re)
    {
        // DA TESTARE un po di info non le ho messo nella query perche in automatico settate a 0
        $f = new Formazione();
        $mF = new ManagerFormazione();
        $mP = new ManagerPartita();
        $mG= new ManagerGiocatore();
        $f=new Formazione();
        $uM=new ManagerUser();
        $giocatore=$mG->getGiocatoreById($re->request->get("gi"));
        $partita=$mP->getPartitaById($re->request->get("pa"));

        if ($giocatore!=null AND $partita!=false) {
            if($uM->check($giocatore->getSquadreIdSquadre()) && $uM->check($partita->getSquadreIdSquadre()))
                {
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
                    return new Response("dati giocatore per quella partita  non inseriti",404);
            }
            else return new Response("non hai accesso a questa risorsa",404);

        } else
            return new Response("partita o giocatore non esiste",404);
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
    //PROTETTO
    public function deleteFormazioniByIdPartita($id){

        $m=new ManagerFormazione();
        $uM=new ManagerUser();
        $mP=new ManagerPartita();
        $pa=$mP->getPartitaById($id);
        if($pa){if($uM->check($pa->getSquadreIdSquadre())){
            $p=$m->deleteFormazioniById($id);
            if($p==null)
                return new Response("nessuna formazione da eliminare con id: ".$id,404);
            else
                return new Response("eliminate le formazioni  con id-partita: ".$id);
        }
        else return new Response("non hai accesso a questa risorsa",404);
        }else return new Response("nessuna risorsa",404);


    }

    /**
     * @Route("/formazione/aggiorna",name="aggiornaFormazione")
     * @Method("POST")
     */
    //PROTETTO
    public function aggiornaFormazione(Request $re){
        $mF = new ManagerFormazione();
        $mP=new ManagerPartita();
        $mG=new ManagerGiocatore();
        $mU=new ManagerUser();
        $f=new Formazione();
        $p=$mP->getPartitaById($re->request->get("part"));
        $g=$mG->getGiocatoreById($re->request->get("gio"));
        if($p!=null AND $g!=null ){
            if($mU->check($g->getSquadreIdSquadre()) && $mU->check($p->getSquadreIdSquadre())){
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
            else return new Response("non hai accesso a questa risorsa",404);
        }
        else return new Response("non esiste la formazione che vuoi modificare",404);
    }

}