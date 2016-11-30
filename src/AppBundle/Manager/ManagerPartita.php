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

    public function getAll(){
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
                $s->setLuogo($row["luogo"]);
                $s->setOrario($row["orario"]);
                $s->setSquadreIdSquadre($row["Squadre_idSquadre"]);
                $partite[$i] = $s;
                $i++;
            }
            return $partite;
        }
        else {
            return FALSE;
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
            $toReturnPartita->setLuogo($row["luogo"]);
            $toReturnPartita->setOrario($row["orario"]);
            return $toReturnPartita;
        } else {
            return FALSE;
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
                $s->setLuogo($row["luogo"]);
                $s->setOrario($row["orario"]);
                $s->setSquadreIdSquadre($row["Squadre_idSquadre"]);
                $toReturnPartite[$i] = $s;
                $i++;
            }
            return $toReturnPartite;
        } else {
            return FALSE;
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
                $s->setLuogo($row["luogo"]);
                $s->setOrario($row["orario"]);
                $s->setSquadreIdSquadre($row["Squadre_idSquadre"]);
                $toReturnPartite[$i] = $s;
                $i++;
            }
            return $toReturnPartite;
        } else {
            return FALSE;
        }
    }

    public function insertPartita(Partita $partita){
        $managerSquadra = new ManagerSquadra();
        $squadra=$managerSquadra->getById($partita->getSquadreIdSquadre());
        if($squadra!=null){
            $query = "INSERT INTO partite (squadraCasa, squadraTrasferta, risultato, orario, luogo , Squadre_idSquadre)
            VALUES ('" . $partita->getSquadraCasa() . "','"
                . $partita->getSquadraTrasferta() . "','"
                . $partita->getRisultato() . "','"
                . $partita->getOrario(). "','"
                . $partita->getLuogo(). "','"
                . $partita->getSquadreIdSquadre() . "')";

            if (!$this->conn->query($query)) {
                return null;
            }
            else return $partita;
        }
        else return null;



    }

    public function deletePartita($idPartita){
        $controllo = $this->getPartitaById($idPartita);
        if($controllo != FALSE){
            $sql = "DELETE FROM partite WHERE idPartita='$idPartita'";
            $risultato = $this->conn->query($sql);
            return $risultato;
        } else {
            return FALSE;
        }
    }

    public function aggiornaPartita(Partita $partita){
        $risultato = $this->getPartitaById($partita->getIdPartita());
        if($risultato!=FALSE){
            $risultato = $partita->getRisultato();
            $squadraCasa = $partita->getSquadraCasa();
            $squadraTrasferta = $partita->getSquadraTrasferta();
            $id = $partita->getIdPartita();
            $or=$partita->getOrario();
            $l=$partita->getLuogo();
            $sql = "UPDATE partite SET risultato='$risultato', orario='$or', luogo='$l',squadraCasa='$squadraCasa' , squadraTrasferta='$squadraTrasferta'  WHERE idPartita='$id'";
            if (!$this->conn->query($sql)) {

                return false;
            }
            else return $partita;
        }
        return false;
    }


    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->db->close($this->conn);
    }
}