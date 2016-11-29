<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 08/11/2016
 * Time: 13:50
 */
namespace AppBundle\Controller;



use AppBundle\Manager\ManagerSquadra;
use AppBundle\Manager\ManagerUser;
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
    /*public function insert(Request $re){
        $s=new Squadra();
        $m=new ManagerSquadra();
        $s->setNome($re->request->get("n"));
        $s->setAnnoFondazione($re->request->get("a"));
        $s->setPresidente($re->request->get("p"));
        $s->setSedeLegale($re->request->get("s"));
        $pathFinal=Utility::loadFile("file","Scudetti");
        if($pathFinal!=null) {
            $s->setUrlScudetto($pathFinal);
            if($m->insert($s)!=null)
                return new Response("squadra inserita con id" . $re->request->get("i"));
            else
                return new Response("problema con l inserimento della squadra",404);
        }
        else return new Response("problema nel caricare la foto",404);
    }*/
    /**
 * @Route("/squadra/all",name="allSquadre")
 * @Method("GET")
 */
    public function getAllSquadre(){

        $g=new ManagerSquadra();
        $squadre=$g->get();
        if($squadre!=null) {
            $response = "{\"squadre\":[";
            foreach ($squadre as $s)
                $response = $response . $s.",";

            $response=$response."]}";
            $r=new Response($response);
            $r->headers->set('Content-Type', 'application/json');
            return $r;
        }
        else{
            return new Response("problemi",404);
        }
    }
    /**
     * @Route("/squadra/{id}",name="squadra")
     * @Method("GET")
     */
    public function getSquadraById($id){

        $g=new ManagerSquadra();
        $squadra=$g->getById($id);
        if($squadra!=FALSE){
            $r=new Response($squadra);
            $r->headers->set('Content-Type', 'application/json');
            return $r;
        }

        else
            return new Response("non esiste la squadra cercata",404);

    }
    /**
     * @Route("/squadra/elimina/{id}",name="eliminasquadra")
     * @Method("GET")
     */
    //PROTETTO
    public function deleteSquadraById($id){


        $m=new ManagerSquadra();
        $mU=new ManagerUser();
        $s=$m->getById($id);
        if($s!=null){
            if($mU->check($s->getIdSquadre())){
                $url=$m->delete($id);
                if($url==null)
                    return new Response("nessuna squadra da eliminare con id :".$id,404);
                else
                    return new Response("eliminata la squadra con id:".$id);
            }
            else
                return new  Response("non ha l'accesso alla risorsa:",404);

        }else
            return new  Response("nessuna risorsa:",404);

    }
    /**
     * @Route("/squadra/aggiorna",name="aggiornaSquadra")
     * @Method("POST")
     */
    public function aggiornaSquadra(Request $req){
        $mN = new ManagerSquadra();
        $uM=new ManagerUser();
        $squadra=$mN->getById($req->request->get("i"));
        if($squadra!=null){
            if($uM->check($squadra->getIdSquadre())){
                $squadra->setNome($req->request->get("n"));
                $squadra->setAnnoFondazione($req->request->get("a"));
                $squadra->setPresidente($req->request->get("p"));
                $squadra->setSedeLegale($req->request->get("s"));
                $pathFinal = Utility::loadFile("file", "Scudetti");
                if ($pathFinal != null) {
                    $urlEsistente=$squadra->getUrlScudetto();
                    if(strcmp($urlEsistente,$pathFinal)!=0){
                        $url="../web/immaginiApp/Scudetti/".$urlEsistente;
                        unlink($url);
                        $squadra->setUrlScudetto($pathFinal);
                        if($mN->aggiornaSquadra($squadra)!=null)
                            return new Response("squadra modificata");
                        else return new Response("modifica non riuscita",404);
                    }
                }
                else return new Response("problema nel modificare la foto",404);
            }
            else
                return new Response("non hai accesso alla risorsa",404);

        }
        else return new Response("non esiste la squadra che vuoi modifica",404);
    }


}