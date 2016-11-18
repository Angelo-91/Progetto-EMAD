<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 20:02
 */

namespace AppBundle\Model;


class Torneo
{

    private $idTornei;
    private $nomeTorneo;

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

    function __toString()
    {
        // TODO: Implement __toString() method.
        return '{"idTornei":"'.$this->getIdTornei().'","nomeTorneo":"'.$this->getNomeTorneo().'"}';
    }


}