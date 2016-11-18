<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 18/11/2016
 * Time: 18:31
 */

namespace AppBundle\Manager;
use AppBundle\Model\Partecipazione;
use AppBundle\Utility\DB;

class ManagerPartecipazione
{

    private $conn;
    private $db;

    public function __construct()
    {
        $this->db=new DB();
        $this->conn=$this->db->connect();
    }

    public function get(){
        $partecipazioni = array();
        $sql = "SELECT * from partecipazione";
        $result = $this->conn->query($sql);
        $res = "";
        $i=0;
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $s = new Partecipazione();
                $s->setIdSquadre($row["Squadre_idSquadre"]);
                $s->setIdTornei($row["Tornei_idTornei"]);
                $s->setPunteggio($row["punteggio"]);
                $s->setVittorie($row["vittorie"]);
                $s->setPareggi($row["pareggi"]);
                $s->setSconfitte($row["sconfitte"]);
                $partecipazioni[$i] = $s;
                $i++;
            }
            return $partecipazioni;
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