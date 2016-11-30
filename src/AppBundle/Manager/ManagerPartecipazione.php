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

    public function getAll(){
        $sql = "SELECT * from partecipazione";
        $result = $this->conn->query($sql);
        if($result->num_rows >0){
            $i=0;
            $partecipazioni = array();
            while($row = $result->fetch_assoc()){
                $s = new Partecipazione();
                $s->setIdSquadre($row["Squadre_idSquadre"]);
                $s->setIdPartecipazione($row["idPartecipazione"]);
                $s->setPunteggio($row["punteggio"]);
                $s->setVittorie($row["vittorie"]);
                $s->setPareggi($row["pareggi"]);
                $s->setSconfitte($row["sconfitte"]);
                $s->setNomeTorneo($row["nomeTorneo"]);
                $partecipazioni[$i] = $s;
                $i++;
            }
            return $partecipazioni;
        }
        else {
            return FALSE;
        }
    }


    public function getPartecipazioniBySquadra($id){
        $managerSquadra = new ManagerSquadra();
        $partecipazioni = array();
        $controllo = $managerSquadra->getById($id);
        if($controllo!=FALSE){
            $sql = "SELECT * FROM partecipazione WHERE Squadre_idSquadre = '$id'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0){
                $i=0;
                while($row = $result->fetch_assoc()){
                    $s = new Partecipazione();
                    $s->setIdSquadre($row["Squadre_idSquadre"]);
                    $s->setIdPartecipazione($row["idPartecipazione"]);
                    $s->setPunteggio($row["punteggio"]);
                    $s->setVittorie($row["vittorie"]);
                    $s->setPareggi($row["pareggi"]);
                    $s->setNomeTorneo($row["nomeTorneo"]);
                    $s->setSconfitte($row["sconfitte"]);
                    $partecipazioni[$i] = $s;
                    $i++;
                }
                return $partecipazioni;
            }
        } else {
            return FALSE;
        }

    }

    public function inserisciPartecipazione(Partecipazione $part){

        $idS = $part->getIdSquadre();
        $manS = new ManagerSquadra();
        if($manS->getById($idS)) {
            $sql = "INSERT INTO partecipazione (punteggio, vittorie, pareggi, sconfitte,nomeTorneo, Squadre_idSquadre) VALUES ('" . $part->getPunteggio() .
                "','" . $part->getVittorie() .
                "','" . $part->getPareggi() .
                "','" . $part->getSconfitte() .
                "','" . $part->getNomeTorneo() .
                "','" . $part->getIdSquadre() . "')";
            if (!$this->conn->query($sql)) {
                return FALSE;
            } else{
                return $part;
            }
        } else {
            return FALSE;
        }
    }


    public function aggiornaPartecipazione(Partecipazione $part){
        $idP = $part->getIdPartecipazione();
        $manS = new ManagerPartecipazione();
        if($manS->getPartecipazioneById($idP)) {
            $sql = "UPDATE partecipazione SET 
                  punteggio='" . $part->getPunteggio() .
                "', vittorie='" . $part->getVittorie() .
                "' , pareggi='" . $part->getPareggi() .
                "' , sconfitte='" . $part->getSconfitte() .
                "' , nomeTorneo='" . $part->getNomeTorneo() .
                "' , sconfitte= '" . $part->getSconfitte() .
                 "' WHERE idPartecipazione='".$part->getIdPartecipazione() ."'";
            if (!$this->conn->query($sql)) {
                return FALSE;
            } else{
                return $part;
            }
        } else {
            return FALSE;
        }
    }

    public function eliminaPartecipazione(Partecipazione $part){

        $idS = $part->getIdPartecipazione();
        if($this->getPartecipazioneById($idS)) {
            $sql = "DELETE FROM partecipazione WHERE idPartecipazione='".$part->getIdPartecipazione()."'";
            $risultato = $this->conn->query($sql);
            return $risultato;
        } else {
            return FALSE;
        }
    }

    public function getPartecipazioneById($id){
        $sql="SELECT * FROM partecipazione WHERE idPartecipazione='$id'";
        $result = $this->conn->query($sql);
        $s=new Partecipazione();
        if ($result->num_rows > 0) {
            // output data of each row
            if($row = $result->fetch_assoc()) {
                $s->setIdPartecipazione($row["idPartecipazione"]);
                $s->setPunteggio($row["punteggio"]);
                $s->setVittorie($row["vittorie"]);
                $s->setPareggi($row["pareggi"]);
                $s->setSconfitte($row["sconfitte"]);
                $s->setIdSquadre($row["Squadre_idSquadre"]);
                $s->setNomeTorneo($row["nomeTorneo"]);
            }
            return $s;
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