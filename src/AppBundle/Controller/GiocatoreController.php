<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 08/11/2016
 * Time: 13:50
 */
namespace AppBundle\Controller;

use AppBundle\Entity\Giocatore;
use AppBundle\Entity\Persona;
use AppBundle\Manager\GestioneGiocatore;
use AppBundle\Manager\GestioneSquadra;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class GiocatoreController extends Controller
{
    /**
     * @Route("/giocatori/{idSquadra}",name="giocatori")
     * @Method("GET")
     */
    public function giocatoriOfSquadra($idSquadra){

        $g=new GestioneGiocatore();
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
     * @Route("{idSquadra}/giocatori",name="giocatoriPerSquadra")
     * @Method("GET")
     */
    public function giocatoriDiUnaSqudraById($idSquadra){

        $rep=$this->getDoctrine()->getRepository("AppBundle:Giocatore");
        $giocatori=$rep->findBy(array("squadra"=>$idSquadra));
        if (!$giocatori)
            throw $this->createNotFoundException('Nessun giocatore trovato per la squdra data ');

        $repPersona=$this->getDoctrine()->getRepository("AppBundle:Persona");
        $str="{\"idSquadra\":\"".$idSquadra."\",\"giocatori\":[";
        foreach ($giocatori as $g) {
            $persona=$repPersona->findOneBy(array("id"=>$g->getPersona()));
            $str = $str . "{\"cognome\":\"" . $persona->getCognome() . "\",\"nome\":\"" . $persona->getNome() . "\",\"ruolo\":\"" . $g->getRuolo() . "\",\"assist\":\"" . $g->getAssist() . "\",\"gol\":\"" . $g->getGolFatti() . "\",\"presenze\":\"" . $g->getPresenze() . "\",\"ammonizioni\":\"" . $g->getAmmonizioni() . "\",\"espulsioni\":\"" . $g->getEspulsioni() . "\",\"ruolo\":\"" . $g->getRuolo() . "\",\"presenze\":\"" . $g->getPresenze() . "\",\"altezza\":\"" . $g->getAltezza() . "\",\"peso\":\"" . $g->getPeso() . "\",\"golSubiti\":\"" . $g->getGolsubiti() . "\",\"valore\":\"" . $g->getValore() . "\"}";
        }
        $str=$str."]}";
        $r=new Response($str,200);
        $r->headers->set('Content-Type', 'application/json');
        return $r;


    }

    /**
     * @Route("inserisciGiocatore",name="insertG")
     * @Method("POST")
     */
    public function inserisciGiocatore(Request $request){

        $m=$this->getDoctrine()->getManager();
        $rep=$this->getDoctrine()->getRepository("AppBundle:Squadra");
        $s=$rep->findOneBy(array("id"=>$request->request->get("idsquadra")));
        $p=new Persona();
        $p->setNome($request->request->get("n"));
        $p->setCognome($request->request->get("c"));
        $p->setResidenza($request->request->get("r"));
        $p->setNumeroDiTelefono($request->request->get("t"));
        $p->setEmail($request->request->get("e"));
        $p->setNazionalita($request->request->get("na"));
        $p->setDataDiNascita($request->request->get("ddn"));
        $p->setCodiceFiscale($request->request->get("cf"));
        $p->setUrlImmagine("img.jpg");

        $m->persist($p);


        $g=new Giocatore();
        $g->setPersona($p);

        $g->setSquadra($s);
        $g->setAltezza($request->request->get("altezza"));
        $g->setPeso($request->request->get("peso"));
        $g->setRuolo($request->request->get("ruolo"));
        $g->setValore($request->request->get("valore"));
        $g->setAmmonizioni("0");
        $g->setAssist("0");
        $g->setEspulsioni("0");
        $g->setGolfatti("0");
        $g->setGolsubiti("0");
        $g->setPresenze("0");

        $m->persist($g);

        $m->flush();


    }
    /**
     * @Route("formGiocatore",name="formG")
     * @Method("GET")
     */
    public function formGiocatore(Request $request){

        return $this->render("Site/inserisciGiocatore.html.twig");


    }

    /**
     * @Route("eliminagiocatore/{id}",name="eliminagiocatore")
     * @Method("GET")
     */
    public function cancellaGiocatore($id){
        $repG=$this->getDoctrine()->getRepository("AppBundle:Giocatore");
        $repP=$this->getDoctrine()->getRepository("AppBundle:Persona");

        $giocatore=$repG->findOneBy(array("id"=>$id));
        $persona=$repP->findOneBy(array("id"=> $giocatore->getPersona()));

        $m=$this->getDoctrine()->getManager();
        $m->remove($giocatore);
        $m->remove($persona);

        $m->flush();
        return new Response("giocatore".$giocatore->getId()." eliminato");

    }
    /**
     * @Route("modificaStatGiocatore/{id}",name="modG")
     */
    public function modificaStatisticheGiocatore(Request $request,$id){

        $m=$this->getDoctrine()->getManager();
        $rep=$this->getDoctrine()->getRepository("AppBundle:Giocatore");

        $g=$rep->findOneBy(array("id"=>$id));
        if (!$g)
            throw $this->createNotFoundException(
                'Nessun giocatore trovato per l\'id '.$id);


        $g->setAmmonizioni($request->request->get("a"));
        $g->setAssist($request->request->get("as"));
        $g->setEspulsioni($request->request->get("e"));
        $g->setGolfatti($request->request->get("gf"));
        $g->setGolsubiti($request->request->get("gs"));
        $g->setPresenze($request->request->get("p"));


        $m->flush();


    }
}