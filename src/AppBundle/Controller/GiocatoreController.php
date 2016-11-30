<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 08/11/2016
 * Time: 13:50
 */
namespace AppBundle\Controller;



use AppBundle\Manager\ManagerGiocatore;
use AppBundle\Manager\ManagerSquadra;
use AppBundle\Manager\ManagerUser;
use AppBundle\Model\Giocatore;
use AppBundle\Utility\Utility;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class GiocatoreController
 * @package AppBundle\Controller
 */
class GiocatoreController extends Controller
{
    /**
     * @Route("/giocatori/{idSquadra}",name="giocatori")
     * @Method("GET")
     */
    public function giocatoriOfSquadra($idSquadra)
    {

        $g = new ManagerGiocatore();
        $giocatori = $g->getGiocatoriByIdSquadra($idSquadra);
        if (count($giocatori) > 0) {
            $response = "{\"giocatori\":[";
            foreach ($giocatori as $g)
                $response = $response . $g.",";

            $response=$response."]}";
            $r=new Response($response);
            $r->headers->set('Content-Type', 'application/json');
            return $r;
        } else
            return new Response("nessun giocatore di questa squadra",404);


    }

    /**
     * @Route("/giocatore/insert",name="insertgiocatore")
     * @Method("POST")
     */
    //PROTETTO
    public function insert(Request $re)
{
    // DA TESTARE un po di info non le ho messo nella query perche in automatico settate a 0
    $g = new Giocatore();
    $m = new ManagerGiocatore();
    $mS = new ManagerSquadra();
    $mU=new ManagerUser();
    $squadra = $mS->getById($re->request->get("i"));
    if ($squadra != null) {
        if($mU->check($squadra->getIdSquadre())){
            $g->setNome($re->request->get("n"));
            $g->setCognome($re->request->get("c"));
            $g->setEmail($re->request->get("e"));
            $g->setDataDiNascita($re->request->get("d"));
            $g->setNazionalita($re->request->get("na"));
            $g->setRuolo($re->request->get("ru"));
            $g->setValore($re->request->get("v"));
            $g->setSquadreIdSquadre($re->request->get("i"));
            $g->setResidenza($re->request->get("re"));

            $pathFinal = Utility::loadFile("file", "Giocatori");
            if ($pathFinal != null) {
                $g->setUrlImmagine($pathFinal);
                $m->insert($g);
                return new Response("giocatore inserito con id" . $re->request->get("i"));
            } else return new Response("problema nel caricare la foto");
        }
        else return new Response("non hai accesso a questa risorsa",404);
    }
    else
        return new Response("vuoi inserire un giocatore a una squadra che non esiste",404);
}

    /**
     * @Route("/Dettagligiocatore/{id}",name="getGiocatoreId")
     * @Method("GET")
     */
    public function getGiocatoreById($id)
    {
        $m = new ManagerGiocatore();
        $g = $m->getGiocatoreById($id);
        if ($g != null) {
            $r=new Response($g);
            $r->headers->set('Content-Type', 'application/json');
            return $r;
        } else {
            return new Response("Il giocatore con questo id: " . $id . " non esiste",404);
        }
    }

    /**
     * @Route("/giocatori/elimina/{id}",name="eliminagiocatore")
     * @Method("GET")
     */
    //PROTETTO
    public function deleteGiocatoreById($id)
    {

        $m = new ManagerGiocatore();
        $mU=new ManagerUser();
        $g=$m->getGiocatoreById($id);
        if($g!=null){
            if($mU->check($g->getSquadreIdSquadre())){
                $url = $m->delete($id);
                if ($url != null)
                    return new Response("eliminato il giocatore  con id:" . $id);
            }
            else return new Response("non hai accesso a questa risorsa",404);
        } else
            return new Response("nessun giocatore da eliminare con id: " . $id,404);

    }

    /**
     * @Route("/giocatore/aggiorna",name="aggiornaGiocatore")
     * @Method("POST")
     */
    //PROTETTO
    public function aggiornaGiocatore(Request $req)
    {
        $mN = new ManagerGiocatore();
        $mU=new ManagerUser();
        $giocatore = $mN->getGiocatoreById($req->request->get("i"));
        if ($giocatore != null) {
            if($mU->check($giocatore->getSquadreIdSquadre())){
                $giocatore->setNome($req->request->get("n"));
                $giocatore->setCognome($req->request->get("c"));
                $giocatore->setGolFatti($req->request->get("gF"));
                $giocatore->setGolSubiti($req->request->get("gS"));
                $giocatore->setAssist($req->request->get("a"));
                $giocatore->setAmmonizioni($req->request->get("am"));
                $giocatore->setEspulsioni($req->request->get("es"));
                $giocatore->setPresenze($req->request->get("pre"));
                $giocatore->setRuolo($req->request->get("ru"));
                $giocatore->setValore($req->request->get("val"));
                $giocatore->setResidenza($req->request->get("res"));
                $giocatore->setNazionalita($req->request->get("naz"));
                $giocatore->setEmail($req->request->get("email"));
                $giocatore->setDataDiNascita($req->request->get("dat"));
                $giocatore->setCapitano($req->request->get("cap"));
                $giocatore->setNumeroMaglia($req->request->get("num"));
                $giocatore->setDataDiNascita($req->request->get("dat"));
                $giocatore->setSquadreIdSquadre($req->request->get("i"));


                $pathFinal = Utility::loadFile("file", "Giocatori");
                if ($pathFinal != null) {
                    $urlEsistente = $giocatore->getUrlImmagine();
                    if (strcmp($urlEsistente, $pathFinal) != 0) {
                        $url = "../web/immaginiApp/Giocatori/" . $urlEsistente;
                        unlink($url);
                        $giocatore->setUrlImmagine($pathFinal);
                        if ($mN->aggiornaGiocatore($giocatore) != null)
                            return new Response("giocatore modificato");
                        else return new Response("modifica non riuscita");
                    }
                } else return new Response("problema nel modificare la foto");
            }
            else return new Response("non hai accesso a questa risorsa",404);

        }
        return new Response("non esiste questo giocatore",404);
    }
}