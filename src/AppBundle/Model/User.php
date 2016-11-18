<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 20:08
 */

namespace AppBundle\Model;


class User
{
    private $email;
    private $password;
    private $squadre_idSquadre;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getSquadreIdSquadre()
    {
        return $this->squadre_idSquadre;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
        return '{"email":"'.$this->getEmail().'","password":"'.$this->getPassword().'","squadre_idSquadre":"'.$this->getSquadreIdSquadre().'"}';
    }


}