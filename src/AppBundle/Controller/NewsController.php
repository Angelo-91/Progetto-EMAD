<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 08/11/2016
 * Time: 13:50
 */
namespace AppBundle\Controller;



use AppBundle\Manager\ManagerNews;
use AppBundle\Manager\ManagerSquadra;
use AppBundle\Manager\ManagerUser;
use AppBundle\Model\News;
use AppBundle\Utility\Utility;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class NewsController extends Controller
{
    /**
     * @Route("/news/{idSquadra}",name="newsOfSquadra")
     * @Method("GET")
     */
    public function newsOfSquadra($idSquadra)
    {
        $n = new ManagerNews();
        $news = $n->getNewsByIdSquadra($idSquadra);
            if (count($news) > 0) {
                $response = "";
                foreach ($news as $n)
                    $response = $response . $n;

                return new Response($response);
            } else
                return new Response("nessuna notizia di questa squadra");




    }
    /**
     * @Route("/news/insert",name="insertnews")
     * @Method("POST")
     */
    public function insert(Request $re){
        $mU=new ManagerUser();
        $n=new News();
        $m=new ManagerNews();
        $mS=new ManagerSquadra();
        if($mU->check($re->request->get("s"))) {
            $squadra = $mS->getById($re->request->get("s"));
            if ($squadra != null) {
                $n->setTitolo($re->request->get("t"));
                $n->setContenuto($re->request->get("c"));
                $n->setData($re->request->get("d"));
                $n->setSquadreIdSquadre($re->request->get("s"));
                $pathFinal = Utility::loadFile("file", "News");
                if ($pathFinal != null) {
                    $n->setUrlImmagine($pathFinal);
                    $m->insert($n);
                    return new Response("news inserita");
                } else return new Response("problema nel caricare la foto");
            } else return new Response("vuoi inserire una news a una squadra che non esiste ");
        }
        else return new Response("la risorsa non esiste",404);

    }
    /**
     * @Route("/news/elimina/{id}",name="eliminanews")
     * @Method("GET")
     */
    public function deleteNewsById($id)
    {
        $mU = new ManagerUser();
        $m = new ManagerNews();
        $news = $m->getNewsById($id);
        if ($news != null) {
            if ($mU->check($news->getSquadreIdSquadre())) {
                $url = $m->delete($id);
                if ($url == null)
                    return new Response("nessuna notizia da eliminare con id: " . $id);
                else
                    return new Response("eliminata la notizia  con id:" . $id);
            } else
                return new Response("la risorsa non esiste", 404);
        } return new Response("la risorsa non esiste", 404);
    }



    /**
     * @Route("/news/aggiorna",name="aggiornaNews")
     * @Method("POST")
     */
    public function aggiornaNews(Request $req){
        $mN = new ManagerNews();
        $mU=new ManagerUser();
        $news=$mN->getNewsById($req->request->get("i"));
        if($news!=null){
            if($mU->check($news->getSquadreIdSquadre())){
                $news->setTitolo($req->request->get("t"));
                $news->setContenuto($req->request->get("c"));
                $news->setData($req->request->get("d"));
                $pathFinal = Utility::loadFile("file", "News");
                if ($pathFinal != null) {
                    $urlEsistente=$news->getUrlImmagine();
                    if(strcmp($urlEsistente,$pathFinal)!=0){
                        $url="../web/immaginiApp/News/".$urlEsistente;
                        unlink($url);
                        $news->setUrlImmagine($pathFinal);
                        if($mN->aggiornaNews($news)!=null)
                            return new Response("news modificata");
                        else return new Response("modifica non riuscita");
                    }
                }
                else return new Response("problema nel modificare la foto");
            }
            else return   new Response("la risorsa non esiste", 404);



        }
        else return new Response("non esiste la notizia che vuoi modifica");
    }

    /**
     * @Route("/Gnews/{id}",name="getNewsId")
     * @Method("GET")
     */
    public function getNewsById($id){
        $m=new ManagerNews();

        $news = $m->getNewsById($id);
        if($news!=null){
            return new Response($news);
        } else {
            return new Response("La news con questo id: ".$id." non esiste");
        }
    }

}