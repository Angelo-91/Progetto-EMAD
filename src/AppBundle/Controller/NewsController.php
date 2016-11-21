<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 08/11/2016
 * Time: 13:50
 */
namespace AppBundle\Controller;



use AppBundle\Manager\ManagerNews;
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
    public function newsOfSquadra($idSquadra){
        $n=new ManagerNews();
        $news=$n->getNewsByIdSquadra($idSquadra);
        if(count($news)>0) {
            $response = "";
            foreach ($news as $n)
                $response = $response . $n;

            return new Response($response);
        }
        else
            return new Response("nessun giocatore di questa squadra");



    }
}