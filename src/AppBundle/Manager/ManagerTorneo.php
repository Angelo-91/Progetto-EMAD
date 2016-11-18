<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 20:04
 */

namespace AppBundle\Manager;
use AppBundle\Model\Torneo;
use AppBundle\Utility\DB;

class ManagerTorneo
{
    private $conn;
    private $db;

    public function __construct()
    {
        $this->db=new DB();
        $this->conn=$this->db->connect();
    }

    public function get(){
        $tornei = array();
        $sql = "SELECT * from tornei";
        $result = $this->conn->query($sql);
        $res = "";
        $i=0;
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $s = new Torneo();
                $s->setIdTornei($row["idTornei"]);
                $s->setNomeTorneo($row["nomeTorneo"]);
                $tornei[$i] = $s;
                $i++;
            }
            return $tornei;
        }
        else {
            return null;
        }
    }

    public function insertTorneo(){
        $random = rand(1,10000);
        $sql ="INSERT into tornei (nomeTorneo) VALUE ('$random')";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db->close($this->conn);
    }
}