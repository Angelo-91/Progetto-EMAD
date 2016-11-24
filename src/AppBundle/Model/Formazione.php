<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 24/11/2016
 * Time: 18:15
 */

namespace AppBundle\Model;


class Formazione
{
private $golFatti;
private $golSubiti;
private $Partite_idPartita;
private $Giocatori_idGiocatori;
private $assist;
private $ruolo;
private $minutiGiocati;
private $votoPersonale;
private $ammonizioni;
private $espulsioni;

    /**
     * @return mixed
     */
    public function getGolFatti()
    {
        return $this->golFatti;
    }

    /**
     * @param mixed $golFatti
     */
    public function setGolFatti($golFatti)
    {
        $this->golFatti = $golFatti;
    }

    /**
     * @return mixed
     */
    public function getGolSubiti()
    {
        return $this->golSubiti;
    }

    /**
     * @param mixed $golSubiti
     */
    public function setGolSubiti($golSubiti)
    {
        $this->golSubiti = $golSubiti;
    }

    /**
     * @return mixed
     */
    public function getPartiteIdPartita()
    {
        return $this->Partite_idPartita;
    }

    /**
     * @param mixed $Partite_idPartita
     */
    public function setPartiteIdPartita($Partite_idPartita)
    {
        $this->Partite_idPartita = $Partite_idPartita;
    }

    /**
     * @return mixed
     */
    public function getGiocatoriIdGiocatori()
    {
        return $this->Giocatori_idGiocatori;
    }

    /**
     * @param mixed $Giocatori_idGiocatori
     */
    public function setGiocatoriIdGiocatori($Giocatori_idGiocatori)
    {
        $this->Giocatori_idGiocatori = $Giocatori_idGiocatori;
    }

    /**
     * @return mixed
     */
    public function getAssist()
    {
        return $this->assist;
    }

    /**
     * @param mixed $assist
     */
    public function setAssist($assist)
    {
        $this->assist = $assist;
    }

    /**
     * @return mixed
     */
    public function getRuolo()
    {
        return $this->ruolo;
    }

    /**
     * @param mixed $ruolo
     */
    public function setRuolo($ruolo)
    {
        $this->ruolo = $ruolo;
    }

    /**
     * @return mixed
     */
    public function getMinutiGiocati()
    {
        return $this->minutiGiocati;
    }

    /**
     * @param mixed $minutiGiocati
     */
    public function setMinutiGiocati($minutiGiocati)
    {
        $this->minutiGiocati = $minutiGiocati;
    }

    /**
     * @return mixed
     */
    public function getVotoPersonale()
    {
        return $this->votoPersonale;
    }

    /**
     * @param mixed $votoPersonale
     */
    public function setVotoPersonale($votoPersonale)
    {
        $this->votoPersonale = $votoPersonale;
    }

    /**
     * @return mixed
     */
    public function getAmmonizioni()
    {
        return $this->ammonizioni;
    }

    /**
     * @param mixed $ammonizioni
     */
    public function setAmmonizioni($ammonizioni)
    {
        $this->ammonizioni = $ammonizioni;
    }

    /**
     * @return mixed
     */
    public function getEspulsioni()
    {
        return $this->espulsioni;
    }

    /**
     * @param mixed $espulsioni
     */
    public function setEspulsioni($espulsioni)
    {
        $this->espulsioni = $espulsioni;
    }



    public function __toString()
    {
        $toString=   '{"golFatti":"'.$this->getGolFatti().
            '","golSubiti":"'.$this->getGolSubiti().
            '","Partite_idPartita":"'.$this->getPartiteIdPartita().
            '","Giocatori_idGiocatori":"'.$this->getGiocatoriIdGiocatori().
            '","assist":"'.$this->getAssist().
            '","ruolo":"'.$this->getRuolo(). '"}'.
            '","minutiGiocati":"'.$this->getMinutiGiocati().
            '","votoPersonale":"'.$this->getVotoPersonale().
            '","ammonizioni":"'.$this->getAmmonizioni().
            '","espulsioni":"'.$this->getEspulsioni().
            '"}';
        return $toString;
    }


}