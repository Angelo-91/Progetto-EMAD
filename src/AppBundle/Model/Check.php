<?php
/**
 * Created by PhpStorm.
 * User: Raffaele
 * Date: 25/11/2016
 * Time: 10:22
 */

namespace AppBundle\Model;


class Check
{

    private $username;
    private $idSquadra;

    /**
     * Check constructor.
     * @param $username
     * @param $idSquadra
     */

    public function __construct($username, $idSquadra)
    {
        $this->username = $username;
        $this->idSquadra = $idSquadra;
    }


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getIdSquadra()
    {
        return $this->idSquadra;
    }

    /**
     * @param mixed $idSquadra
     */
    public function setIdSquadra($idSquadra)
    {
        $this->idSquadra = $idSquadra;
    }

}