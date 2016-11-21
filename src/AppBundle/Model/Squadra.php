<?php

/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 17/11/2016
 * Time: 18:35
 */
namespace AppBundle\Model;
class Squadra
{
    private $idSquadre;
    private $nome;
    private $annoFondazione;
    private $presidente;
    private $sedeLegale;
    private $urlScudetto;




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
    public function getAnnoFondazione()
    {
        return $this->annoFondazione;
    }

    /**
     * @param mixed $annoFondazione
     */
    public function setAnnoFondazione($annoFondazione)
    {
        $this->annoFondazione = $annoFondazione;
    }

    /**
     * @return mixed
     */
    public function getPresidente()
    {
        return $this->presidente;
    }

    /**
     * @param mixed $presidente
     */
    public function setPresidente($presidente)
    {
        $this->presidente = $presidente;
    }

    /**
     * @return mixed
     */
    public function getSedeLegale()
    {
        return $this->sedeLegale;
    }

    /**
     * @param mixed $sedeLegale
     */
    public function setSedeLegale($sedeLegale)
    {
        $this->sedeLegale = $sedeLegale;
    }

    /**
     * @return mixed
     */
    public function getUrlScudetto()
    {
        return $this->urlScudetto;
    }

    /**
     * @param mixed $urlScudetto
     */
    public function setUrlScudetto($urlScudetto)
    {
        $this->urlScudetto = $urlScudetto;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return '{"idSquadre":"'.$this->getIdSquadre().'","nome":"'.$this->getNome().'","annoFondazione":"'.$this->getAnnoFondazione().'","presidente":"'.$this->getPresidente().'","sedeLegale":"'.$this->getSedeLegale().'"}';
    }


}