<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 20:11
 */

namespace AppBundle\Manager;
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

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db->close($this->conn);
    }
}
