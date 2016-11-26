<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 20:11
 */

namespace AppBundle\Manager;
use AppBundle\Model\Check;
use AppBundle\Model\Squadra;
use AppBundle\Model\User;
use AppBundle\Utility\DB;

class ManagerUser
{

    private $conn;
    private $db;

    public function __construct()
    {
        $this->db=new DB();
        $this->conn=$this->db->connect();
    }

    /**
     * @return array|null
     */
    public function get(){
        $user = array();
        $sql = "SELECT * from user";
        $result = $this->conn->query($sql);
        $res = "";
        $i=0;
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $s = new User();
                $s->setEmail($row["email"]);
                $s->setPassword($row["password"]);
                $s->setSquadreIdSquadre($row["Squadre_idSquadre"]);
                $user[$i] = $s;
                $i++;
            }
            return $user;
        }
        else {
            return null;
        }
    }

    /**
     * @param User $utente
     * @return bool
     */
    public function registrazione(User $utente, $nomeSquadra)
    {
        $managerSquadra = new ManagerSquadra();
        $res = $managerSquadra->getByName($nomeSquadra);
        if($res != null){
            return FALSE;
        } else {
            $squadra = new Squadra();
            $squadra->setNome($nomeSquadra);
            $managerSquadra->insert($squadra);
            $estrapolaId = $managerSquadra->getByName($nomeSquadra);
            $id = $estrapolaId->getIdSquadre();
            $utente->setSquadreIdSquadre($id);
            $controllo = $this->getUserByEmail($utente->getEmail());
            if($controllo == FALSE) {
                $sql = "INSERT INTO user (email, password, Squadre_idSquadre) VALUES ('" . $utente->getEmail() . "','" . $utente->getPassword() . "','" . $utente->getSquadreIdSquadre() . "')";
                $ris = $this->conn->query($sql);
                return $ris;
            } else {
                return FALSE;
            }
        }
    }

    public function getUserByEmail($email){
        $sql = "SELECT * FROM user WHERE email='$email'";
        $res = $this->conn->query($sql);
        if($res->num_rows > 0){
            $user = new User();
            $row = $res->fetch_assoc();
            $user->setEmail($row["email"]);
            $user->setPassword($row["password"]);
            $user->setSquadreIdSquadre($row["Squadre_idSquadre"]);
            return $user;
        } else {
            return FALSE;
        }
    }

    /**
     * @param User $utente
     * @return bool
     */
    public function login(User $utente){
        return false;
    }


    /**
     * @param Check $check
     * @return bool
     */
    public function logout(Check $check){
        return false;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db->close($this->conn);
    }
}
