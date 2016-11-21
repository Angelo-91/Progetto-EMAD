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
    public function giocatoriOfSquadra($idSquadra){

        $g=new ManagerGiocatore();
        $giocatori=$g->getGiocatoriByIdSquadra($idSquadra);
        if(count($giocatori)>0) {
            $response = "";
            foreach ($giocatori as $g)
                $response = $response . $g;

            return new Response($response);
        }
        else
            return new Response("nessun giocatore di questa squadra");




    }

    /**
     * @Route("/giocatore/insert",name="insertgiocatore")
     * @Method("POST")
     */
    public function insert(Request $re){
       // DA TESTARE un po di info non le ho messo nella query perche in automatico settate a 0
        $g=new Giocatore();
        $m=new ManagerGiocatore();
        $g->setNome($re->request->get("n"));
        $g->setCognome($re->request->get("c"));
        $g->setEmail($re->request->get("e"));
        $g->setDataDiNascita($re->request->get("d"));
        $g->setNazionalita($re->request->get("na"));
        $g->setRuolo($re->request->get("ru"));
        $g->setValore($re->request->get("v"));
        $g->setSquadreIdSquadre($re->request->get("i"));
        $g->setResidenza($re->request->get("re"));

        $pathFinal=Utility::loadFile("file","Giocatori");
        if($pathFinal!=null) {
            $g->setUrlImmagine($pathFinal);
            $m->insert($g);
            return new Response("giocatore inserito con id" . $re->request->get("i"));
        }
        else return new Response("problema nel caricare la foto");
    }
}