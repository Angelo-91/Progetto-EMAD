<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 19:46
 */

namespace AppBundle\Manager;


use AppBundle\Model\Partita;
use AppBundle\Utility\DB;
class ManagerPartita
{

    private $conn;
    private $db;

    public function __construct()
    {
        $this->db=new DB();
        $this->conn=$this->db->connect();
    }

    public function get(){
        $partite = array();
        $sql = "SELECT * from partite";
        $result = $this->conn->query($sql);
        $res = "";
        $i=0;
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $s = new Partita();
                $s->setIdPartita($row["idPartita"]);
                $s->setSquadraCasa($row["squadraCasa"]);
                $s->setSquadraTrasferta($row["squadraTrasferta"]);
                $s->setRisultato($row["risultato"]);
                $s->setSquadreIdSquadre($row["Squadre_idSquadre"]);
                $partite[$i] = $s;
                $i++;
            }
            return $partite;
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