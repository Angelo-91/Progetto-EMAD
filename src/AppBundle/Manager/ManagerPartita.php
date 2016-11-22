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

    public function getPartitaById($idPartita){
        $toReturnPartita = new Partita();
        $sql = "SELECT * FROM partite WHERE idPartita='$idPartita'";
        $result = $this->conn->query($sql);
        $valore = $result->num_rows;
        if($valore > 0){
            $row = $result->fetch_assoc();
            $toReturnPartita->setSquadreIdSquadre($row["Squadre_idSquadre"]);
            $toReturnPartita->setRisultato($row["risultato"]);
            $toReturnPartita->setSquadraCasa($row["squadraCasa"]);
            $toReturnPartita->setSquadraTrasferta($row["squadraTrasferta"]);
            $toReturnPartita->setIdPartita($row["idPartita"]);
            return $toReturnPartita;
        } else {
            return null;
        }

    }

    public function getPartitaBySquadraCasa($squadraCasa){
        $toReturnPartite = array();
        $sql = "SELECT * FROM partite WHERE squadraCasa='$squadraCasa'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $i=0;
            while($row = $result->fetch_assoc()){
                $s = new Partita();
                $s->setIdPartita($row["idPartita"]);
                $s->setSquadraCasa($row["squadraCasa"]);
                $s->setSquadraTrasferta($row["squadraTrasferta"]);
                $s->setRisultato($row["risultato"]);
                $s->setSquadreIdSquadre($row["Squadre_idSquadre"]);
                $toReturnPartite[$i] = $s;
                $i++;
            }
            return $toReturnPartite;
        } else {
            return null;
        }
    }

    public function getPartitaBySquadraTrasferta($squadraTrasferta){
        $toReturnPartite = array();
        $sql = "SELECT * FROM partite WHERE squadraTrasferta='$squadraTrasferta'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $i=0;
            while($row = $result->fetch_assoc()){
                $s = new Partita();
                $s->setIdPartita($row["idPartita"]);
                $s->setSquadraCasa($row["squadraCasa"]);
                $s->setSquadraTrasferta($row["squadraTrasferta"]);
                $s->setRisultato($row["risultato"]);
                $s->setSquadreIdSquadre($row["Squadre_idSquadre"]);
                $toReturnPartite[$i] = $s;
                $i++;
            }
            return $toReturnPartite;
        } else {
            return null;
        }
    }

    public function insertPartita(Partita $partita){
        $managerSquadra = new ManagerSquadra();
        $squadraCasa = $partita->getSquadraCasa();
        $squadraTrasferta = $partita->getSquadraTrasferta();
        if($managerSquadra->getByName($squadraCasa) && $managerSquadra->getByName($squadraTrasferta)) {
            $sql = "INSERT INTO partite (squadraCasa, squadraTrasferta, risultato, Squadre_idSquadre) VALUES ('" . $partita->getSquadraCasa() . "','" . $partita->getSquadraTrasferta() . "','" . $partita->getRisultato() . "','" . $partita->getSquadreIdSquadre() . "')";
            $risultato = $this->conn->query($sql);
            return $risultato;
        } else {
            return null;
        }
    }

    public function deletePartita($idPartita){
        $sql = "DELETE FROM partite WHERE idPartita='$idPartita'";
        $risultato = $this->conn->query($sql);
        if($risultato!=null){
            return $risultato;
        } else {
            return null;
        }
    }

    public function aggiornaPartita(Partita $partita){
        $managerPartita = new ManagerPartita();
        $risultato = $managerPartita->getPartitaById($partita->getIdPartita());
        if($risultato!=null){
            $risultato = $partita->getRisultato();
            $squadraCasa = $partita->getSquadraCasa();
            $squadraTrasferta = $partita->getSquadraTrasferta();
            $sqEx = $partita->getSquadreIdSquadre();
            $id = $partita->getIdPartita();
            $sql = "UPDATE partite SET risultato='$risultato', squadraCasa='$squadraCasa' , squadraTrasferta='$squadraTrasferta' , Squadre_idSquadre='$sqEx' WHERE idPartita='$id'";
            $ri = $this->conn->query($sql);
            if($ri!=null){
                return $ri;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }


    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db->close($this->conn);
    }
}