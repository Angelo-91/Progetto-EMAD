<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 20:14
 */

namespace AppBundle\Controller;
use AppBundle\Manager\ManagerUser;
use AppBundle\Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/user/all",name="allUser")
     * @Method("GET")
     */
    public function getAllUser(){
        $manager = new ManagerUser();
        $risultati = $manager->get();
        if($risultati!=null){
            $toRetutn = "";
            foreach ($risultati as $s){
                $toRetutn = $toRetutn.$s;
            }
            return new Response($toRetutn);
        }
        else {
            return new Response("problemi");
        }
    }

    /**
     * @Route("/user/{email}",name="getUserByEmail")
     * @Method("GET")
     */
    public function getUserByEmail($email){
        $manager = new ManagerUser();
        $risultato = $manager->getUserByEmail($email);
        if($risultato!=null){
            return new Response($risultato);
        }
        else {
            return new Response("Non esiste alcun utente con questa mail: ".$email);
        }
    }

    /**
 * @Route("/user/registrati",name="registrazioneUser")
 * @Method("POST")
 */
    public function registraUtente(Request $request){
        $manager = new ManagerUser();
        $utente = new User();
        $utente->setEmail($request->request->get("email"));
        $utente->setPassword($request->request->get("password"));
        $ris = $manager->registrazione($utente,$request->request->get("nomeSquadra"));
        if($ris != FALSE){
            return new Response("Registrazione avvenuta con successo");
        } else {
            return new Response("Problemi con la registrazione");
        }
    }

    /**
     * @Route("/user/login",name="loginUser")
     * @Method("POST")
     */
    public function loginUtente(Request $request){
        $manager = new ManagerUser();
        $utente = new User();
        $utente->setEmail($request->request->get("email"));
        $utente->setPassword($request->request->get("password"));
        $ris = $manager->login($utente);
        if($ris != FALSE){
            return new Response("Login success");
        } else {
            return new Response("Login failed");
        }
    }

    /**
     * @Route("/user/logout",name="logoutUser")
     * @Method("GET")
     */
    public function logoutUtente(){
        $manager = new ManagerUser();
        $ris = $manager->logout();
        if($ris != FALSE){
            return new Response("Login success");
        } else {
            return new Response("Login failed");
        }
    }



}