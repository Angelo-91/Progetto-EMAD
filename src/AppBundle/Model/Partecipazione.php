<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 18:19
 */

namespace AppBundle\Model;


class Partecipazione
{
    private $punteggio;
    private $vittorie;
    private $pareggi;
    private $sconfitte;
    private $idSquadre;
    private $idTornei;

    /**
     * @return mixed
     */
    public function getPunteggio()
    {
        return $this->punteggio;
    }

    /**
     * @param mixed $punteggio
     */
    public function setPunteggio($punteggio)
    {
        $this->punteggio = $punteggio;
    }

    /**
     * @return mixed
     */
    public function getVittorie()
    {
        return $this->vittorie;
    }

    /**
     * @param mixed $vittorie
     */
    public function setVittorie($vittorie)
    {
        $this->vittorie = $vittorie;
    }

    /**
     * @return mixed
     */
    public function getPareggi()
    {
        return $this->pareggi;
    }

    /**
     * @param mixed $pareggi
     */
    public function setPareggi($pareggi)
    {
        $this->pareggi = $pareggi;
    }

    /**
     * @return mixed
     */
    public function getSconfitte()
    {
        return $this->sconfitte;
    }

    /**
     * @param mixed $sconfitte
     */
    public function setSconfitte($sconfitte)
    {
        $this->sconfitte = $sconfitte;
    }

    /**
     * @return mixed
     */
    public function getIdSquadre()
    {
        return $this->idSquadre;
    }

    /**
     * @param mixed $idSquadre
     */
    public function setIdSquadre($idSquadre)
    {
        $this->idSquadre = $idSquadre;
    }

    /**
     * @return mixed
     */
    public function getIdTornei()
    {
        return $this->idTornei;
    }

    /**
     * @param mixed $idTornei
     */
    public function setIdTornei($idTornei)
    {
        $this->idTornei = $idTornei;
    }

    function __toString()
    {
        return '{"idSquadre":"'.$this->getIdSquadre().'","idTornei":"'.$this->getIdTornei().'","punteggio":"'.$this->getPunteggio().'","vittorie":"'.$this->getVittorie().'","pareggi":"'.$this->getPareggi().'","sconfitte":"'.$this->getSconfitte().'"}';
    }

}