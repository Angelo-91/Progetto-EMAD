<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 08/11/2016
 * Time: 13:50
 */
namespace AppBundle\Controller;



use AppBundle\Manager\ManagerSquadra;
use AppBundle\Model\Squadra;
use AppBundle\Utility\Utility;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class SquadraController extends Controller
{
    /**
     * @Route("/squadra/insert",name="insertsquadra")
     * @Method("POST")
     */
    public function insert(Request $re){
        $s=new Squadra();
        $m=new ManagerSquadra();
        $s->setNome($re->request->get("n"));
        $s->setAnnoFondazione($re->request->get("a"));
        $s->setPresidente($re->request->get("p"));
        $s->setSedeLegale($re->request->get("s"));
        $pathFinal=Utility::loadFile("file","Scudetti");
        if($pathFinal!=null) {
            $s->setUrlScudetto($pathFinal);
            $m->insert($s);
            return new Response("squadra inserita con id" . $re->request->get("i"));
        }
        else return new Response("problema nel caricare la foto");
    }
    /**
 * @Route("/squadra/all",name="allSquadre")
 * @Method("GET")
 */
    public function getAllSquadre(){

        $g=new ManagerSquadra();
        $squadre=$g->get();
        if($squadre!=null) {
            $response = "";
            foreach ($squadre as $s)
                $response = $response . $s;

            return new Response($response);
        }
        else{
            return new Response("problemi");
        }
    }
    /**
     * @Route("/squadra/{id}",name="squadra")
     * @Method("GET")
     */
    public function getSquadraById($id){

        $g=new ManagerSquadra();
        $squadra=$g->getById($id);
        if($squadra!=FALSE)
            return new Response($squadra);
        else
            return new Response("non esiste la squadra cercata");

    }
    /**
     * @Route("/squadra/elimina/{id}",name="eliminasquadra")
     * @Method("GET")
     */
    public function deleteSquadraById($id){


        $m=new ManagerSquadra();
        $url=$m->delete($id);
        if($url==null)
            return new Response("nessuna squadra da eliminare con id :".$id);
        else
        return new Response("eliminata la squadra con id:".$id);
    }



}