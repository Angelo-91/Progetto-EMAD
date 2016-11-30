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
    private $idPartecipazione;
    private $punteggio;
    private $vittorie;
    private $pareggi;
    private $sconfitte;
    private $squadre_idSquadre;
    private $nomeTorneo;

    /**
     * @return mixed
     */
    public function getNomeTorneo()
    {
        return $this->nomeTorneo;
    }

    /**
     * @param mixed $nomeTorneo
     */
    public function setNomeTorneo($nomeTorneo)
    {
        $this->nomeTorneo = $nomeTorneo;
    }

    /**
     * @return mixed
     */
    public function getIdPartecipazione()
    {
        return $this->idPartecipazione;
    }

    /**
     * @param mixed $idPartecipazione
     */
    public function setIdPartecipazione($idPartecipazione)
    {
        $this->idPartecipazione = $idPartecipazione;
    }



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
        return $this->squadre_idSquadre;
    }

    /**
     * @param mixed $idSquadre
     */
    public function setIdSquadre($idSquadre)
    {
        $this->squadre_idSquadre = $idSquadre;
    }

    /**
     * @return mixed
     */


    function __toString()
    {
        return '{"idSquadre":"'.$this->getIdSquadre().
                '","idPartecipazione":"'.$this->getIdPartecipazione().
                '","punteggio":"'.$this->getPunteggio().
                '","vittorie":"'.$this->getVittorie().
                '"," nomeTorneo":"'.$this->getNomeTorneo().
                '","pareggi":"'.$this->getPareggi().'","sconfitte":"'.$this->getSconfitte().'"}';
    }

}