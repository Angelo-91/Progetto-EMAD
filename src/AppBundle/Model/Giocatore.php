<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 18/11/2016
 * Time: 10:03
 */

namespace AppBundle\Model;


class Giocatore
{

    private $idGiocatori;
    private $golFatti;
    private $golSubiti;
    private $assist;
    private $ammonizioni;
    private $espulsioni;
    private $presenze;
    private $ruolo;
    private $valore;
    private $nome;
    private $cognome;
    private $residenza;
    private $nazionalita;
    private $email;
    private $dataDiNascita;
    private $Squadre_idSquadre;
    private $urlImmagine;

    /**
     * @return mixed
     */
    public function getIdGiocatori()
    {
        return $this->idGiocatori;
    }

    /**
     * @param mixed $idGiocatori
     */
    public function setIdGiocatori($idGiocatori)
    {
        $this->idGiocatori = $idGiocatori;
    }

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

    /**
     * @return mixed
     */
    public function getPresenze()
    {
        return $this->presenze;
    }

    /**
     * @param mixed $presenze
     */
    public function setPresenze($presenze)
    {
        $this->presenze = $presenze;
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
    public function getValore()
    {
        return $this->valore;
    }

    /**
     * @param mixed $valore
     */
    public function setValore($valore)
    {
        $this->valore = $valore;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getCognome()
    {
        return $this->cognome;
    }

    /**
     * @param mixed $cognome
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }

    /**
     * @return mixed
     */
    public function getResidenza()
    {
        return $this->residenza;
    }

    /**
     * @param mixed $residenza
     */
    public function setResidenza($residenza)
    {
        $this->residenza = $residenza;
    }

    /**
     * @return mixed
     */
    public function getNazionalita()
    {
        return $this->nazionalita;
    }

    /**
     * @param mixed $nazionalita
     */
    public function setNazionalita($nazionalita)
    {
        $this->nazionalita = $nazionalita;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getDataDiNascita()
    {
        return $this->dataDiNascita;
    }

    /**
     * @param mixed $dataDiNascita
     */
    public function setDataDiNascita($dataDiNascita)
    {
        $this->dataDiNascita = $dataDiNascita;
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
   $toString=   '{"nome":"'.$this->getNome().
                '","cognome":"'.$this->getCognome().
                '","email":"'.$this->getEmail().
                '","residenza":"'.$this->getResidenza().
                '","nazionalita":"'.$this->getNazionalita().
                '","valore":"'.$this->getValore().
                '","data":"'.$this->getDataDiNascita().
                '","url":"'.$this->getUrlImmagine().
                '","squadra":"'.$this->getSquadreIdSquadre().
                '","golFatti":"'.$this->getGolFatti().
                '","golSubiti":"'.$this->getGolSubiti().
                '","ruolo":"'.$this->getRuolo().
                '","ammonizioni":"'.$this->getAmmonizioni().
                '","espulsioni":"'. $this->getEspulsioni().
                '","assist":"'.$this->getAssist().
                '","presenze":"'.$this->getPresenze().
                '","id":"'.$this->getIdGiocatori().
                '"}';
        return $toString;
    }
}