<?php

/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 17/11/2016
 * Time: 18:35
 */
namespace AppBundle\Model;
class News
{

    private $idNews;
    private $titolo;
    private $contenuto;
    private $data;
    private $Squadre_idSquadre;
    private $urlImmagine;

    /**
     * @return mixed
     */
    public function getIdNews()
    {
        return $this->idNews;
    }

    /**
     * @param mixed $idNews
     */
    public function setIdNews($idNews)
    {
        $this->idNews = $idNews;
    }

    /**
     * @return mixed
     */
    public function getTitolo()
    {
        return $this->titolo;
    }

    /**
     * @param mixed $titolo
     */
    public function setTitolo($titolo)
    {
        $this->titolo = $titolo;
    }

    /**
     * @return mixed
     */
    public function getContenuto()
    {
        return $this->contenuto;
    }

    /**
     * @param mixed $contenuto
     */
    public function setContenuto($contenuto)
    {
        $this->contenuto = $contenuto;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getSquadreIdSquadre()
    {
        return $this->Squadre_idSquadre;
    }

    /**
     * @param mixed $Squadre_idSquadre
     */
    public function setSquadreIdSquadre($Squadre_idSquadre)
    {
        $this->Squadre_idSquadre = $Squadre_idSquadre;
    }

    /**
     * @return mixed
     */
    public function getUrlImmagine()
    {
        return $this->urlImmagine;
    }

    /**
     * @param mixed $urlImmagine
     */
    public function setUrlImmagine($urlImmagine)
    {
        $this->urlImmagine = $urlImmagine;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return '{"idNews":"'.$this->getIdNews().'","titolo":"'.$this->getTitolo().'","contenuto":"'.$this->getContenuto().'","data":"'.$this->getData().'","Squadre_idSquadre":"'.$this->getSquadreIdSquadre().'","urlImmagine":"'.$this->setUrlImmagine().'"}';
    }


}