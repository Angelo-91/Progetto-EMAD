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

    public function getAll(){
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
            return FALSE;
        }
    }



    public function insertTorneo(Torneo $torneo){
        if(strlen($torneo->getNomeTorneo())>0) {
            $sql = "INSERT INTO tornei (nomeTorneo) VALUE ('" . $torneo->getNomeTorneo() . "')";
            $result = $this->conn->query($sql);
            return $result;
        } else {
            return FALSE;
        }

    }

    public function deleteTorneo($id){
        if($this->getTorneoById($id)!=FALSE) {
            $sql = "DELETE FROM tornei WHERE idTornei = '$id'";
            $result = $this->conn->query($sql);
            return $result;
        } else {
            return FALSE;
        }

    }


    public function getTorneoByNome($nome){
        $torneo = new Torneo();
        $sql = "SELECT * FROM tornei WHERE nomeTorneo='$nome'";
        $risultato = $this->conn->query($sql);
        if($risultato->num_rows > 0) {
            $row = $risultato->fetch_assoc();
            $torneo->setIdTornei($row["idTornei"]);
            $torneo->setNomeTorneo($row["nomeTorneo"]);
            return $torneo;
        } else{
            return FALSE;
        }
    }

    public function updateTorneo($nomeOriginale, $nomeNuovo){
        $controllo = $this->getTorneoByNome($nomeOriginale);
            if($controllo != FALSE ){
                    $id=$controllo->getIdTornei();
                    $sql = "UPDATE tornei SET nomeTorneo='$nomeNuovo' WHERE idTornei='$id'";
                    $result = $this->conn->query($sql);
                    return $result;
            } else{
                    return FALSE;
            }
    }


    public function getTorneoById($id){
        $sql = "SELECT * FROM tornei WHERE idTornei='$id'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $t = new Torneo();
            $t->setIdTornei($row["idTornei"]);
            $t->setNomeTorneo($row["nomeTorneo"]);
            return $t;
        } else {
            return FALSE;
        }
    }


    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db->close($this->conn);
    }
}