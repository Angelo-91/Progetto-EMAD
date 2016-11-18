<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 19:35
 */

namespace AppBundle\Model;


class Partita
{
    private $idPartita;
    private $squadraCasa;
    private $squadraTrasferta;
    private $risultato;
    private $squadre_idSquadre;

    /**
     * @return mixed
     */
    public function getIdPartita()
    {
        return $this->idPartita;
    }

    /**
     * @param mixed $idPartita
     */
    public function setIdPartita($idPartita)
    {
        $this->idPartita = $idPartita;
    }

    /**
     * @return mixed
     */
    public function getSquadraCasa()
    {
        return $this->squadraCasa;
    }

    /**
     * @param mixed $squadraCasa
     */
    public function setSquadraCasa($squadraCasa)
    {
        $this->squadraCasa = $squadraCasa;
    }

    /**
     * @return mixed
     */
    public function getSquadraTrasferta()
    {
        return $this->squadraTrasferta;
    }

    /**
     * @param mixed $squadraTrasferta
     */
    public function setSquadraTrasferta($squadraTrasferta)
    {
        $this->squadraTrasferta = $squadraTrasferta;
    }

    /**
     * @return mixed
     */
    public function getRisultato()
    {
        return $this->risultato;
    }

    /**
     * @param mixed $risultato
     */
    public function setRisultato($risultato)
    {
        $this->risultato = $risultato;
    }

    /**
     * @return mixed
     */
    public function getSquadreIdSquadre()
    {
        return $this->squadre_idSquadre;
    }

    /**
     * @param mixed $squadre_idSquadre
     */
    public function setSquadreIdSquadre($squadre_idSquadre)
    {
        $this->squadre_idSquadre = $squadre_idSquadre;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return '{"idPartita":"'.$this->getIdPartita().'","squadraCasa":"'.$this->getSquadraCasa().'","squadraTrasferta":"'.$this->getSquadraTrasferta().'","risultato":"'.$this->getRisultato().'","squadre_idSquadre":"'.$this->getSquadreIdSquadre().'"}';
    }


}