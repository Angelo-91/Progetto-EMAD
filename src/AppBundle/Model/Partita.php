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
    private $orario;
    private $luogo;

    /**
     * @return mixed
     */
    public function getOrario()
    {
        return $this->orario;
    }

    /**
     * @param mixed $orario
     */
    public function setOrario($orario)
    {
        $this->orario = $orario;
    }

    /**
     * @return mixed
     */
    public function getLuogo()
    {
        return $this->luogo;
    }

    /**
     * @param mixed $luogo
     */
    public function setLuogo($luogo)
    {
        $this->luogo = $luogo;
    }

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
        return '{"idPartita":"'.$this->getIdPartita().
            '","squadraCasa":"'.$this->getSquadraCasa().
            '","squadraTrasferta":"'.$this->getSquadraTrasferta().
            '","orario":"'.$this->getOrario().
            '","luogo":"'.$this->getLuogo().
            '","risultato":"'.$this->getRisultato().'","squadre_idSquadre":"'.$this->getSquadreIdSquadre().'"}';
    }


}